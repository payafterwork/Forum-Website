<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Answer extends Model
{    
     use Favouritable,RecordsActivity;
     protected $touches = ['question'];
     protected $fillable = ['rating','ans','user_id'];
     protected $with = ['owner','favourites'];
     protected $appends = ['favouritesCount','isFavourited'];
   
    public function owner()
    {
      return $this->belongsTo(User::class,'user_id');
    }
    
  public function question(){
    return $this->belongsTo(Question::class);
  }

   public function path()
    {
        return $this->question->path() . "#answer-{$this->id}";
    }

    public function mentionedUsers($answer){
      preg_match_all('/@([\w\-]+)/', $answer->ans, $matches);
        return $matches[1];
    }

    public function setAnsAttribute($ans){
     $this->attributes['ans'] = preg_replace('/@([\w\-]+)/','<a href="/profiles/$1">$0</a>',$ans);
    }

    public function isBest(){
      return $this->question->best_answer_id == $this->id;
    }
   
} 