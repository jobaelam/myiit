<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function types(){
        return $this->belongsTo(Type::class);
    }

    public function chats(){
        return $this->hasMany(Chat::class);
    }

    public function hasAccess(){
        return $this->hasOne(AccessArea::class, 'id', 'head');
    }

    public function department(){
        return $this->hasOne(Department::class, 'id', 'dept_id');
    }

    public function hasType(){
        return $this->hasOne(Type::class, 'id', 'type');
    }

    public function joinOn(){
        return date('F d, Y',strtotime($this->created_at));
    }

    public function fullName(){
        return $this->first_name.' '.$this->last_name;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password','dept_id', 'type', 'profile_image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}