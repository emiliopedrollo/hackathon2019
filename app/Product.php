<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Product
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $price
 * @property int|null $note_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereNoteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereUpdatedAt($value)
 */
class Product extends Model
{
    protected $hidden = ['id'];

    protected $guarded = ['id'];

    public function note() {
        return $this->belongsTo(Note::class);
    }

    public function getPriceAttribute($value) {
        return $value / 100;
    }

    public function setPriceAttribute($value) {
        $this->attributes['price'] = (int) $value * 100;
    }
}
