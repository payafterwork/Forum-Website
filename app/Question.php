<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
   public function path()
	{
		return '/questions/'.$this->id;
	}
   public function answers()
	{
	    return $this->hasMany(Answer::class);	
	}

}
