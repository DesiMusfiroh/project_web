<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Profil extends Model
{
    protected $table ='profil';
    protected $fillable = ['user_id','foto','no_hp','alamat','institusi','jk'];
    public function user() {
        return $this->belongsTo(User::class);
    }
}
