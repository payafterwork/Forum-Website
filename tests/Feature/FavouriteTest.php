<?php

namespace Tests\Feature;
use App\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\DatabaseMigrations;

class FavouriteTest extends TestCase
{
   
    
   use DatabaseMigrations;
    
   /** @test */
   public function auth_user_can_favourite_answers()
   {    $user = factory('App\User')->create();
       $this->be($user); // Used for making authenticated user
       $answer = factory('App\Answer')->create();
       $this->post('answers/'.$answer->id.'/favourites');
        $this->assertCount(1,$answer->favourites);
        
   }

   /** @test */
   public function guest_cannot_favourite_answers()
   {
      
       $this->post('answers/1/favourites')
         ->assertRedirect('/login');
        
   }

    /** @test */
   public function auth_user_only_can_favourite_answer_once()
   {
      
       $user = factory('App\User')->create();
       $this->be($user); // Used for making authenticated user
       $answer = factory('App\Answer')->create();
      try{
       $this->post('answers/'.$answer->id.'/favourites');
       $this->post('answers/'.$answer->id.'/favourites');
     }catch(\Exception $e){
      $this->fail('Did not expect same record twice');

     } 
        $this->assertCount(1,$answer->favourites);
        
   }
      
   


}
