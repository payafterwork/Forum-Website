<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;
trait Favouritable{
    
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