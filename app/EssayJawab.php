<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Peserta;
use App\Essay;

class EssayJawab extends Model
{
    protected $table ='essay_jawab';
    protected $fillable = ['user_id','essay_id','peserta_id','jawab'];
    public function users() {
        return $this->belongsTo(User::class);
    }
    public function peserta(){
        return $this->belongsTo(Peserta::class);
    }
    public function essay(){
        return $this->belongsTo(Essay::class);
    }
}
