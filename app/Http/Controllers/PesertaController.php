<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaketSoal;
use App\SoalSatuan;
use App\Ujian;
use App\Peserta;
use App\Profil;
use App\EssayJawab;
use App\PilganJawab;
use Str;
use Auth;

class PesertaController extends Controller
{
    public function resultIndex(){
        $peserta = Peserta::where('user_id',auth()->user()->id)->where('status','=',1)->paginate(8);
        return view('exams.result_index',compact(['peserta']));
    }
    public function resultDetail($id){
      $peserta = Peserta::find($id); 
      $fotoprofil = Profil::where('user_id',$peserta->user->id)->value('foto');
      $institusi   = Profil::where('user_id',$peserta->user->id)->value('institusi');
      $no_hp      = Profil::where('user_id',$peserta->user->id)->value('no_hp');
      //soal yang belum di koreksi
      $essay_jawab = EssayJawab::where('peserta_id', $peserta->id)->where('score','!=',null)->get();
      $pilgan_jawab = PilganJawab::where('peserta_id', $peserta->id)->get();
      $koreksi_jawaban = EssayJawab::where('peserta_id', $peserta->id)->where('score','=',null)->get();

      $total_poin = SoalSatuan::where('paket_soal_id',$peserta->ujian->paket_soal->id)->sum('poin');

      $score_pilgan = PilganJawab::where('peserta_id',$peserta->id)->sum('score');

      if($koreksi_jawaban->count() == 0) {
          $score_essay = EssayJawab::where('peserta_id',$peserta->id)->sum('score');
          $total_score = $score_essay + $score_pilgan;
          $nilai_akhir = $total_score / $total_poin * 100;
          Peserta::where('id',$id)->update([
              'nilai' => $total_score
          ]);
          return view('exams.result_detail', ['peserta' => $peserta, 'essay_jawab' => $essay_jawab, 'pilgan_jawab' => $pilgan_jawab, 'koreksi_jawaban' => $koreksi_jawaban], compact('nilai_akhir','total_poin','fotoprofil','institusi','no_hp'));
      }

      return view('exams.result_detail', ['peserta' => $peserta, 'essay_jawab' => $essay_jawab, 'pilgan_jawab' => $pilgan_jawab, 'koreksi_jawaban' => $koreksi_jawaban],compact(['fotoprofil','institusi','no_hp']));
        // $peserta = Peserta::find($id);
        // $fotoprofil = Profil::where('user_id',$peserta->user->id)->value('foto');
        // $institusi   = Profil::where('user_id',$peserta->user->id)->value('institusi');
        // $no_hp      = Profil::where('user_id',$peserta->user->id)->value('no_hp');
        // $total_poin = SoalSatuan::where('paket_soal_id',$peserta->ujian->paket_soal->id)->sum('poin');
        // return view('exams.result_detail',compact(['peserta','fotoprofil','institusi','no_hp']));
    }
}
