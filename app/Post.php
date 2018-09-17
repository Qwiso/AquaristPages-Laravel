<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Post
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Reaction[] $reactions
 * @property-read \App\User $user
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property string $text
 * @property string|null $media_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereMediaUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Post whereUserId($value)
 */
class Post extends Model
{
    public function user() { return $this->belongsTo(User::class); }
    public function comments() { return $this->morphMany(Comment::class, 'commentable'); }
    public function reactions() { return $this->morphMany(Reaction::class, 'reactable'); }
}
