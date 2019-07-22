<?php

namespace Tests\Feature;
use App\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Redis;
use App\Trending;
class TrendingQuestionTest extends TestCase
{
   
    
   use DatabaseMigrations;
    
   /** @test */
   public function increments_question_score_each_time_it_is_read()
   { 

    $this->trending = new Trending();
    $this->trending->reset();
   
     $this->assertEmpty($this->trending->get());

     $question = factory('App\Question')->create();
    
     $this->call('GET',$question->path());

     $this->assertCount(1,$trending = $this->trending->get());
  
     $this->assertEquals($question->qtitle,$trending[0]->title);





   }

  

}
