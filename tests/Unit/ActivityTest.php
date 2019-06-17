<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Activity;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityTest extends TestCase
{
    use DatabaseMigrations;
   /** @test */
    public function records_activity_when_question_created()
    {
      $user = factory('App\User')->create();
      $this->be($user); 
      $question = factory('App\Question')->create(['user_id'=>auth()->id()]);
      $this->assertDatabaseHas('activities',[
         'type' => 'created_question',
         'user_id' => auth()->id(),
         'reason_id'=>$question->id,  //using polymorphism here ??
         'reason_type' => 'App\Question'
      ]);

      //records_activity_has_reason

      $activity = \App\Activity::first();
      $this->assertEquals($activity->reason->id,$question->id);
    }


    /** @test */
    public function records_activity_when_answer_created()
    {
      $user = factory('App\User')->create();
      $this->be($user); 
      $answer = factory('App\Answer')->create();
      $this->assertEquals(2,Activity::count());
    }

  



 }
