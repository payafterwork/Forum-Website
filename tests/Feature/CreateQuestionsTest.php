<?php
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
   public function guests_cannot_see_create_questions_page_()
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