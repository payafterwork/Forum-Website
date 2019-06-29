<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Answer extends Model
{    
     use Favouritable,RecordsActivity;
     protected $fillable = ['rating','ans','user_id'];
     protected $with = ['owner','favourites'];
   
    public function owner()
    {
      return $this->belongsTo(User::class,'user_id');
    }
    
  public function question(){
    return $this->belongsTo(Question::class);
  }
} 