<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Reaction
 *
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $reactable
 * @property-read \App\User $user
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property int $reaction_type
 * @property int $reactable_id
 * @property string $reactable_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reaction whereReactableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reaction whereReactableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reaction whereReactionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reaction whereUserId($value)
 */
class Reaction extends Model
{
    public function reactable(){ return $this->morphTo(); }
    public function user(){ return $this->belongsTo(User::class); }
}
