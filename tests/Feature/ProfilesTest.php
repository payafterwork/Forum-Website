<?php
namespace Tests\Feature;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
class ProfilesTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    function a_user_has_a_profile()
    {
        $user = factory('App\User')->create();
        $this->get("/profiles/{$user->name}")
            ->assertSee($user->name);
    }
    /** @test */
    function profiles_display_all_threads_created_by_the_associated_user()
    {
        $user = factory('App\User')->create();
        $question = factory('App\Question')->create(['user_id' => $user->id]);       
        $this->get("/profiles/{$user->name}")
            ->assertSee($question->title)
            ->assertSee($question->body);
    }
}