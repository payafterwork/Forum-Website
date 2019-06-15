<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfilesTest extends TestCase
{
   use DatabaseMigrations;
    /** @test */

  /** @test */ 
      public function user_can_profile()
    {
       $user = factory('App\User')->create();
       $this->get('/user/{$user->name}')
       ->assertSee($user->name);
     

     }
 
  /** @test */ 
      public function userprofile_list_all_q_by_user()
    {
       $user = factory('App\User')->create();
       $question = factory('App\Question')->create(['user_id'=>$user->id]);

       $this->get('/user/{{$user->name}}')
       ->assertSee($question->qtitle)
       ->assertSee($question->qdetails);
     

     }

}

// :)