<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table='chats';

    public function hasUser1(){
        return $this->belongsTo(User::class, 'user1', 'id');
    }

    public function hasUser2(){
        return $this->belongsTo(User::class, 'user2', 'id');
    }

    public function chat_message(){
        return $this->hasMany(Chat_Message::class);
    }
}
