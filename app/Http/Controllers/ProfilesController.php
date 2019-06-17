<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
   public function show(User $user){
    
    $activities =$user->activity()->with('reason')->get();

    return view('user.show',[
    	'profileUser' => $user,
        'activities' => $user->activity()->paginate(10) 
    ]);
     
   }   

 }
