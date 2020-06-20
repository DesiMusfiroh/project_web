<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaketSoal extends Model
{  
    protected $table ='paket_soal';
    protected $fillable = ['user_id','judul','durasi'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function soal_satuan()
    {
    	return $this->hasOne(SoalSatuan::class,'paket_soal_id');
    }
}
