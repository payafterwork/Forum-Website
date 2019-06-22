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
 /** @test */   
 public function unauthorized_cannot_delete_answers()
   {
        
     //Guest cannot
       $answer = factory('App\Answer')->create();
      
       $response = $this->delete('/answers/{$answer}');
       $response->assertRedirect('/login');

       //Signed 
      $user = factory('App\User')-> create();
       $this->be($user);
      $this->delete('/answers/{$answer}')->assertStatus(403);

     }


 /** @test */
      public function autherized_user_can_delete_answers()
    {
        
       $user = factory('App\User')-> create();
       $this->be($user);
       
       $answer = factory('App\Answer')->create(['user_id'=>$user->id]);
     
       $this->delete('/answers/{$answer}')->assertStatus(302);
         $this->assertDatabaseMissing('answers',['id'=> $answer->id]);

       
    }

      /** @test */
   public function autherized_user_can_update_answers()
   {
      
       $user = factory('App\User')->create();
       $this->be($user);
       
       $answer = factory('App\Answer')->create(['user_id'=>$user->id]);
     
       $this->patch("/answers/{$answer->id}",['ans'=>'You should be changed']);
         $this->assertDatabaseHas('answers',['id'=> $answer->id, 'ans'=>'You should be changed']);

       
    
   } 

   /** @test  */
   public function unauthorized_cannot_update_answers()
   {
        $this->withExceptionHandling();
     //Guest cannot
       $answer = factory('App\Answer')->create();
      
       $response = $this->patch('/answers/{$answer}');
       $response->assertRedirect('/login');

       //Signed 
      $user = factory('App\User')->create();
       $this->be($user);
      $this->patch("/answers/{$answer}")->assertStatus(403);

     }
   


 


}

// :)