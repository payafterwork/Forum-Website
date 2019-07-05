<?php
use App\Answer;
use App\Question;
use App\Subject;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
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
        'subject_id' => function(){
            return factory('App\Subject')->create()->id;
        } 
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
$factory->define(Subject::class, function (Faker $faker) {
    $name = $faker->word;
    return [
        'subject' => $name,
        'subslug' => $name
    ];
});
$factory->define(\Illuminate\Notifications\DatabaseNotification::class, function ($faker) {
    return [
        'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
        'type' => 'App\Notifications\QuestionWasUpdated',
        'notifiable_id' => function () {
            return auth()->id() ?: factory('App\User')->create()->id;
        },
        'notifiable_type' => 'App\User',
        'data' => ['foo' => 'bar']
    ];
});