<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
class RegisterConfirmationController extends Controller
{
    public function index(){
    	$user = User::where('confirmation_token', request('token'))->first();
        if (! $user) {
            return redirect('/questions')->with('flash', 'Unknown token.');
        }
        $user->confirm();
        

    	return redirect('/questions')
    	->with('flash',"Account confirmed");   
    }
}
