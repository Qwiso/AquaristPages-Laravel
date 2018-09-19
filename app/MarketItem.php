<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\MarketItem
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $category
 * @property string $title
 * @property string $description
 * @property string $media_url
 * @property int $amount
 * @property float $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MarketItem whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MarketItem whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MarketItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MarketItem whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MarketItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MarketItem whereMediaUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MarketItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MarketItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MarketItem whereUpdatedAt($value)
 * @property int $user_id
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MarketItem whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MarketItem whereUserId($value)
 * @property-read \App\Zipcode $location
 * @property int|null $zipcode_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MarketItem whereZipcodeId($value)
 * @property string $uuid
 * @property-read \App\Zipcode|null $zipcode
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MarketItem whereUuid($value)
 */
class MarketItem extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user() { return $this->belongsTo(User::class); }
    public function zipcode() { return $this->belongsTo(Zipcode::class); }
}
