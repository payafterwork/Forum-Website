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
       $this->post('questions/subject/1/answers')
            ->assertRedirect('/login');

   }

   /** @test */
   public function answer_required_ans_data()
   {
         // Given signed in
    $user = factory('App\User')->create();
    $this->withExceptionHandling()->be($user);
    $question = factory('App\Question')->create(); 
    $answer = factory('App\Answer')->make(['ans'=>null]);
    //We create a post request for answer
    return $this->post($question->path().'/answers',$answer->toArray())
        ->assertSessionHasErrors('ans'); //then it must show us errors as ans is null
     
    
   }
 


}

// :)