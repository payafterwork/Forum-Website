<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
   public function show(User $user){
    return view('user.show',[
    	'profileUser' => $user,
        'questions' => $user->questions()->paginate(10) 
    ]);
     
   }   

 }
