<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes(['verify' => true]);

Route::get('home', 'HomeController@index')->name('home');

Route::get('profil','ProfilController@index');
Route::post('profil/store','ProfilController@store');
Route::get('profil/edit/{id}', 'ProfilController@edit');
Route::patch('profil/update/{id}', 'ProfilController@update');


Route::get('question','QuestionController@index')->name('question');
Route::get('question_create','QuestionController@create');
Route::post('question_store','QuestionController@store')->name('paketSoalStore');
//essay
Route::post('question_store/essay_store','QuestionController@essay_store')->name('storeSingleQuestionEssay');
//pilgan
Route::post('question_store/pilgan_store','QuestionController@pilgan_store')->name('storeSingleQuestionPilgan');

Route::get('/question/{id}','QuestionController@getSingleQuestion')->name('getSingleQuestion');


Route::get('/exam','ExamController@index')->name('getExam');
Route::get('/exam/create','ExamController@create')->name('createExam');
Route::post('/exam/create/store','ExamController@store')->name('storeExam');
