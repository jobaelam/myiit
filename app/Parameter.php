<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    protected $guarded = [];

    public function hasAccess(){
        return $this->belongsTo(AccessArea::class, 'accessId', 'id');
    }

    public function hasName(){
        return $this->belongsTo(ParameterName::class, 'nameId', 'id');
    }

    public function hasFiles(){
        return $this->hasMany(File::class, 'parameterId', 'id');
    }
}
