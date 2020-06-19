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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profil','ProfilController@index');
Route::post('/profil/store','ProfilController@store');
Route::get('/profil/edit/{id}', 'ProfilController@edit');

Route::get('/question/create','QuestionController@create');
Route::post('/question/create/post','QuestionController@store')->name('postQuestionPackage');
