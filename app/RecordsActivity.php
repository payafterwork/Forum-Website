<?php 
namespace App;
trait RecordsActivity{
	protected static function bootRecordsActivity(){
      foreach(static::getActivitiesToRecord() as $event){
     	static::$event(function ($model) use ($event){
     	 $model->recordActivity($event);
     
     });
     }
	}
	protected static function getActivitiesToRecord(){
		return ['created'];
	}
	protected function recordActivity($event){
     	if(auth()->guest()){
     		return;
     	}else{	
      	 ///Means whenever $question is created
     	$this->activity()->create([ // We want to create an activity in the activities table as part of the process
     	'type' => $event.'_'. strtolower((new \ReflectionClass($this))->getShortName()),
         'reason_id'=>$this->id, //using polymorphism here ??
         'user_id' => auth()->id(),
         'reason_type' => get_class($this)
       ]);
         }
     }
     public function activity(){
		return $this->morphMany(Activity::class,'reason');
	}
}