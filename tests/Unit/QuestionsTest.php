<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class QuestionsTest extends TestCase
{   
	use DatabaseMigrations;
    /** @test */
    public function question_has_answers()
    {
    	$question = factory('App\Question')->create();
    	$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$question->answers);

    }
     /** @test */
    public function question_has_creator()
    {
        $question = factory('App\Question')->create();
        $this->assertInstanceOf('App\User',$question->creator);

    }

    /** @test */
    public function question_can_add_answers()
    {
        $question = factory('App\Question')->create();
        $question->addAnswer([
         'ans'=>'Foobarr',
         'user_id'=>1
        ]);
        $this->assertCount(1,$question->answers);
    }
   
      /** @test */
    public function question_belongsto_subject()
    { 

        $question = factory('App\Question')->create();
        $this->assertInstanceOf('App\Subject',$question->subject);
    }

    
  
    public function question_can_make_string_path()
    { 

        $question = factory('App\Question')->create();
        $this->assertEquals('/questions/'.$question->subject->subslug.'/'.$question->id,$question->path());
    }
   
    /** @test */
     public function question_can_be_subscribed(){
         $question = factory('App\Question')->create();
       
       $question->subscribe($userId=1);
       $this->assertEquals(1,$question->subscriptions()->where('user_id',$userId)->count());

 }


    /** @test */
     public function question_can_be_unsubscribed(){
         $question = factory('App\Question')->create();
       
       $question->subscribe($userId=1);

       $question->unsubscribe($userId=1);
       $this->assertCount(0,$question->subscriptions);

      }

          /** @test */
     public function question_knows_auth_user_is_subscribed_to_it(){
         $question = factory('App\Question')->create();
           $user = factory('App\User')->create();
       $this->be($user); 

       $this->assertFalse($question->isSubscribedTo);
       
       $question->subscribe();

       $this->assertTrue($question->isSubscribedTo);

      }


   
}
