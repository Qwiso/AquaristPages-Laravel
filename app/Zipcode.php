<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Zipcode
 *
 * @property int $id
 * @property string $country
 * @property int $zipcode
 * @property string $city
 * @property string $state
 * @property string $state_abbr
 * @property string $county
 * @property float $lat
 * @property float $lon
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Zipcode whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Zipcode whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Zipcode whereCounty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Zipcode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Zipcode whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Zipcode whereLon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Zipcode whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Zipcode whereStateAbbr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Zipcode whereZipcode($value)
 * @mixin \Eloquent
 */
class Zipcode extends Model
{
    public $timestamps = false;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    public function users() { return $this->belongsToMany(User::class); }
}
