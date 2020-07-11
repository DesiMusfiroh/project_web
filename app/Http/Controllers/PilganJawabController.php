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
            'jawab_pilgan' => 'required',
            'score' => 'required',
            'status' => 'required'
        ]);
<<<<<<< HEAD
=======

        $soal_satuan_id = Pilgan::whereId($request->pilgan_id)->value('soal_satuan_id');
        $poin = SoalSatuan::where('id',$soal_satuan_id)->value('poin');
        $kunci = Pilgan::whereId( $request->pilgan_id)->value('kunci');
        //$nilai = Peserta::where('user_id',auth()->user()->id)->value('nilai');
        if ( $request->jawab_pilgan == $kunci ) {
            $score  = $poin;
            $status = "T";
        } elseif ( $request->jawab_pilgan != $kunci ) {
            $score  = 0;
            $status = "F";
        }
>>>>>>> c2271c84c0fa8b98c35791b5698a1375ec72603c
        $check_jawaban = PilganJawab::where('user_id', Auth::user()->id)
                                    ->where('pilgan_id', $request->pilgan_id)
                                    ->where('peserta_id', $request->peserta_id)->first();
        if (!$check_jawaban) {
            $posts = PilganJawab::create([
                'user_id' => $request->user_id,
                'peserta_id' => $request->peserta_id,
                'pilgan_id' => $request->pilgan_id,
                'jawab' => $request->jawab_pilgan,
<<<<<<< HEAD
                'score' => $request->score,
                'status' => $request->status
            ]);  
=======
                'score' => $score,
                'status' => $status
            ]);
            // $nilai += $score;
            // Peserta::where('id',$request->peserta_id)->update([
            // 'nilai' => $nilai
            // ]);
            $sum_score = PilganJawab::where('peserta_id',$request->peserta_id)->sum('score');
            Peserta::where('user_id',auth()->user()->id)->where('ujian_id',$request->peserta_id)->update([
            'nilai' => $sum_score
            ]);
>>>>>>> c2271c84c0fa8b98c35791b5698a1375ec72603c
        } elseif ($check_jawaban) {
            $update_pilgan_jawab = [
                'user_id' => $request->user_id,
                'peserta_id' => $request->peserta_id,
                'pilgan_id' => $request->pilgan_id,
                'jawab' => $request->jawab_pilgan,
                'score' => $request->score,
                'status' => $request->status
            ];
            $sum_score = PilganJawab::where('peserta_id',$request->peserta_id)->sum('score');
            Peserta::where('user_id',auth()->user()->id)->where('ujian_id',$request->peserta_id)->update([
            'nilai' => $sum_score
            ]);
            $posts = PilganJawab::where('user_id', Auth::user()->id)
                                ->where('pilgan_id', $request->pilgan_id)
                                ->where('peserta_id', $request->peserta_id)->update($update_pilgan_jawab);
            // $nilai += $score;
            // Peserta::where('id',$request->peserta_id)->update([
            // 'nilai' => $nilai
            // ]);

        }

        return response()->json($posts);

    }
}
