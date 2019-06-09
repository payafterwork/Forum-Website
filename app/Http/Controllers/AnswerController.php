<?php

namespace App\Http\Controllers;
use App\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{   
	function __construct()
    {
    	$this->middleware('auth')->only(['store']);//if unauthenticated calls these, will be redirected to /login
    }
    
    public function store(Question $question)
    {   
    	$question->addAnswer([
          'ans'=>request('ans'),
          'user_id'=>auth()->id()
    	]);
       return back();
    }
}
