<?php
namespace App;
use Auth;
use App\User;
use Illuminate\Database\Eloquent\Model;
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
		$this->answers()->create($answer);
	}
	public function subject() 
	{
		return $this->belongsTo(Subject::class);
	}
	public function subscribe($userId=null){

       $this->subscriptions()->create([
      'user_id'=>$userId?:auth()->id()
      ]);
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


	
}