<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat_Message extends Model
{
    protected $table='chat_messages';

    protected $guarded = [];

    public function message(){
        return $this->belongsTo(Chat::class);
    }
}
