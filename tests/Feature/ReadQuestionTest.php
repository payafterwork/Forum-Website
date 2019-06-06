<?php

namespace Tests\Feature;

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
}
