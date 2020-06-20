<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaketSoal extends Model
<<<<<<< HEAD
{  
    protected $table ='paket_soal';
    protected $fillable = ['user_id','judul','durasi'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function soal_satuan()
    {
    	return $this->hasOne(SoalSatuan::class,'paket_soal_id');
=======
{
    protected $table = 'paket_soal';

    protected $fillable = ['user_id','judul','durasi','created_at','updated_at'];

    public function user(){
      return $this->belongsTo(User::class);
>>>>>>> c54a3e37a14b446164c8116f21e94334f1198a77
    }
}
