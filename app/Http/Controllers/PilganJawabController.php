<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaketSoal;
use App\SoalSatuan;
use App\Ujian;
use App\Peserta;
use App\Pilgan;
use App\PilganJawab;
use Auth;

class PilganJawabController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request,[
            'user_id' => 'required',
            'peserta_id' => 'required',
            'pilgan_id' => 'required',
            'jawab_pilgan' => 'required'
        ]);

        $soal_satuan_id = Pilgan::whereId($request->pilgan_id)->value('soal_satuan_id');
        $poin = SoalSatuan::where('id',$soal_satuan_id)->value('poin');
        $kunci = Pilgan::whereId( $request->pilgan_id)->value('kunci');
        if ( $request->jawab_pilgan == $kunci ) {
            $score  = $poin;
            $status = "T";
        } elseif ( $request->jawab_pilgan != $kunci ) {
            $score  = 0;
            $status = "F"; 
        }
        $check_jawaban = PilganJawab::where('user_id', Auth::user()->id)
                                    ->where('pilgan_id', $request->pilgan_id)
                                    ->where('peserta_id', $request->peserta_id)->first();
        if (!$check_jawaban) {
            $posts = PilganJawab::create([
                'user_id' => $request->user_id,
                'peserta_id' => $request->peserta_id,
                'pilgan_id' => $request->pilgan_id,
                'jawab' => $request->jawab_pilgan,
                'score' => $score,
                'status' => $status
            ]);  
        } elseif ($check_jawaban) {
            $update_pilgan_jawab = [
                'user_id' => $request->user_id,
                'peserta_id' => $request->peserta_id,
                'pilgan_id' => $request->pilgan_id,
                'jawab' => $request->jawab_pilgan,
                'score' => $score,
                'status' => $status
            ];
            $posts = PilganJawab::where('user_id', Auth::user()->id)
                                ->where('pilgan_id', $request->pilgan_id)
                                ->where('peserta_id', $request->peserta_id)->update($update_pilgan_jawab);
        }
      
        return response()->json($posts);

    }
}
