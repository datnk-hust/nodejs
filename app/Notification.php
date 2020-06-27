<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    protected $table = "notification";
    public $timestamp = false;

    public function user(){
    	return $this->belongsTo(App\User::class,'id','annunciator');
    }

    public function device(){
    	return $this->belongsTo(App\Device::class,'dv_id','id'); 
    }
}
