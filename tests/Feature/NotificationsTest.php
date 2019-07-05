<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\DatabaseMigrations;

class NotificationsTest extends TestCase
{
   use DatabaseMigrations;

 
    /** @test */
 public function user_can_fetch_their_unread_notifications(){
    $user = factory('App\User')->create();
       $this->be($user); 
 $question = factory('App\Question')->create()->subscribe();
$question->addAnswer([
  'user_id'=>factory('App\User')->create()->id,
// An answer from someone else
  'ans'=>'Some answer'
  ]);
 $notificationsId = auth()->user()->unreadNotifications->first()->id;
  
$response = $this->getJson('profiles/'.auth()->user()->name.'/notifications')->json();
$this->assertCount(1,$response);



 }

    /** @test */
 public function notifcations_prepared_when_subcribed_question_recieves_answer_by_not_tthe_current_user(){
    $user = factory('App\User')->create();
       $this->be($user); 
   $question = factory('App\Question')->create()->subscribe();

  $this->assertCount(0,auth()->user()->notifications);

  $question->addAnswer([
  'user_id'=>auth()->id(), 
// An answer we left ourselves
  'ans'=>'Some answer'
  ]);
  
  $this->assertCount(0,auth()->user()->fresh()->notifications);

   $question->addAnswer([
  'user_id'=>factory('App\User')->create()->id,
// An answer from someone else
  'ans'=>'Some answer'
  ]);

    $this->assertCount(1,auth()->user()->fresh()->notifications);
 }


 /** @test */
 public function user_can_clear_a_notification(){
    $user = factory('App\User')->create();
       $this->be($user); 
   $question = factory('App\Question')->create()->subscribe();

   $question->addAnswer([
  'user_id'=>factory('App\User')->create()->id,
// An answer from someone else
  'ans'=>'Some answer'
  ]);

    $this->assertCount(1,auth()->user()->fresh()->unreadnotifications);
    $notificationsId = auth()->user()->unreadNotifications->first()->id;
    $this->delete('profiles/'.auth()->user()->name.'/notifications/'.$notificationsId);

    $this->assertCount(0,auth()->user()->fresh()->unreadnotifications);
 }


}
