<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintenance_schedule extends Model
{
    //
    protected $table = "mainten_schedule";
    public function devices(){
    	return $this->belongsTo('App\Device','dv_id','id');
    }

}
