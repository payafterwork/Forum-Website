<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MentionUsersTest extends TestCase
{
     use DatabaseMigrations;
    /** @test */
    public function mentioned_users_in_answer_are_notified()
    {
        $john = factory('App\User')->create(['name'=>'JohnDoe']);
         $this->be($john); // Used for making 

         $harshit = factory('App\User')->create(['name'=>'HarshitBatra']);

         $question = factory('App\Question')->create();

          $answer = $question->addAnswer([
            'user_id'=>$john->id,
                // An answer from someone else
            'ans'=>'@HarshitBatra look at this.'
         ]);
          $this->assertCount(1,$harshit->notifications);
     
    }

    /** @test */
    public function fetch_mentioned_users_starting_with_typing_characaters()
    {
        factory('App\User')->create(['name'=>'johndoe']);
        factory('App\User')->create(['name'=>'johndoe1']);
        factory('App\User')->create(['name'=>'janedoe2']);


        $results = $this->json('GET', '/api/users', ['name' => 'john']);
        $this->assertCount(2, $results->json());
     
    }


}
