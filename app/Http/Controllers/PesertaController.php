<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaketSoal;
use App\SoalSatuan;
use App\Ujian;
use App\Peserta;
use Str;
use Auth;

class PesertaController extends Controller
{   
    public function resultIndex(){
        $peserta = Peserta::where('user_id',auth()->user()->id)->where('status','=',1)->paginate(8);
        return view('exams.result_index',compact(['peserta']));
    }
    public function resultDetail($id){
        $peserta = Peserta::where('id',$id)->get();
        return view('exams.result_detail',compact(['peserta']));
    }
}
