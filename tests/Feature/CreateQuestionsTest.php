<?php
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Activity;
class CreateQuestionsTest extends TestCase
{
    use DatabaseMigrations;
  /** @test */ 
      public function auth_user_can_create_question()
    {
        
       $user = factory('App\User')-> create();
       $this->be($user);
       $question = factory('App\Question')->make();
       $response = $this->post('/questions',$question->toArray());
          $this->get($response->headers->get('Location'))
               ->assertSee($question->qtitle)
               ->assertSee($question->qdetails);
       
    } 

    /** @test */ 
      public function auth_user_must_confirm_email_address_before_creating_ques()
    {
        $this->withExceptionHandling();
       $user = factory('App\User')->states('unconfirmed')->create();
       $this->be($user);
       $question = factory('App\Question')->make();
       $this->post('/questions',$question->toArray())
       ->assertRedirect('/questions')->with('flash','You must confirm email address.');
       
    } 
    

      /** @test */ 
      public function autherized_user_can_delete_questions()
    {
        
       $user = factory('App\User')-> create();
       $this->be($user);
       $question = factory('App\Question')->create(['user_id'=>auth()->id()]);
       $answer = factory('App\Answer')->create(['question_id'=>$question->id]);
       $response = $this->json('DELETE',$question->path());
       $response->assertStatus(204);
       $this->assertDatabaseMissing('questions',['id'=> $question->id]);
        $this->assertDatabaseMissing('answers',['id'=>$answer->id]);
        $this->assertDatabaseMissing('activities',['reason_id'=>$question->id,'reason_type'=>get_class($question)]);
         $this->assertDatabaseMissing('activities',['reason_id'=>$answer->id,'reason_type'=>get_class($answer)]);
       $this->assertEquals(0,Activity::count());
       
    }
   
   /** @test */ 
   public function unauthorized_cannot_see_create_questions()
   {
        
     //Guest cannot
       $question = factory('App\Question')->create();
      
       $response = $this->delete($question->path());
       $response->assertRedirect('/login');
       //Signed in but not the owner of thread
       $user = factory('App\User')-> create();
       $this->be($user);
       $response = $this->delete($question->path());
       $response->assertStatus(403);
       
      
   }
    /** @test */ 
   public function guests_cannot_see_delete_questions_page_()
   {
       $this->get('/questions/create')
            ->assertRedirect('/login'); 
      
   }
    /** @test */ 
    public function guest_cannot_make_post_request_on_Store_method()
   {
       
        $this->post('/questions')
             ->assertRedirect('/login');     
   }
   
// VALIDATION TESTS AHEAD
     public function publishQwithValidation($overrides = [])
   {
        // Given signed in
    $user = factory('App\User')->create();
    $this->be($user);
    $question = factory('App\Question')->make($overrides); 
    //We create a post request for question
    return $this->post('/questions',$question->toArray()); 
       
   }
   /** @test */
   public function question_requires_qtitle()
   {    //If we publish question with null qtitle and
      $this->publishQwithValidation(['qtitle'=>null])
           ->assertSessionHasErrors('qtitle'); //then it must show us errors
    }
       /** @test */
   public function question_requires_qdetails()
   {    //If we publish question with null qdetails and
      $this->publishQwithValidation(['qdetails'=>null])
           ->assertSessionHasErrors('qdetails'); //then it must show us errors
    }
        /** @test */
   public function question_requires_subject_id()
   {   
    factory('App\Subject',2)->create();
    //If we publish question with null subject_id and
      $this->publishQwithValidation(['subject_id'=>null])
           ->assertSessionHasErrors('subject_id'); //then it must show us errors
      //If we publish question with invalid subject_id and
      $this->publishQwithValidation(['subject_id'=>999])
           ->assertSessionHasErrors('subject_id'); //then it must show us errors      
    }
}
?>