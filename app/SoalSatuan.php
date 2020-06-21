<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PaketSoal;
use App\Essay;

class SoalSatuan extends Model
{
    protected $table ='soal_satuan';
    protected $fillable = ['paket_soal_id','poin','jenis'];
    public function paket_soal() {
        return $this->belongsTo(PaketSoal::class);
    }
    public function essay()
    {
    	return $this->hasOne(Essay::class,'soal_satuan_id');
    }
}
