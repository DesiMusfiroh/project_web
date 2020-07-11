<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Peserta;
use App\Pilgan;

class PilganJawab extends Model
{
    protected $table ='pilgan_jawab';
    protected $fillable = ['user_id','pilgan_id','peserta_id','jawab'];
    public function users() {
        return $this->belongsTo(User::class);
    }
    public function peserta(){
        return $this->belongsTo(Peserta::class);
    }
    public function pilgan(){
        return $this->belongsTo(Pilgan::class);
    }
}
