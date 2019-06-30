<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $guarded = [];

    public function headUser(){
        return $this->belongsTo(User::class, 'head', 'id');
    }
}
