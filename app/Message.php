<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['conversation_id', 'sender_profile_id', 'recipient_profile_id', 'content'];

    public function sender(){
        return $this->belongsTo(Profile::class, 'sender_profile_id');
    }
}
