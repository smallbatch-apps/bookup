<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasUuid;

    public $incrementing = false;

    public function participants()
    {
        return $this->belongsToMany(Profile::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
