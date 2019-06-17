<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['user_id','reason_id','reason_type','type'];

    public function reason(){
    	return $this->morphTo();
    } 

}
