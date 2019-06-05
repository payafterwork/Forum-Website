<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Question;
use App\Answer;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});


$factory->define(Question::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return factory('App\User')->create()->id;
        },
        'qnop' => $faker->sentence,
        'qtitle' => $faker->sentence,
        'qdetails' => $faker->sentence,
       
     ];
});

$factory->define(Answer::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return factory('App\User')->create()->id;
        },
        'question_id' => function(){
            return factory('App\Question')->create()->id;
        },
        'rating' => $faker->numberBetween($min = 0, $max = 5),
        'ans' => $faker->sentence
     ];
});

