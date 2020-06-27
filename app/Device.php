<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    //
    protected $table = "device";
    public $timestamp = false;
    public function dv_type(){
    	return $this->belongsTo('App\Device_type','dv_type_id','dv_type_id');
    }
    public function accessory(){
    	return $this->belongsToMany('App\Accessory','Device_accessory','dv_id','acc_id');
    }
    public function provider(){
    	return $this->belongsTo('App\Provider','provider_id');
    }
    public function department(){
    	return $this->belongsTo('App\Department','department_id');
    }
    
}
