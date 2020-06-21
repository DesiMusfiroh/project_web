<?php

namespace App\Http\Controllers;
use App\PaketSoal;
use App\User;
use App\SoalSatuan;
use App\Essay;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    public function index()
    {
        return view('question.index');
    }

    public function create()
    {
        
        return view('question.create');
    }

    public function store(Request $request)
    {
        $paketsoal = new PaketSoal;
        $paketsoal->user_id = auth()->user()->id;
        $paketsoal->judul = $request->judul;
        $paketsoal->durasi = $request->durasi;
        $paketsoal->save();

        $paket_soal_id = PaketSoal::max('id'); // mengambil data paket_soal_id untuk dipakai pada data soal satuan yang dibuat nanti
        return view('question.create_soal_satuan',compact('paket_soal_id'));
       
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    // SOAL SATUAN CRUD CONTROLLER
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
        return view('question.create_soal_satuan',compact('paket_soal_id'))
        ->with('success','Great! Soal baru berhasil ditambahkan');
    }
}
