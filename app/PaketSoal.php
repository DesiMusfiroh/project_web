<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaketSoal extends Model
{
    protected $table = 'paket_soal';

    protected $fillable = ['user_id','judul','durasi','created_at','updated_at'];

    public function user(){
      return $this->belongsTo(User::class);
    }
}
