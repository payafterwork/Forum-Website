<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
     protected $fillable = ['rating','ans','user_id'];
   
    public function owner()
    {
    	return $this->belongsTo(User::class,'user_id');
    }

}
