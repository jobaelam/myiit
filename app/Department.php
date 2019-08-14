<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
	protected $guarded = [];
    public function hasHead(){
        return $this->belongsTo(User::class, 'head', 'id');
    }
}
