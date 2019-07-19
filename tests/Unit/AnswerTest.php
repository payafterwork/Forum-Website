<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use Illuminate\Foundation\Testing\RefreshDatabase;

class AnswerTest extends TestCase
{
    use DatabaseMigrations;
   /** @test */
    public function answer_has_an_owner()
    {
      $answer = factory('App\Answer')->create();
      $response = $this->assertInstanceOf('App\User',$answer->owner);   
    }
     /** @test */
    public function can_detect_all_mentioned_users_in_ans()
    {
      $answer = factory('App\Answer')->create([
			'ans' => "@JaneDoe wants to talk to @JohnDoe"
      ]);
      $this->assertEquals(['JaneDoe','JohnDoe'],$answer->mentionedUsers($answer));
    }


     /** @test */
    public function wraps_mentioned_usernames_in_ans_within_anchor_tags()
    {
      $answer = factory('App\Answer')->create([
			'ans' => "@JaneDoe wants to talk"
      ]);
      $this->assertEquals('<a href="/profiles/JaneDoe">@JaneDoe</a> wants to talk',$answer->ans);
    }


    

}
