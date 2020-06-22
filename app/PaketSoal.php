<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Ujian;
use App\SoalSatuan;

class PaketSoal extends Model
{
    protected $table ='paket_soal';
    protected $fillable = ['user_id','judul','durasi'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function soal_satuan()
    {
    	return $this->hasMany(SoalSatuan::class,'paket_soal_id');
    }

    public function ujian(){
      return $this->hasMany(Ujian::class,'paket_soal_id');
    }

}
