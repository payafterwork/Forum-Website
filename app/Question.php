<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	protected $fillable = ['rating','ans','qnop','qtitle','qdetails','user_id','subject_id'];
   public function path()
	{
		return '/questions/'.$this->id;
	}
   public function answers()
	{
	    return $this->hasMany(Answer::class);	
	}
	public function creator() 
	{
		return $this->belongsTo(User::class,'user_id');
	}
	public function addAnswer($answer)
	{
		$this->answers()->create($answer);
	}


}
