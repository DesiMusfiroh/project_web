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
})->name('welcome');
Route::get('/tim', function () {
    return view('tim');
});

Route::get('/hubungi', function () {
    return view('hubungi');
});
Auth::routes(['verify' => true]);

Route::get('home', 'HomeController@index')->name('home');
Route::get('/logout','HomeController@logout')->name('logout');

// ROUTE PROFIL -----------------------------------------------------------------------------------------
Route::get('profil','ProfilController@index');
Route::post('profil/store','ProfilController@store')->name('storeProfil');
Route::get('profil/edit', 'ProfilController@edit');
Route::patch('profil/update', 'ProfilController@update');

// ROUTE QUESTION -----------------------------------------------------------------------------------------
Route::get('question','QuestionController@index')->name('question'); //route untuk halaman utama paket soal
Route::patch('question/update','QuestionController@updatePaketSoal'); //route untuk update paket soal
Route::get('question/delete/{id}','QuestionController@deletePaketSoal')->name('deletePaketSoal');
Route::get('question_create','QuestionController@create'); // route untuk tampilan buat paket soal baru
Route::post('question_store','QuestionController@store')->name('paketSoalStore'); // route store untuk menyimpan paket soal baru
Route::get('question_create_soal_satuan/{paket_soal_id}','QuestionController@create_soal_satuan', ['$paket_soal_id' =>'paket_soal_id'])->name('question_create_soal_satuan'); // route untuk menuju ke kelola soal satuan
Route::get('question_create_soal_satuan/hapus/{paket_soal_id}/{soal_satuan_id}','QuestionController@delete_soal_satuan', ['$paket_soal_id' =>'paket_soal_id','$soal_satuan_id'=>'soal_satuan_id'])->name('deleteSoalSatuan');
//cetak
// Route::get('exams/downloadhasil','DocumentController@downloadHasil');
// Route::post('store','DocumentController@store');
// Route::post('question/createdocument','DocumentController@index');
// Export hasil ujian
Route::get('hasilpdf/{id}','DocumentController@generatePDF')->name('hasil_pdf');
//Export Soal
Route::get('question/exportSoal/{id}','DocumentController@exportSoal')->name('exportSoal');
//Export Kunci
Route::get('question/exportJawaban/{id}','DocumentController@exportJawaban')->name('exportJawaban');

// update question
Route::patch('question_create_soal_satuan/{paket_soal_id}/updateessay','QuestionController@update_soal_satuan_essay', ['$paket_soal_id' =>'paket_soal_id'])->name('updateSoalSatuan');
Route::patch('question_create_soal_satuan/{paket_soal_id}/updatepil','QuestionController@update_soal_satuan_pilgan', ['$paket_soal_id' =>'paket_soal_id'])->name('updateSoalSatuanPil');

// essay
Route::post('question_store/essay_store','QuestionController@essay_store')->name('storeSingleQuestionEssay');
// pilgan
Route::post('question_store/pilgan_store','QuestionController@pilgan_store')->name('storeSingleQuestionPilgan');

//Route::get('/question/{id}','QuestionController@getSingleQuestion')->name('getSingleQuestion');

// ROUTE EXAM -----------------------------------------------------------------------------------------
Route::get('/exam','ExamController@index')->name('getExam');
Route::get('/exam/create','ExamController@create')->name('createExam');
Route::post('/exam/create/store','ExamController@store')->name('storeExam');
Route::get('/exam/edit/{id}','ExamController@edit')->name('editExam');
Route::patch('/exam/update/{id}','ExamController@update')->name('updateExam');
Route::get('/exam/delete/{id}','ExamController@delete',['$id'=>'id'])->name('deleteExam');
Route::get('/copy_kode_ujian','ExamController@copy_kode');
Route::get('/roomexam','ExamController@room_exam')->name('roomExam');
Route::get('run/exam','ExamController@run_exam');
Route::get('stop/exam','ExamController@stop_exam');
Route::get('fullscreen/room/exam','ExamController@fullscreen_room');


//Route untuk masuk ke ujian miliknya sendiri
Route::get('/exam/{id}/open','ExamController@openMyExam')->name('openMyExam');
//cetak hasil ujian
Route::get('/exam/{id}','DocumentController@genereteHasil')->name('downloadHasil');

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

// -----------------------------------------------------------------------------------------
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
