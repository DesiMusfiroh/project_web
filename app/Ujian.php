<?php

namespace App;
use App\PaketSoal;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    protected $table = 'ujian';
    protected $fillable = ['paket_soal_id','nama_ujian','kode_ujian','waktu_mulai'];

    public function paket_soal(){
      return $this->belongsTo(PaketSoal::class);
    }

}
