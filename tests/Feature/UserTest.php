<?php

namespace Tests\Feature;
use App\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
   
    
   use DatabaseMigrations;
    
   /** @test */
   public function user_can_determine_their_avatar_path()
   {
      $userwithavatar = factory('App\User')->create(['avatar_path'=>'avatars/me.jpg']);
        $this->assertEquals('avatars/me.jpg',$userwithavatar->avatars());
        $userwithoutavatar = factory('App\User')->create();
        $this->assertEquals('avatars/default.jpg',$userwithoutavatar->avatars());     

   }

}
