<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public function owner(){
        return $this->belongsTo(User::class);
    }

    public function hasParameter(){
        return $this->belongsTo(Parameter::class, 'parameterId', 'id');
    }
}
