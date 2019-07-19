<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::post('/questions/{subject}/{question}/answers','AnswerController@store');
Route::get('/questions/{subject}/{question}/answers','AnswerController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/questions','QuestionController@store');
Route::get('/questions/create','QuestionController@create');
Route::get('/questions/{subject?}','QuestionController@index');
Route::get('/questions/{subject}/{question}','QuestionController@show');
Route::post('/questions/{subject}/{question}/subscriptions','QuestionSubsciptionController@store')->middleware('auth');
Route::delete('/questions/{subject}/{question}/subscriptions','QuestionSubsciptionController@destroy')->middleware('auth');
Route::post('/answers/{answer}/favourites','FavouriteController@store');

Route::get('/profiles/{user}', 'ProfilesController@show');
Route::delete('/questions/{subject}/{question}','QuestionController@destroy');

Route::delete('/answers/{answer}','AnswerController@destroy');
Route::patch('/answers/{answer}','AnswerController@update');
Route::delete('/answers/{answer}/favourites', 'FavouriteController@destroy');
Route::get('/profiles/{user}/notifications/', 'UserNotificationsController@index');
Route::delete('/profiles/{user}/notifications/{notification}', 'UserNotificationsController@destroy');
Route::get('api/users','Api\UsersController@index');
Route::post('api/users/{user}/avatar','Api\UsersAvatarController@store')->middleware('auth');


?>