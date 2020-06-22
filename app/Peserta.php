<?php

namespace App;
use App\Ujian;
use App\User;
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
}
