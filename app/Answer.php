<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
     protected $fillable = ['rating','ans','user_id'];

     protected $with = ['owner','favourites'];
   
    public function owner()
    {
    	return $this->belongsTo(User::class,'user_id');
    }
    
    public function favourites()
    {   
    return $this->morphMany(Favourite::class,'favourited');
  }
  public function isFavourited()
    {   
    return $this->favourites->where('user_id',auth()->id())->count();
  }
  public function getFavouritesCountAttribute() {
  	return $this->favourites->count();
  }
} 
