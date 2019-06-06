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
}
