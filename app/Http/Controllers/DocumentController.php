<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaketSoal;
use App\SoalSatuan;
use App\Ujian;
use App\Peserta;
use App\Profil;
use App\Pilgan;
use App\Essay;
use App\EssayJawab;
use App\PilganJawab;
use PDF;
use Str;
use Auth;
class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }
    // public function downloadHasil()
    // {
    //     $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    //     $objWriter->save('Appdividend.docx');
    //     return response()->download(public_path('Appdividend.docx'));
    // }
    public function genereteHasil($id){
        $ujian = Ujian::find($id);
        $pdf = PDF::loadView('exams/myResult',compact('ujian'));
        return $pdf->stream();
    }
    public function generatePDF($id)

    {
        $peserta = Peserta::find($id);
        $institusi   = Profil::where('user_id',$peserta->user->id)->value('institusi');
        $no_hp      = Profil::where('user_id',$peserta->user->id)->value('no_hp');
        $essay_jawab = EssayJawab::where('peserta_id', $peserta->id)->where('score','!=',null)->get();
        $pilgan_jawab = PilganJawab::where('peserta_id', $peserta->id)->get();

        $total_poin = SoalSatuan::where('paket_soal_id',$peserta->ujian->paket_soal->id)->sum('poin');
        $score_pilgan = PilganJawab::where('peserta_id',$peserta->id)->sum('score');
        $score_essay = EssayJawab::where('peserta_id',$peserta->id)->sum('score');
        $total_score = $score_essay + $score_pilgan;
        $nilai_akhir = $total_score / $total_poin * 100;
        $pdf = PDF::loadView('exams/myPDF',compact('peserta','essay_jawab','pilgan_jawab','institusi','no_hp','nilai_akhir'));
        return $pdf->stream();

    }

    public function exportSoal($id){

      $institusi   = Profil::where('user_id',auth()->user()->id)->value('institusi');
      $soal_satuan = SoalSatuan::where('paket_soal_id',$id)->orderBy('id','asc')->get();
      $ownuser = PaketSoal::where('id',$id)->value('user_id');
      if (auth()->user()->id == $ownuser) {
        $soal_pilgan = SoalSatuan::where('jenis','Pilihan Ganda')->where('paket_soal_id',$id)->orderBy('id','asc')->get();
        $soal_essay = SoalSatuan::where('jenis','Essay')->where('paket_soal_id',$id)->orderBy('id','asc')->get();
        $paket_soal = PaketSoal::find($id);
        //$paket_soal_id = $paket_soal->id;


        $pdf = PDF::loadView('question/exportsoal',compact(['institusi','soal_satuan','paket_soal','soal_pilgan','soal_essay']));
        return $pdf->stream();
      }else {
        $error = "Tidak dapat mengakses halaman";
        return view('error',compact(['error']));
      }

    }
    public function exportJawaban($id){
        $soal_satuan = SoalSatuan::where('paket_soal_id',$id)->orderBy('id','asc')->get();
        $ownuser = PaketSoal::where('id',$id)->value('user_id');
        if (auth()->user()->id == $ownuser) {

          $soal_pilgan = SoalSatuan::where('jenis','Pilihan Ganda')->where('paket_soal_id',$id)->orderBy('id','asc')->get();
          $soal_essay = SoalSatuan::where('jenis','Essay')->where('paket_soal_id',$id)->orderBy('id','asc')->get();

          $paket_soal = PaketSoal::find($id);

          $pdf = PDF::loadView('question/exportjawaban',compact(['soal_satuan','paket_soal','soal_pilgan','soal_essay',]));
          return $pdf->stream();
        }else {
          $error = "Tidak dapat mengakses halaman";
          return view('error',compact(['error']));
        }
      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
