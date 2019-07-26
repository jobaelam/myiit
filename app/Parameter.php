<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    protected $guarded = [];

    public function hasAccess(){
        return $this->belongsTo(AccessArea::class, 'accessId', 'id');
    }
}
