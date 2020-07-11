<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Profil;
use App\Ujian;
use App\Peserta;
use App\PaketSoal;
use App\EssayJawab;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    public function profil()
    {
    	return $this->hasOne(Profil::class,'user_id');
    }
    public function paket_soal(){
        return $this->hasMany(PaketSoal::class,'user_id');
      }

    public function ujian(){
      return $this->hasMany(Ujian::class,'user_id');
    }

    public function peserta(){
      return $this->hasMany(Peserta::class,'user_id');
    }

    public function essay_jawab(){
      return $this->hasMany(EssayJawab::class,'user_id');
    }
    
    public function pilgan_jawab(){
      return $this->hasMany(PilganJawab::class,'user_id');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
