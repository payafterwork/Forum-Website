<?php

namespace Tests\Feature;
use App\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Redis;
class TrendingQuestionTest extends TestCase
{
   
    
   use DatabaseMigrations;
    
   /** @test */
   public function increments_question_score_each_time_it_is_read()
   { 

    Redis::del('trending_questions');
     $this->assertEmpty(Redis::zrevrange('trending_questions',0,-1));
     $question = factory('App\Question')->create();
     $this->call('GET',$question->path());

     $trending =Redis::zrevrange('trending_questions',0,-1);
     $this->assertCount(1,$trending);
  
     $this->assertEquals($question->qtitle,json_decode($trending[0])->title);



   }

  

}
