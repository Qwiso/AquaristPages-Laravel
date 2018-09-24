<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];
    protected $dates = ['last_seen'];

    public function user(){ return $this->belongsTo(User::class); }
    public function conversation() { return $this->belongsTo(Conversation::class); }
    public function messages() { return $this->hasMany(Message::class, 'user_id', 'user_id'); }
}
