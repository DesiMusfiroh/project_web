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
        $check_jawaban = PilganJawab::where('user_id', Auth::user()->id)
                                    ->where('pilgan_id', $request->pilgan_id)
                                    ->where('peserta_id', $request->peserta_id)->first();
        if (!$check_jawaban) {
            $posts = PilganJawab::create([
                'user_id' => $request->user_id,
                'peserta_id' => $request->peserta_id,
                'pilgan_id' => $request->pilgan_id,
                'jawab' => $request->jawab_pilgan,
                'score' => $request->score,
                'status' => $request->status
            ]);

        } elseif ($check_jawaban) {
            $update_pilgan_jawab = [
                'user_id' => $request->user_id,
                'peserta_id' => $request->peserta_id,
                'pilgan_id' => $request->pilgan_id,
                'jawab' => $request->jawab_pilgan,
                'score' => $request->score,
                'status' => $request->status
            ];
            $posts = PilganJawab::where('user_id', Auth::user()->id)
                                ->where('pilgan_id', $request->pilgan_id)
                                ->where('peserta_id', $request->peserta_id)->update($update_pilgan_jawab);
        }

        return response()->json($posts);

    }
}
