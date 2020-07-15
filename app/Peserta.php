<?php

namespace App;
use App\Ujian;
use App\PilganJawab;
use App\EssayJawab;
use App\User;
use App\SoalSatuan;
use App\PaketSoal;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $table = 'peserta';
    protected $fillable = ['ujian_id','user_id','nilai'];

    public function ujian(){
      return $this->belongsTo(Ujian::class);
    }

    public function user(){
      return $this->belongsTo(User::class);
    }
    public function essay_jawab(){
      return $this->hasMany(EssayJawab::class,'peserta_id');
    }
    public function pilgan_jawab(){
      return $this->hasMany(PilganJawab::class,'peserta_id');
    }

    public function total_nilai(){
      $id_peserta = $this->id;
      $total_poin = SoalSatuan::where('paket_soal_id',$this->ujian->paket_soal->id)->sum('poin');
      $score_pilgan = PilganJawab::where('peserta_id',$id_peserta)->sum('score');
      $score_essay = EssayJawab::where('peserta_id',$id_peserta)->where('score','!=',null)->sum('score');
      $poin_didapat = $score_pilgan + $score_essay;
      $nilai_akhir = $poin_didapat / $total_poin * 100;
      $nilai_akhir = substr($nilai_akhir, 0, 5);
      return $nilai_akhir;
    }
}
