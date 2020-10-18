<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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

// Home
Route::get('/home', 'HomeController@index')->name('home');

// Question
Route::get('/create_question', 'QuestionController@createQuestionIndex')->name('create_question-01');
Route::post('/create_question', 'QuestionController@createQuestion')->name('create_question-02');
Route::get('/edit_question/{room:id}', 'QuestionController@editQuestionIndex')->name('edit_question-03');
Route::patch('/edit_question/{room:id}', 'QuestionController@editQuestion')->name('edit_question-04');
Route::delete('/delete_question/{room:id}', 'QuestionController@deleteQuestion')->name('delete_question-05');

// Room
Route::get('/room/{room:id}', 'RoomController@index')->name('room-01');
Route::post('/post/{roomId}', 'RoomController@post')->name('room-02');
