<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PaketSoal;

class SoalSatuan extends Model
{
    protected $table ='soal_satuan';
    protected $fillable = ['paket_soal_id','no_soal','poin','jenis'];
    public function paket_soal() {
        return $this->belongsTo(PaketSoal::class);
    }
}
