<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Discount
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Discount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Discount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Discount query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property int $value
 * @property bool $redeemed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Discount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Discount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Discount whereRedeemed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Discount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Discount whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Discount whereValue($value)
 */
class Discount extends Model
{
    protected $hidden = ['id'];

    protected $guarded = ['id'];
}
