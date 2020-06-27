<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','fullname' ,'password','mobile','email','address','rule','department_id'
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

    public function notification(){
        return $this->hasMany('App\Notification');
    }
    public function department()
    {
        return $this->belongsTo('App\Department','department_id');
    }
    function isAdmin()
    {
        return $this->rule == 1;
    }
    function isUser()
    {
        return $this->rule == 2;
    }
}
