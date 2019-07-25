<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaView extends Model
{
	protected $guarded = [];
    public function hasUser(){
        return $this->belongsTo(User::class, 'user', 'id');
    }

    public function access(){
        return $this->belongsTo(AccessArea::class, 'accessId', 'id');
    }
}
