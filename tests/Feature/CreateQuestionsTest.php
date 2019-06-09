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
}

?>