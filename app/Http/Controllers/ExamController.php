<?php

namespace App\Http\Controllers;
use App\PaketSoal;
use App\SoalSatuan;
use App\Ujian;
use App\Peserta;
use App\EssayJawab;
use App\PilganJawab;
use App\User;
use Str;
use Auth;
use Illuminate\Http\Request;
use Alert;

class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $ujian = Ujian::where('user_id',auth()->user()->id)->where('isdelete',false)->paginate(8);

        //  $ujian = Ujian::join('paket_soal',function ($join){
        //   $join->on('users.id','=','paket_soal.user_id')
        //        ->where('paket_soal.user','=',Auth::user()->id);
        // })->get();
        return view('exams.index',compact(['ujian']));
    }

    public function create()
    {
        $paketsoal = PaketSoal::where('user_id',auth()->user()->id)->where('isdelete',0)->get();
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
        $ujian->isdelete = false;
        $ujian->save();
        return redirect()->route('getExam')->with('success',"<p> $request->nama_ujian berhasil di buat ! </p>");
    }

    public function edit($id)
    {
        // $ujian = Ujian::where('id',$id)->get();
        $ownuser = Ujian::where('id',$id)->where('isdelete',0)->value('user_id');

        if (auth()->user()->id === $ownuser) {
          $ujian = Ujian::find($id);
          $paket_soal_id = Ujian::where('id',$id)->value('paket_soal_id');
          $paketsoal = PaketSoal::where('id',$paket_soal_id)->get();
          $paket_soal=PaketSoal::where('user_id',auth()->user()->id)->get();
          return view('exams.edit',[ 'paketsoal' => $paketsoal ], compact('ujian','paket_soal'));
        }else {
          $error = "Tidak bisa mengakses halaman";
          return view('error',compact(['error']));
        }

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
        return redirect()->route('getExam')->with('success', 'Data update ujian berhasil di update !');
    }

    public function delete($id) {
        $ujian = Ujian::find($id);
        Ujian::where('id',$ujian->id)->update([
          'isdelete' => true,
        ]);

        //dd($ujian->isdelete);
        // try {
        //   $ujian->update([
        //     'isdelete' => true,
        //   ]);
        //   dd($ujian);
        // } catch (\Exception $e) {
        //   dd("error");
        // }


        return redirect()->route('getExam')->with('success', 'Data ujian berhasil di hapus !');
    }

    public function openMyExam($id){
        $ujian = Ujian::find($id);
        return view('exams.myexam',compact(['ujian']));
    }

    //Koreksi
    public function koreksi($id){

        $peserta = Peserta::find($id);
        //soal yang belum di koreksi
        $essay_jawab = EssayJawab::where('peserta_id', $peserta->id)->where('score','!=',null)->get();
        $pilgan_jawab = PilganJawab::where('peserta_id', $peserta->id)->get();
        $koreksi_jawaban = EssayJawab::where('peserta_id', $peserta->id)->where('score','=',null)->get();

        $total_poin = SoalSatuan::where('paket_soal_id',$peserta->ujian->paket_soal->id)->sum('poin');

        $score_pilgan = PilganJawab::where('peserta_id',$peserta->id)->sum('score');

        if($koreksi_jawaban->count() == 0) {
            $score_essay = EssayJawab::where('peserta_id',$peserta->id)->sum('score');
            $total_score = $score_essay + $score_pilgan;
            $nilai_akhir = $total_score / $total_poin * 100;
            Peserta::where('id',$id)->update([
                'nilai' => $total_score
            ]);
            return view('exams.koreksi', ['peserta' => $peserta, 'essay_jawab' => $essay_jawab, 'pilgan_jawab' => $pilgan_jawab, 'koreksi_jawaban' => $koreksi_jawaban], compact('nilai_akhir','total_poin'));
        }

        return view('exams.koreksi', ['peserta' => $peserta, 'essay_jawab' => $essay_jawab, 'pilgan_jawab' => $pilgan_jawab, 'koreksi_jawaban' => $koreksi_jawaban]);
    }

    public function joinExam(Request $request){
        //Ujian::attempt(['kode_ujian' => $request->kode_akses])
        try {
          if (Ujian::where('kode_ujian',$request->kode_akses)) {
              $peserta = new Peserta;
              $peserta->user_id = auth()->user()->id;
              $idujian = Ujian::where('kode_ujian',$request->kode_akses)->get();
              foreach ($idujian as $item) {
                  $id = $item->id;
              }
              $peserta->ujian_id = $id;
              $peserta->nilai = null;
              if (Peserta::where('ujian_id',$id)->where('user_id',auth()->user()->id)->exists()) {
                return redirect()->route('home')->with('info','Kamu sudah tergabung di ujian ini');
              }else {
                $peserta->save();
                return redirect()->route('home')->withSuccess('Berhasil mengikuti ujian baru');
              }
          }
        } catch (\Exception $e) {
          return redirect()->back()->with('tidakditemukan','Kode tidak ditemukan');
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
        $peserta = Peserta::find($request->peserta_id);
        $ujian = Ujian::where('id',$peserta->ujian_id)->first();
        $paket_soal_id = $ujian->paket_soal_id;
        $paket_soal = PaketSoal::where('id',$paket_soal_id)->get();
        $soal_satuan = SoalSatuan::where('paket_soal_id',$paket_soal_id)->orderBy('id','asc')->paginate(1);
        if($request->ajax())
        {
            return view('exams.pagination_data', ['soal_satuan' => $soal_satuan, 'ujian' => $ujian, 'peserta' => $peserta ], compact('paket_soal_id'))->render();
        }
    }

    // public function runExam($id)
    // {
    //     $ujian = Ujian::find($id);
    //     $paket_soal_id = $ujian->paket_soal_id;
    //     $paket_soal = PaketSoal::where('id',$paket_soal_id)->get();
    //     $soal_satuan = SoalSatuan::where('paket_soal_id',$paket_soal_id)->orderBy('id','asc')->get();

    //     date_default_timezone_set("Asia/Jakarta"); // mengatur time zone untuk WIB.
    //     $waktu_mulai = date('F d, Y H:i:s', strtotime($ujian->waktu_mulai)); // mengubah bentuk string waktu mulai untuk digunakan pada date di js

    //     $durasi_jam   =  date('H', strtotime($ujian->paket_soal->durasi));
    //     $durasi_menit =  date('i', strtotime($ujian->paket_soal->durasi));
    //     $durasi_detik =  date('s', strtotime($ujian->paket_soal->durasi));

    //     // waktu selesai = waktu mulai + durasi
    //     $selesai = date_create($ujian->waktu_mulai);
    //     date_add($selesai, date_interval_create_from_date_string("$durasi_jam hours, $durasi_menit minutes, $durasi_detik seconds"));
    //     $waktu_selesai = date_format($selesai, 'Y-m-d H:i:s');

    //     return view('exams.run',['soal_satuan' => $soal_satuan, 'ujian' => $ujian ], compact('paket_soal_id','waktu_mulai','waktu_selesai'));
    // }

    public function finishExam($id){
        $peserta = Peserta::find($id);
        $update_finish_peserta = [
            'status' => 1,
        ];
        Peserta::where('id', $id)->update($update_finish_peserta);
        return redirect()->route('home')->with('info','Ujian telah diselesaikan, jawaban anda telah tersimpan !');
    }

    public function copy_kode(){
        return redirect()->back()->with('success','Kode akses ujian berhasil di salin !');
    }

    public function room_exam() {
        $ujian_aktif = Ujian::where('user_id',Auth::user()->id)->where('status',0)->where('isdelete',0)->get();
        $ujian_run = Ujian::where('user_id',Auth::user()->id)->where('status',1)->where('isdelete',0)->get();
        date_default_timezone_set("Asia/Jakarta");

        // membuat array untuk menyimpan data ujian yang aktif
        $array[] = ['id','paket_soal_id','nama_ujian', 'waktu_mulai','status','start','finish'];
        foreach($ujian_aktif as $key =>$value)
        {
            $start  = date('F d, Y H:i:s', strtotime($value->waktu_mulai));
            $durasi_jam   =  date('H', strtotime($value->paket_soal->durasi));
            $durasi_menit =  date('i', strtotime($value->paket_soal->durasi));
            $durasi_detik =  date('s', strtotime($value->paket_soal->durasi));
            // waktu selesai = waktu mulai + durasi
            $selesai = date_create($value->waktu_mulai);
            date_add($selesai, date_interval_create_from_date_string("$durasi_jam hours, $durasi_menit minutes, $durasi_detik seconds"));
            $finish = date_format($selesai, 'Y-m-d H:i:s');

            $array[++$key] = [
                $value->id,
                $value->paket_soal_id,
                $value->nama_ujian,
                $value->waktu_mulai,
                $value->status,
                $start,
                $finish,
            ];
        }

        // membuat array untuk menyimpan data ujian run
        $run[] = ['id','paket_soal_id','nama_ujian', 'waktu_mulai','status','start','finish'];
        foreach($ujian_run as $key =>$value)
        {
            $start  = date('F d, Y H:i:s', strtotime($value->waktu_mulai));
            $durasi_jam   =  date('H', strtotime($value->paket_soal->durasi));
            $durasi_menit =  date('i', strtotime($value->paket_soal->durasi));
            $durasi_detik =  date('s', strtotime($value->paket_soal->durasi));
            // waktu selesai = waktu mulai + durasi
            $selesai = date_create($value->waktu_mulai);
            date_add($selesai, date_interval_create_from_date_string("$durasi_jam hours, $durasi_menit minutes, $durasi_detik seconds"));
            $finish = date_format($selesai, 'Y-m-d H:i:s');

            $run[++$key] = [
                $value->id,
                $value->paket_soal_id,
                $value->nama_ujian,
                $value->waktu_mulai,
                $value->status,
                $start,
                $finish,
            ];
        }

        return view('exams.room',compact('ujian_aktif','ujian_run'))->with('tabel',json_encode($array))->with('run',json_encode($run));
    }

    public function run_exam(Request $request) {

        $update_status_ujian = [
            'status' => 1
        ];
        $posts = Ujian::where('id',$request->ujian_id)->update($update_status_ujian);

        return response()->json($posts);
    }

    public function stop_exam(Request $request) {

        $update_status_ujian = [
            'status' => 2
        ];
        $posts = Ujian::where('id',$request->ujian_id)->update($update_status_ujian);

        return response()->json($posts);
    }

    public function fullscreen_room(Request $request) {
        // $ujian_room = Ujian::find($request->ujian_id);
        $nama_ujian     = Ujian::where('id', $request->ujian_id)->value('nama_ujian');
        $waktu_mulai    = Ujian::where('id', $request->ujian_id)->value('waktu_mulai');
        $paket_soal_id    = Ujian::where('id', $request->ujian_id)->value('paket_soal_id');
        $durasi          = PaketSoal::where('id',$paket_soal_id)->value('durasi');

        date_default_timezone_set("Asia/Jakarta"); // mengatur time zone untuk WIB.
        $durasi_jam   =  date('H', strtotime($durasi));
        $durasi_menit =  date('i', strtotime($durasi));
        $durasi_detik =  date('s', strtotime($durasi));
        // waktu selesai = waktu mulai + durasi
        $selesai = date_create($waktu_mulai);
        date_add($selesai, date_interval_create_from_date_string("$durasi_jam hours, $durasi_menit minutes, $durasi_detik seconds"));
        $waktu_selesai = date_format($selesai, 'Y-m-d H:i:s');

        $peserta    = Peserta::where('ujian_id',$request->ujian_id)->get();
        $array_peserta[] = ['nama_peserta'];
        foreach($peserta as $key =>$value)
        {
            $array_peserta[++$key] = [
                $value->user->name,
            ];
        }

        return response()->json(array(
            'nama_ujian'    => $nama_ujian,
            'waktu_mulai'   => $waktu_mulai,
            'durasi'        => $durasi,
            'waktu_selesai' => $waktu_selesai,
            'array_peserta' => $array_peserta,
        ));
    }

}
