<?php

namespace App\Http\Controllers;
use App\PaketSoal;
use App\SoalSatuan;
use App\Ujian;
use App\Peserta;
use App\EssayJawab;
use App\PilganJawab;
use Str;
use Auth;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $ujian = Ujian::where('user_id',auth()->user()->id)->get();
        //  $ujian = Ujian::join('paket_soal',function ($join){
        //   $join->on('users.id','=','paket_soal.user_id')
        //        ->where('paket_soal.user','=',Auth::user()->id);
        // })->get();
        return view('exams.index',compact(['ujian']));
    }

    public function create()
    {
        $paketsoal = PaketSoal::where('user_id',auth()->user()->id)->get();
        return view('exams.create',compact(['paketsoal']));
    }

    public function store(Request $request)
    {
        $ujian = new Ujian;
        $ujian->paket_soal_id = $request->paket_soal_id;
        $ujian->user_id = auth()->user()->id;
        $ujian->nama_ujian = $request->nama_ujian;
        $ujian->kode_ujian = Str::random(6);
        $ujian->waktu_mulai = $request->waktu_mulai;
        $ujian->save();
        return redirect()->route('getExam');
    }

    public function edit($id)
    {
        // $ujian = Ujian::where('id',$id)->get();
        $ujian = Ujian::find($id);
        $paket_soal_id = Ujian::where('id',$id)->value('paket_soal_id');
        $paketsoal = PaketSoal::where('id',$paket_soal_id)->get();
        return view('exams.edit',[ 'paketsoal' => $paketsoal ], compact('ujian'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([

            'nama_ujian' => 'required',
            'paket_soal_id' => 'required',
            'waktu_mulai' => 'required'
        ]);
        $ujian = Ujian::find($id);
        $ujian->update($request->all());
        return redirect()->route('getExam')->with('sukses','Berhasil update ujian');
    }

    public function openMyExam($id){
        $ujian = Ujian::find($id);
        return view('exams.myexam',compact(['ujian']));
    }

//Koreksi
public function koreksi($id){
    $jawaban_essay = EssayJawab::all();
    $jawaban_pilgan = PilganJawab::all();
    $soal_satuan=SoalSatuan::all();
   
    return view('exams.koreksi', compact('jawaban_essay','jawaban_pilgan','soal_satuan'));
}

    public function joinExam(Request $request){
        //Ujian::attempt(['kode_ujian' => $request->kode_akses])
        if (Ujian::where('kode_ujian',$request->kode_akses)) {
            $peserta = new Peserta;
            $peserta->user_id = auth()->user()->id;
            $idujian = Ujian::where('kode_ujian',$request->kode_akses)->get();
            foreach ($idujian as $item) {
                $id = $item->id;
            }
            $peserta->ujian_id = $id;
            $peserta->nilai = 0;
            $peserta->save();
            return redirect()->route('home');
        }
    }

    public function waitExam($id)
    {
        $peserta = Peserta::find($id);
        $ujian = Ujian::where('id',$peserta->ujian_id)->first();
        $paket_soal_id = $ujian->paket_soal_id;
        $paket_soal = PaketSoal::where('id',$paket_soal_id)->get();
        $soal_satuan = SoalSatuan::where('paket_soal_id',$paket_soal_id)->orderBy('id','asc')->paginate(1);

        date_default_timezone_set("Asia/Jakarta"); // mengatur time zone untuk WIB.
        $waktu_mulai = date('F d, Y H:i:s', strtotime($ujian->waktu_mulai)); // mengubah bentuk string waktu mulai untuk digunakan pada date di js

        $durasi_jam   =  date('H', strtotime($ujian->paket_soal->durasi));
        $durasi_menit =  date('i', strtotime($ujian->paket_soal->durasi));
        $durasi_detik =  date('s', strtotime($ujian->paket_soal->durasi));

        // waktu selesai = waktu mulai + durasi
        $selesai = date_create($ujian->waktu_mulai);
        date_add($selesai, date_interval_create_from_date_string("$durasi_jam hours, $durasi_menit minutes, $durasi_detik seconds"));
        $waktu_selesai = date_format($selesai, 'Y-m-d H:i:s');

        return view('exams.wait',['soal_satuan' => $soal_satuan, 'ujian' => $ujian, 'peserta' => $peserta ], compact('paket_soal_id','waktu_mulai','waktu_selesai'));
    }

    function fetch_data(Request $request)
    {
        $ujian = Ujian::find($request->ujian_id);
        $paket_soal_id = $ujian->paket_soal_id;
        $paket_soal = PaketSoal::where('id',$paket_soal_id)->get();
        $soal_satuan = SoalSatuan::where('paket_soal_id',$paket_soal_id)->orderBy('id','asc')->paginate(1);
        if($request->ajax())
        {
            return view('exams.pagination_data', ['soal_satuan' => $soal_satuan, 'ujian' => $ujian], compact('paket_soal_id'))->render();
        }
    }

    public function runExam($id)
    {
        $ujian = Ujian::find($id);
        $paket_soal_id = $ujian->paket_soal_id;
        $paket_soal = PaketSoal::where('id',$paket_soal_id)->get();
        $soal_satuan = SoalSatuan::where('paket_soal_id',$paket_soal_id)->orderBy('id','asc')->get();

        date_default_timezone_set("Asia/Jakarta"); // mengatur time zone untuk WIB.
        $waktu_mulai = date('F d, Y H:i:s', strtotime($ujian->waktu_mulai)); // mengubah bentuk string waktu mulai untuk digunakan pada date di js

        $durasi_jam   =  date('H', strtotime($ujian->paket_soal->durasi));
        $durasi_menit =  date('i', strtotime($ujian->paket_soal->durasi));
        $durasi_detik =  date('s', strtotime($ujian->paket_soal->durasi));

        // waktu selesai = waktu mulai + durasi
        $selesai = date_create($ujian->waktu_mulai);
        date_add($selesai, date_interval_create_from_date_string("$durasi_jam hours, $durasi_menit minutes, $durasi_detik seconds"));
        $waktu_selesai = date_format($selesai, 'Y-m-d H:i:s');

        return view('exams.run',['soal_satuan' => $soal_satuan, 'ujian' => $ujian ], compact('paket_soal_id','waktu_mulai','waktu_selesai'));
    }

}
