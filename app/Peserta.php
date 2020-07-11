<?php

namespace App;
use App\Ujian;
use App\PilganJawab;
use App\EssayJawab;
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
    public function essay_jawab(){
      return $this->hasMany(EssayJawab::class,'peserta_id');
    }
    public function pilgan_jawab(){
      return $this->hasMany(PilganJawab::class,'peserta_id');
    }
}
