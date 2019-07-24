<?php

namespace Tests\Feature;
use App\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BestAnswerTest extends TestCase
{
   
    
   use DatabaseMigrations;
    
   /** @test */
   public function question_creator_may_mark_any_answer_as_best_answer()
   { 

     $user = factory('App\User')->create();
     $this->be($user);
     $question = factory('App\Question')->create(['user_id'=>auth()->id()]);
     $answer = factory('App\Answer')->create(['question_id'=>$question->id]);

     $this->assertFalse($answer->isBest());
    $this->postJson(route('best_answer.store',[$answer->id]));
    $this->assertTrue($answer->fresh()->isBest());
     
   }

   /** @test */
   public function only_question_creator_may_mark_answer_as_best(){
    $this->withExceptionHandling();
   $user = factory('App\User')->create();
     $this->be($user);
   $question = factory('App\Question')->create(['user_id'=>auth()->id()]);
   $answer = factory('App\Answer')->create(['question_id'=>$question->id]);
   $user2 = factory('App\User')->create();
     $this->be($user2);
    $this->postJson(route('best_answer.store',[$answer->id]))->assertStatus(403);
    $this->assertFalse($answer->fresh()->isBest());  


   }

   

}
