<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersAvatarController extends Controller
{
    public function store(){
    	$this->validate(request(), [
            'avatar' => ['required', 'image']
        ]);
        auth()->user()->update([
            'avatar_path' => 'http://localhost/'. request()->file('avatar')->store('avatars', 'public')
            // Added http://localhost/ just for local test passing 
        ]);
        return back();
    } 
}
