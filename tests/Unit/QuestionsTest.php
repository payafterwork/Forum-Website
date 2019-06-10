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

    
   /** @test */
    public function question_can_make_string_path()
    { 

        $question = factory('App\Question')->create();
        $this->assertEquals('/questions/'.$question->subject->subslug.'/'.$question->id,$question->path());
    }

   
}
