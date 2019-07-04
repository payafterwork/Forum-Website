<?php

namespace Tests\Feature;
use App\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\DatabaseMigrations;

class SubscribeQuestionTest extends TestCase
{
   
    
   use DatabaseMigrations;
  
   /** @test */
 public function user_can_subscribe_to_questions(){
    $user = factory('App\User')->create();
       $this->be($user); 
  $question = factory('App\Question')->create();
  $this->post($question->path().'/subscriptions');
  $question->addAnswer([
  'user_id'=>auth()->id(),
  'ans'=>'Some answer'
  ]);

  $this->assertCount(1,$question->subscriptions);
 }

/** @test */
 public function user_can_unsubscribe_from_questions(){
    $user = factory('App\User')->create();
       $this->be($user); 
  $question = factory('App\Question')->create();
  $question->subscribe();
  $this->delete($question->path().'/subscriptions');

  $this->assertCount(0,$question->subscriptions);
 }
 

}
