<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Benchmark extends Model
{
	protected $guarded = [];
    public function hasName(){
        return $this->belongsTo(ParameterName::class, 'nameId', 'id');
    }

    public function hasFiles(){
        return $this->hasMany(File::class, 'benchmarkId', 'id');
    }
}
