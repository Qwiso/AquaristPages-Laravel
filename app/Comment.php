<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Comment
 *
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $commentable
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Reaction[] $reactions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $replies
 * @property-read \App\User $user
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property string $text
 * @property string $media_url
 * @property int $commentable_id
 * @property string $commentable_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereCommentableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereCommentableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereMediaUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereUserId($value)
 */
class Comment extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $with = ['user'];

    public function commentable() { return $this->morphTo(); }

    public function user() { return $this->belongsTo(User::class); }
    public function replies() { return $this->morphMany(Comment::class, 'commentable'); }
    public function reactions() { return $this->morphMany(Reaction::class, 'reactable'); }
}
