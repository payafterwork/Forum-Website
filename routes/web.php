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
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/questions','QuestionController@store');
Route::get('/questions/create','QuestionController@create');
Route::get('/questions/{subject?}','QuestionController@index');
Route::get('/questions/{subject}/{question}','QuestionController@show');

Route::delete('/answers/{answer}','AnswerController@destroy');
Route::delete('/questions/{subject}/{question}','QuestionController@destroy');
Route::patch('/answers/{answer}','AnswerController@update');
Route::post('/answers/{answer}/favourites','FavouriteController@store');
Route::get('/user/{user}','ProfilesController@show');
?>