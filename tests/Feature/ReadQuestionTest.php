<?php

namespace Tests\Feature;
use App\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadQuestionTest extends TestCase
{
   
    
   use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
      
   /** @test */
   public function user_can_view_questions()
   {
       $question = factory('App\Question')->create();
       $response = $this->get('/questions');
       $response->assertSee($question->qtitle);
       
   }
   /** @test */
    public function user_can_read_question()
   {
       $question = factory('App\Question')->create();
       $response = $this->get($question->path());
       $response->assertSee($question->qtitle);
       
   }
   /** @test */
   public function user_can_read_answers_to_the_question()
   {
       $question = factory('App\Question')->create();
       $answer = factory('App\Answer')->create(['question_id'=>$question->id]);
       $response = $this->get($question->path());
       $response->assertSee($answer->ans);

   }



    /** @test */
   public function user_can_filter_question_wrt_subject()
   {
       $subject = factory('App\Subject')->create();
       $questionInSubject = factory('App\Question')->create(['subject_id'=>$subject->id]);
       $questionNotInSubject = factory('App\Question')->create();
       $this->get('/questions/'.$subject->subslug)
        ->assertSee($questionInSubject->qtitle)
        ->assertDontSee($questionNotInSubject->qtitle);   }

   
    /** @test */
   public function user_can_filter_question_by_username()
   {
       $user = factory('App\User')->create(['name'=>'JohnDoe']);
       $this->be($user); // Used for making authenticated user
       $questionsBYJohn = factory('App\Question')->create(['user_id'=>auth()->id()]);
       $questionNotBYJohn = factory('App\Question')->create();
       $this->get('/questions?by=JohnDoe')
        ->assertSee($questionsBYJohn->qtitle)
        ->assertDontSee($questionNotBYJohn->qtitle);   
      }


    /** @test 

   public function user_can_filter_question_by_mostanswered()
   {
    
    $question = factory('App\Question')->create();
     
    $questionWithThreeAnswers= factory('App\Question')->create();
    factory('App\Answer')->create(['question_id'=>$questionWithThreeAnswers->id]);
    factory('App\Answer')->create(['question_id'=>$questionWithThreeAnswers->id]);
    factory('App\Answer')->create(['question_id'=>$questionWithThreeAnswers->id]);
 

    $questionWithTwoAnswers= factory('App\Question')->create();
    factory('App\Answer')->create(['question_id'=>$questionWithTwoAnswers->id]);
    factory('App\Answer')->create(['question_id'=>$questionWithTwoAnswers->id]);

    $questionWithNoAnswer= factory('App\Question')->create();

    $response=$this->get('/questions?mostanswered=1');
  

    $this->assertEquals([0,1,2], array_column($response,'answer_count'));
      
   

  } 
  *



 /**  @test */
  public function user_can_filter_question_by_unanswered()
   {   $questionWithNoAnswer = factory('App\Question')->create();
       $questionwithanswer = factory('App\Question')->create();
       $answer = factory('App\Answer')->create(['question_id'=>$questionwithanswer->id]);
      $this->get('questions?unanswered=1')
           ->assertSee($questionWithNoAnswer->qtitle)
            ->assertDontSee($questionwithanswer->qtitle);

   }


  /** @test */
  function user_can_request_answers(){
    $question = factory('App\Question')->create();
   $answer1 = factory('App\Answer')->create(['question_id'=>$question->id]);
    $answer2 = factory('App\Answer')->create(['question_id'=>$question->id]);

   $response = $this->getJson($question->path().'/answers')->json();

  $this->assertCount(1,$response['data']);
  $this->assertEquals(2,$response['total']);
  
  }




}
