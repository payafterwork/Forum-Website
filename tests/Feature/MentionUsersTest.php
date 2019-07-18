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
         $this->json('post', $question->path() . '/answers', $answer->toArray());
       
         $this->assertCount(1,$harshit->notifications);
     
    }
}
