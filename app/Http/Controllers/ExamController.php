<?php

namespace App\Http\Controllers;
use App\PaketSoal;
use App\Ujian;
use App\Peserta;
use Str;
use Auth;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index(){
    //$ujian = Ujian::where('paket_soal_id');
    //$paket_soal_id = Auth::user()->paket_soal->id;

      $ujian = Ujian::where('user_id',auth()->user()->id)->get();
      // $ujian = Ujian::join('paket_soal',function ($join){
      //   $join->on('users.id','=','paket_soal.user_id')
      //        ->where('paket_soal.user','=',Auth::user()->id);
      // })->get();
      return view('exams.index',compact(['ujian']));
    }

    public function create(){
      $paketsoal = PaketSoal::where('user_id',auth()->user()->id)->get();
      return view('exams.create',compact(['paketsoal']));
    }

    public function store(Request $request){
      $ujian = new Ujian;
      $ujian->paket_soal_id = $request->paket_soal_id;
      $ujian->user_id = auth()->user()->id;
      $ujian->nama_ujian = $request->nama_ujian;
      $ujian->kode_ujian = Str::random(6);
      $ujian->waktu_mulai = $request->waktu_mulai;
      $ujian->save();
      return redirect()->route('getExam');
    }

    public function joinExam(Request $request){
      //Ujian::attempt(['kode_ujian' => $request->kode_akses])
      if (Ujian::where('kode_ujian',$request->kode_akses)) {
        $peserta = new Peserta;
        $peserta->user_id = auth()->user()->id;
        $idujian = Ujian::where('kode_ujian',$request->kode_akses)->get();
        foreach ($idujian as $item) {
          $id = $item->id;
        }
        $peserta->ujian_id = $id;
        $peserta->nilai = 0;
        //dd($peserta);
        $peserta->save();
      }

      return redirect()->route('home');
    }
}
