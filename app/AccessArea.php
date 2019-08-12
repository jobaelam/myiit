<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class AccessArea extends Model
{
    protected $guarded = [];

    public function headUser(){
        return $this->belongsTo(User::class, 'head', 'id');
    }

    public function hasArea(){
        return $this->belongsTo(Area::class, 'areaId', 'id');
    }

    public function hasDepartment(){
        return $this->belongsTo(Department::class, 'departmentId', 'id');
    }
}
