<?php
namespace App;
use Auth;
use App\Answer;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Notification;
use App\Notifications\YouWereMentioned;
use Illuminate\Support\Facades\Redis;

class Question extends Model
{   
	use RecordsActivity;
     protected $fillable = ['rating','ans','qnop','qtitle','qdetails','user_id','subject_id'];
     protected $with = ['creator','subject'];
     protected $appends = ['isSubscribedTo'];
     protected static function boot(){
     	parent::boot();
     	static::addGlobalScope('answersCount',function($builder){
     		$builder->withCount('answers');
     	});
     	static::deleting(function ($question){
     	 $question->answers->each->delete();
    });
     	
     }
     
	public function path()
	{
		return '/questions/'.$this->subject->subslug.'/'.$this->id;
	}
	public function answers()
	{
	    return $this->hasMany(Answer::class);
	}
	public function creator() 
	{
		return $this->belongsTo(User::class,'user_id');
	}
	public function addAnswer($answer)
	{
		$answer = $this->answers()->create($answer);
		$this->notifyMentionedUsers($answer);
		$this->notifySubscribers($answer);
   
		return $answer;
	}

	public function notifySubscribers($answer){
		 $this->subscriptions
            ->where('user_id', '!=', $answer->user_id)
            ->each
            ->notify($answer);
}

 public function notifyMentionedUsers($answer){
 	  

      $users = User::whereIn('name', $answer->mentionedUsers($answer))->get()->filter();
       Notification::send($users, new YouWereMentioned($answer));
 }
	public function subject() 
	{
		return $this->belongsTo(Subject::class);
	}
	public function subscribe($userId=null){
       $this->subscriptions()->create([
      'user_id'=>$userId?:auth()->id()
      ]);
       return $this;
 	}
 	public function unsubscribe($userId=null){
       $this->subscriptions()
       ->where(['user_id'=>$userId?:auth()->id()])
       ->delete();
     
 	}
	public function subscriptions(){
      return $this->hasMany(QuestionSubsciption::class);
	}
    
	public function getIsSubscribedToAttribute(){
      return $this->subscriptions()->where('user_id',auth()->id())
      ->exists();	}

      public function hasUpdatesFor(){
      	$key = sprintf("users.%s.visits.%s",auth()->id(),$this->id);
      	return $this->updated_at > cache($key);
      }

   
   
}