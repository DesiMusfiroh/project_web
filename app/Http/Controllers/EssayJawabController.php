<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaketSoal;
use App\SoalSatuan;
use App\Ujian;
use App\Peserta;
use App\Essay;
use App\EssayJawab;
use Auth;
use Alert;

class EssayJawabController extends Controller
{
    public function store(Request $request)
    {

        $this->validate($request,[
            'user_id' => 'required',
            'peserta_id' => 'required',
            'essay_id' => 'required',
            'jawab_essay' => 'required'
        ]);

        $check_jawaban = EssayJawab::where('user_id', Auth::user()->id)
                                ->where('essay_id', $request->essay_id)
                                ->where('peserta_id', $request->peserta_id)->first();
        if (!$check_jawaban) {
            $posts = EssayJawab::create([
                'user_id' => $request->user_id,
                'peserta_id' => $request->peserta_id,
                'essay_id' => $request->essay_id,
                'jawab' => $request->jawab_essay,
            ]);  
        } elseif ($check_jawaban) {
            $update_essay_jawab = [
                'user_id' => $request->user_id,
                'peserta_id' => $request->peserta_id,
                'essay_id' => $request->essay_id,
                'jawab' => $request->jawab_essay,
            ];
            $posts = EssayJawab::where('user_id', Auth::user()->id)
                                ->where('essay_id', $request->essay_id)
                                ->where('peserta_id', $request->peserta_id)->update($update_essay_jawab);
        }
      
        return response()->json($posts);
    }

    public function updateScore(Request $request)
    {
        $essay_jawab = EssayJawab::findOrFail($request->id);
        $update_essay_jawab = [
            'score' => $request->score
        ];
        EssayJawab::where('id', $request->id)->update($update_essay_jawab);
        return redirect()->back();
    }
}
