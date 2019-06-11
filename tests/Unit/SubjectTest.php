<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use Illuminate\Foundation\Testing\RefreshDatabase;

class SubjectTest extends TestCase
{
    use DatabaseMigrations;
   /** @test */
   public function subject_consist_of_questions()
    {
        $subject = factory('App\Subject')->create();
        $question =factory('App\Question')->create(['subject_id'=>$subject->id]);
        $this->assertTrue($subject->questions->contains($question));

    }
}
