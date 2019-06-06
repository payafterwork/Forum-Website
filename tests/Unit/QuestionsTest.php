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

   
}
