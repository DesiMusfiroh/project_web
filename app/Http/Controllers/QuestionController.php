<?php

namespace App\Http\Controllers;

use App\PaketSoal;
use App\User;
use App\SoalSatuan;
use App\Essay;
use App\Pilgan;
use Illuminate\Http\Request;


class QuestionController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
        $paketsoal = PaketSoal::where('user_id',auth()->user()->id)->get();
        return view('question.index',compact(['paketsoal']));
    }

    public function create()
    {

        return view('question.create');
    }

    //untuk masuk ke view tambah soal satuan
    // public function getSingleQuestion($id){
    //   $paket_soal_id = PaketSoal::find($id);
    //  $soal_satuan = SoalSatuan::where('paket_soal_id',$id)->orderBy('id','asc')->get();
    //  return view('question.create_soal_satuan',compact('paket_soal_id','soal_satuan'));
    // }

    public function store(Request $request)
    {
        $paketsoal = new PaketSoal;
        $paketsoal->user_id = auth()->user()->id;
        $paketsoal->judul = $request->judul;
        $paketsoal->durasi = $request->durasi;
        $paketsoal->save();
        $paket_soal_id = $paketsoal->id;
        return redirect()->route('question_create_soal_satuan',['paket_soal_id' => $paket_soal_id]);

    }

    // public function show($id)
    // {
    //     //
    // }
    //
    // public function edit($id)
    // {
    //     //
    // }
    //
    // public function update(Request $request, $id)
    // {
    //     //
    // }
    //
    // public function destroy($id)
    // {
    //     //
    // }

    // SOAL SATUAN CRUD CONTROLLER
    public function create_soal_satuan($paket_soal_id){
        $soal_satuan = SoalSatuan::where('paket_soal_id',$paket_soal_id)->orderBy('id','asc')->get();
        $paket_soal = PaketSoal::find($paket_soal_id);
        $paket_soal_id = $paket_soal->id;
        return view('question.create_soal_satuan',['soal_satuan' => $soal_satuan], compact('paket_soal_id'));
    }

    public function essay_store(Request $request)
    {
        $this->validate($request,[
            'paket_soal_id'  => 'required',
            'poin'   => 'required',
            'jenis' => 'required',
            'pertanyaan' => 'required',
            'jawaban' => 'required',
        ]);
         $soal_satuan = new SoalSatuan;
         $soal_satuan = SoalSatuan::create([
            'paket_soal_id'  => $request->paket_soal_id,
            'poin'           => $request->poin,
            'jenis'          => $request->jenis,
        ]);

        $essay = $soal_satuan->Essay()->create([
            'soal_satuan_id' => $soal_satuan->soal_satuan_id,
            'pertanyaan'     => $request->pertanyaan,
            'jawaban'        => $request->jawaban,
        ]);
        $paket_soal_id = $request->paket_soal_id;
        $soal_satuan = SoalSatuan::where('paket_soal_id',$paket_soal_id)->orderBy('id','asc')->get();
        return redirect()->route('question_create_soal_satuan',['paket_soal_id' => $paket_soal_id]);
    }

    public function pilgan_store(Request $request)
    {
        $this->validate($request,[
            'paket_soal_id'  => 'required',
            'poin'   => 'required',
            'jenis' => 'required',
            'pertanyaan' => 'required',
            'pil_a' => 'required',
            'pil_b' => 'required',
            'pil_c' => 'required',
            'pil_d' => 'required',
            'pil_e' => 'required',
            'kunci' => 'required',
        ]);
         $soal_satuan = new SoalSatuan;
         $soal_satuan = SoalSatuan::create([
            'paket_soal_id'  => $request->paket_soal_id,
            'poin'           => $request->poin,
            'jenis'          => $request->jenis,
        ]);

        $pilgan= $soal_satuan->Pilgan()->create([
            'soal_satuan_id' => $soal_satuan->soal_satuan_id,
            'pertanyaan'     => $request->pertanyaan,
            'pil_a'         => $request->pil_a,
            'pil_b'         => $request->pil_b,
            'pil_c'         => $request->pil_c,
            'pil_d'         => $request->pil_d,
            'pil_e'         => $request->pil_e,
            'kunci'          => $request->kunci,
        ]);
        $paket_soal_id = $request->paket_soal_id;
        $soal_satuan = SoalSatuan::where('paket_soal_id',$paket_soal_id)->orderBy('id','desc')->get();
        return redirect()->route('question_create_soal_satuan',['paket_soal_id' => $paket_soal_id]);
    }

    public function delete_soal_satuan($paket_soal_id,$soal_satuan_id){
      $soal_satuan = SoalSatuan::find($soal_satuan_id);
      $soal_satuan->delete();
      //dd('oke');
      return redirect()->back()->with('sukses','Soal berhasil dihapus');
    }

}
