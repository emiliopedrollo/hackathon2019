<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Note
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $note_identifier
 * @property int|null $user_id
 * @property int|null $total_value
 * @property string|null $cpf
 * @property int|null $discount_value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereCpf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereDiscountValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereNoteIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereTotalValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereUserId($value)
 */
class Note extends Model
{
    protected $hidden = ['id'];

    protected $guarded = ['id'];

    protected $appends = ['credits_gained'];

    public function getDiscountValueAttribute($value) {
        return $value / 100;
    }

    public function getTotalValueAttribute($value) {
        return $value / 100;
    }

    public function setDiscountValueAttribute($value) {
        $this->attributes['discount_value'] = $value * 100;
    }
    public function setTotalValueAttribute($value) {
        $this->attributes['total_value'] = $value * 100;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function getCreditsGainedAttribute() {
        return $this->discount_value;
    }
}
