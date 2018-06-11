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



Auth::routes();


Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@home')->name('home');


Route::get('/questionaire/', 'QuizController@index')->name('quiz');
Route::get('/questionaire/create', 'QuizController@createQuiz')->name('createQuiz');
Route::get('/questionaire/delete/{id?}', 'QuizController@deleteQuiz')->name('deleteQuiz');

Route::post('/questionaire/create/save', 'QuizController@createQuizSave')->name('createQuizSave');



Route::get('/question/create/{quiz_id?}', 'QuestionController@createQuestion')->name('createQuestion');


Route::get('/question/add/', 'QuestionController@addQuestion')->name('addQuestion');

Route::get('/question/type/change', 'QuestionController@changeQuestionType')->name('changeQuestionType');

Route::get('/question/add/choice', 'QuestionController@addChoice')->name('addChoice');

Route::get('/question/delete/choice', 'QuestionController@deleteChoice')->name('deleteChoice');

Route::get('/question/delete/', 'QuestionController@deleteQuestion')->name('deleteQuestion');


Route::get('/question/save', 'QuestionController@questionSave')->name('questionSave');






