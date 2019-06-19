<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat_Message extends Model
{
    protected $table='chat_messages';

    public function message(){
        return $this->hasOne('App\Chat');
    }
}
