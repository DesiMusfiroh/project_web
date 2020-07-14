<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use App\PaketSoal;
use App\User;
use App\SoalSatuan;
use App\Essay;
use App\Pilgan;
use Illuminate\Http\Request;
use Alert;

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

    // SOAL SATUAN CRUD CONTROLLER
    public function create_soal_satuan($paket_soal_id){
      $ownuser = PaketSoal::where('id',$paket_soal_id)->value('user_id');
      //agar dia cuma bisa akses paket soal yg dimilikinya
      if (auth()->user()->id === $ownuser) {
          $soal_satuan = SoalSatuan::where('paket_soal_id',$paket_soal_id)->orderBy('id','asc')->get();
          $paket_soal = PaketSoal::find($paket_soal_id);
          $paket_soal_id = $paket_soal->id;
          return view('question.create_soal_satuan',['soal_satuan' => $soal_satuan, 'paket_soal' => $paket_soal], compact('paket_soal_id'));
        }else {
          $error = "Tidak bisa mengakses halaman";
          return view('error',compact(['error']));
        }

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
        return redirect()->back()->with('sukses','Soal berhasil dihapus');
    }

    public function update_soal_satuan_essay(Request $request, $paket_soal_id){
        $paket_soal = PaketSoal::findorFail($paket_soal_id);
        $essay      = Essay::findorFail($request->id);

        $update_essay = [
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
        ];
        $essay->update($update_essay);

        $update_poin = [
            'poin' => $request->poin,
        ];
        SoalSatuan::whereId($essay->soal_satuan_id)->update($update_poin);

        return redirect()->back()->withSuccess('Perubahan berhasil disimpan');
    }

    public function update_soal_satuan_pilgan(Request $request, $paket_soal_id){
        $paket_soal = PaketSoal::findorFail($paket_soal_id);
        $pilgan      = Pilgan::findorFail($request->id);

        $update_pilgan = [
            'pertanyaan' => $request->pertanyaan,
            'pil_a' => $request->pil_a,
            'pil_b' => $request->pil_b,
            'pil_c' => $request->pil_c,
            'pil_d' => $request->pil_d,
            'pil_e' => $request->pil_e,
            'kunci' => $request->kunci,
        ];
        $pilgan->update($update_pilgan);

        $update_poin = [
            'poin' => $request->poin,
        ];
        SoalSatuan::whereId($pilgan->soal_satuan_id)->update($update_poin);

        return redirect()->back()->with('sukses','Soal berhasil diupdate');
    }

    public function updatePaketSoal(Request $request){
        $paket_soal = PaketSoal::findorFail($request->id);
        $update_paket = [
            'judul' => $request->judul,
            'durasi' => $request->durasi,
        ];
        $paket_soal->update($update_paket);
        return redirect()->back()->withSuccess('Perubahan berhasil disimpan');
    }
}
