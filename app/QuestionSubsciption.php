<?php

namespace App;
use App\User;
use App\Question;
use App\Answer;
use Illuminate\Database\Eloquent\Model;

class QuestionSubsciption extends Model
{
    protected $fillable =['user_id'];
  
  public function user(){
  	return $this->belongsTo(User::class);
  }
  public function question(){
    return $this->belongsTo(Question::class);
  }
     public function notify($answer)
    {
        $this->user->notify(new Notifications\QuestionWasUpdated($this->question, $answer));
    }

}
