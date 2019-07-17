<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $guarded = [];

    public function hasAccess(){
        return $this->hasMany(AccessArea::class, 'areaId', 'id');
    }
    public function hasHead(){
        return $this->hasOne(AccessArea::class, 'areaId', 'id');
    }

    public function hasAgency(){
        return $this->belongsto(Agency::class, 'agency_id', 'id');
    }
}
