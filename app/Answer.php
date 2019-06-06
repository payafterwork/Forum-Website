<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function owner()
    {
    	return $this->belongsTo(User::class,'user_id');
    }
}
