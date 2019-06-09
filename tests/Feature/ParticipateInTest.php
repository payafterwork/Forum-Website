<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ParticipateInTest extends TestCase
{
   use DatabaseMigrations;
    /** @test */

  /** @test */ 
      public function auth_user_can_answer_question()
    {
       
       $user = factory('App\User')->create();
       $this->be($user); // Used for making authenticated user
       $question = factory('App\Question')->create(); //
       $answer = factory('App\Answer')->make();// create() vs. make() ?
       $this->post($question->path().'/answers',$answer->toArray());
          $this->get($question->path())
               ->assertSee($answer->ans);
    } 
   /** @test */
   public function guests_cannot_answer_question()
   {
       $this->post('questions/1/answers')
            ->assertRedirect('/login');

   }
 


}

// :)