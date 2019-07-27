<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileView extends Model
{
	protected $guarded = [];
    public function hasFile(){
        return $this->belongsTo(File::class, 'fileId', 'id');
    }

    public function hasUser(){
        return $this->belongsTo(User::class, 'user', 'id');
    }
}
