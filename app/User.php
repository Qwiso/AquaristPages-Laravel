<?php

namespace App;

use DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Post[] $posts
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $facebook_id
 * @property string $facebook_email
 * @property string $facebook_access_token
 * @property string|null $facebook_refresh_token
 * @property string $facebook_token_expires
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFacebookAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFacebookEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFacebookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFacebookRefreshToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFacebookTokenExpires($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\MarketItem[] $items
 * @property int|null $zipcode_id
 * @property-read \App\Zipcode|null $zipcode
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereZipcodeId($value)
 * @property-read \App\Zipcode $location
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = ['remember_token', 'created_at', 'updated_at'];

    public function zipcode() { return $this->belongsTo(Zipcode::class); }
    public function items() { return $this->hasMany(MarketItem::class); }
    public function posts() { return $this->hasMany(Post::class); }
    public function comments() { return $this->hasMany(Comment::class); }

    function getZipcodeIdsByRadius($radius = 25)
    {
        $lat = auth()->user()->zipcode->lat;
        $lon = auth()->user()->zipcode->lon;
        $sql = '(3958*3.1415926*sqrt((lat-'.$lat.')*(lat-'.$lat.') + cos(lat/57.29578)*cos('.$lat.'/57.29578)*(lon-'.$lon.')*(lon-'.$lon.'))/180) <= '.$radius.';';
        return DB::table('zipcodes')->whereRaw($sql)->pluck('id');
    }
}
