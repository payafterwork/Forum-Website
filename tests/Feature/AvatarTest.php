<?php

namespace Tests\Feature;
use App\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AvatarTest extends TestCase
{
   
    
   use DatabaseMigrations;
    
   /** @test */
   public function non_member_cant_add_avators()
   { 
     $this->json('POST','api/users/1/avatar')
          ->assertStatus(401); //Unautherized status code

   }

   /** @test */
    public function tells_us_if_image_provided_is_not_valid()
    {
        $this->withExceptionHandling();
        $user = factory('App\User')->create();
       $this->be($user); // Used for making authenticated user
        $this->json('POST', 'api/users/' . auth()->id() . '/avatar', [
            'avatar' => 'not-an-image'
        ])->assertStatus(422); //We got the data, but can't work on it.
    }
      

        /** @test */
    public function members_can_add_avatar_to_their_profile()
    {
        $user = factory('App\User')->create();
       $this->be($user); // Used for making authenticated user
               Storage::fake('public');

        $this->json('POST', 'api/users/' . auth()->id() . '/avatar', [
            'avatar' => $file = UploadedFile::fake()->image('avatar.jpg')
        ]);
         $this->assertEquals(asset('avatars/'.$file->hashName()), auth()->user()->avatar_path);
        Storage::disk('public')->assertExists('avatars/' . $file->hashName());

    }
   


}
