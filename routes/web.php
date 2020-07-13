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
Route::get('/logout','HomeController@logout')->name('logout');
// route profil
Route::get('profil','ProfilController@index');
Route::post('profil/store','ProfilController@store')->name('storeProfil');
Route::get('profil/edit', 'ProfilController@edit');
Route::patch('profil/update', 'ProfilController@update');

Route::get('question','QuestionController@index')->name('question'); //route untuk halaman utama paket soal
Route::get('question_create','QuestionController@create'); // route untuk tampilan buat paket soal baru
Route::post('question_store','QuestionController@store')->name('paketSoalStore'); // route store untuk menyimpan paket soal baru
Route::get('question_create_soal_satuan/{paket_soal_id}','QuestionController@create_soal_satuan', ['$paket_soal_id' =>'paket_soal_id'])->name('question_create_soal_satuan'); // route untuk menuju ke kelola soal satuan
Route::get('question_create_soal_satuan/{paket_soal_id}/{soal_satuan_id}/hapus','QuestionController@delete_soal_satuan', ['$paket_soal_id' =>'paket_soal_id','$soal_satuan_id'=>'soal_satuan_id'])->name('deleteSoalSatuan');
//cetak
//Route::get('exams/downloadhasil','DocumentController@downloadHasil');
// Route::post('store','DocumentController@store');
// Route::post('question/createdocument','DocumentController@index');
Route::get('hasilpdf/{id}','DocumentController@generatePDF')->name('hasil_pdf');

//update
Route::patch('question_create_soal_satuan/{paket_soal_id}/updateessay','QuestionController@update_soal_satuan_essay', ['$paket_soal_id' =>'paket_soal_id'])->name('updateSoalSatuan');
Route::patch('question_create_soal_satuan/{paket_soal_id}/updatepil','QuestionController@update_soal_satuan_pilgan', ['$paket_soal_id' =>'paket_soal_id'])->name('updateSoalSatuanPil');

//essay
Route::post('question_store/essay_store','QuestionController@essay_store')->name('storeSingleQuestionEssay');
//pilgan
Route::post('question_store/pilgan_store','QuestionController@pilgan_store')->name('storeSingleQuestionPilgan');

//Route::get('/question/{id}','QuestionController@getSingleQuestion')->name('getSingleQuestion');

Route::get('/exam','ExamController@index')->name('getExam');
Route::get('/exam/create','ExamController@create')->name('createExam');
Route::post('/exam/create/store','ExamController@store')->name('storeExam');
Route::get('/exam/edit/{id}','ExamController@edit')->name('editExam');
Route::patch('/exam/update/{id}','ExamController@update')->name('updateExam');
Route::get('/exam/delete/{id}','ExamController@delete')->name('deleteExam');
Route::get('/copy_kode_ujian','ExamController@copy_kode');
Route::get('/roomexam','ExamController@room_exam')->name('roomExam');
Route::get('run/exam','ExamController@run_exam');


//Route untuk masuk ke ujian miliknya sendiri
Route::get('/exam/{id}/open','ExamController@openMyExam')->name('openMyExam');

Route::get('/exam/{id}/koreksi','ExamController@koreksi')->name('koreksi');

Route::post('/joinexam','ExamController@joinExam')->name('joinExam');
Route::get('/waitexam/{id}','ExamController@waitExam',['id'=> 'id'])->name('waitExam');
Route::get('pagination/fetch_data', 'ExamController@fetch_data');
Route::get('/runexam/{id}','ExamController@runExam',['id'=> 'id'])->name('runExam');
Route::get('/finishexam/{id}','ExamController@finishExam',['id'=> 'id'])->name('finishExam');

// menyimpan jawaban essay dan pilgan peserta ujian
Route::get('store/essay_jawab', 'EssayJawabController@store');
Route::get('store/pilgan_jawab', 'PilganJawabController@store');
Route::patch('/essay_jawab/score/update', 'EssayJawabController@updateScore');

Route::get('/resultexam','PesertaController@resultIndex')->name('resultExam');
Route::get('/resultdetail/{id}','PesertaController@resultDetail')->name('resultDetail');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
