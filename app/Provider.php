<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    //
    protected $table = "provider";
    public $timestamp = false;
    public function device(){
    	return $this->hasMany('App\Device','provider_id');
    }
    public function accessory(){
    	return $this->hasMany('App\Accessory','provider_id','id');
    }
}
