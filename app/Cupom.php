<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Cupom
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cupom newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cupom newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cupom query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property int $value
 * @property bool $redeemed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cupom whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cupom whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cupom whereRedeemed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cupom whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cupom whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Cupom whereValue($value)
 */
class Cupom extends Model
{
    protected $table = 'cupons';

    protected $hidden = ['id'];

    protected $guarded = ['id'];
}
