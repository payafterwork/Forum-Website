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
     protected static function boot(){
     	parent::boot();
     	static::addGlobalScope('answersCount',function($builder){
     		$builder->withCount('answers');
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
	
}