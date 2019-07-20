<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use App\Auth;

class UsersAvatarController extends Controller
{
    public function store(){
     
    	$this->validate(request(), [
            'avatar' => ['required','image']
        ]);
      
        auth()->user()->update([
            'avatar_path' => request()->file('avatar')->store('avatars', 'public')
        ]);
        return response([], 204);
    } 
}
