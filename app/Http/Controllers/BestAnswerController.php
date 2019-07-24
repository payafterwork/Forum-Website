<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
class BestAnswerController extends Controller
{   
    public function store(Answer $answer){
      $this->authorize('update',$answer->question);	
      $answer->question->update(['best_answer_id'=>$answer->id]);
    }
}
