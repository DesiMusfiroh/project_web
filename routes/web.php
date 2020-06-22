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

// route profil
Route::get('profil','ProfilController@index');
Route::post('profil/store','ProfilController@store');
Route::get('profil/edit/{id}', 'ProfilController@edit');
Route::patch('profil/update/{id}', 'ProfilController@update');


Route::get('question','QuestionController@index')->name('question'); //route untuk halaman utama paket soal
Route::get('question_create','QuestionController@create'); // route untuk tampilan buat paket soal baru
Route::post('question_store','QuestionController@store')->name('paketSoalStore'); // route store untuk menyimpan paket soal baru 
Route::get('question_create_soal_satuan/{paket_soal_id}','QuestionController@create_soal_satuan', ['$paket_soal_id' =>'paket_soal_id'])->name('question_create_soal_satuan'); // route untuk menuju ke kelola soal satuan

//essay
Route::post('question_store/essay_store','QuestionController@essay_store')->name('storeSingleQuestionEssay');
//pilgan
Route::post('question_store/pilgan_store','QuestionController@pilgan_store')->name('storeSingleQuestionPilgan');

// Route::get('/question/{id}','QuestionController@getSingleQuestion')->name('getSingleQuestion');
