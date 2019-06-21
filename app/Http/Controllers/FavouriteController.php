<?php

namespace App\Http\Controllers;

use App\Auth;
use Illuminate\Http\Request;
use App\Answer;


class FavouriteController extends Controller
{    
	public function __construct(){

		$this->middleware('auth')->only(['store']);
	}


  public function store(Answer $answer){
    if(!$answer->favourites()->where(['user_id'=>auth()->id()])->exists()){
    $answer->favourites()->insert([
      'user_id'=>auth()->id(),
      'favourited_id'=>$answer->id,
      'favourited_type'=>get_class($answer)
   ]);
  }
   return back()->with('flash','Favourited!');;
    } 

}
