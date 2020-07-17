@extends('layouts.sidebar')

@section('content')
@if(session('pesan'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{session('pesan')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if(session('tidakditemukan'))
  <script>
    $(document).ready(function(){
      swal({
        title: "Oops",
        text: "Kode ujian tidak ditemukan",
        icon: "warning",
      });
    });
  </script>
@endif
<div class="container">
    <div class="alert alert-success mb-4" role="alert">
        <h5 class="alert-heading"> <strong> Hai  {{ Auth::user()->name }}, Selamat datang di Website LiveEx! </strong></h5>
        <p> <img src="/images/LiveEx.png" alt="" width="60px;">  adalah website yang dibangun dengan tujuan untuk mempermudah pelaksanaan ujian secara daring dengan fitur live video demi meningkatkan pengawasan dan meminimalisir kecurangan saat ujian berlangsung. </p>
    <hr>
        Sudah punya kode akses untuk ujian?
        <a type="button" style="color: #blue" data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-primary">  Klik disini</a>

    </div>

@if($peserta->count() != 0)

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"  style="border-radius:20px 20px 0px 0px; ">
                <strong style="font-size:18px;">Ujian yang akan dikerjakan</strong>
            </div>
            <div class="card-body">
                <div class="table-inside">
                    <table class="table table-striped table-bordered table-sm">
                        <thead class="thead-dark text-center">
                            <tr>
                                <th scope="col" style="width:50px">No</th>
                                <th scope="col" >Nama Ujian </th>
                                <th scope="col" >Waktu Mulai </th>
                                <th scope="col" >Durasi </th>
                                <th scope="col" >Keterangan </th>
                                <th scope="col" style="width:100px">Detail </th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; ?>
                            @foreach ($peserta as $item)
                            <tr>
                                <td scope="row" class="text-center"><?php  $i++;  echo $i; ?></td>
                                <td >{{$item->ujian->nama_ujian}}</td>
                                <td class="text-center">{{$item->ujian->waktu_mulai}} </td>
                                <td class="text-center">{{$item->ujian->paket_soal->durasi}} </td>
                                <td class="text-center">
                                    <?php
                                    if ($item->ujian->status == 0) {
                                        echo "ujian segera dimulai";
                                    } elseif ($item->ujian->status == 1) {
                                        echo "ujian sedang berlangsung";
                                    } elseif ($item->ujian->status == 2) {
                                        echo "ujian telah berakhir";
                                    }
                                        // $waktu_sekarang = date('Y-m-d H:i:s');
                                        // $waktu_mulai    =$item->ujian->waktu_mulai;
                                        // $durasi = $item->ujian->paket_soal->durasi;

                                        // $durasi_jam   =  date('H', strtotime($durasi));
                                        // $durasi_menit =  date('i', strtotime($durasi));
                                        // $durasi_detik =  date('s', strtotime($durasi));

                                        // $selesai = date_create($waktu_mulai);
                                        // date_add($selesai, date_interval_create_from_date_string("$durasi_jam hours, $durasi_menit minutes, $durasi_detik seconds"));
                                        // $waktu_selesai  = date_format($selesai, 'Y-m-d H:i:s');

                                        // if (strtotime($waktu_sekarang) < strtotime($waktu_mulai)) {
                                        //     echo "segera dimulai";
                                        // }
                                        // elseif (strtotime($waktu_sekarang) > strtotime($waktu_selesai)) {
                                        //     echo "ujian telah berakhir";
                                        // }
                                        // elseif (strtotime($waktu_sekarang) >= strtotime($waktu_mulai) && strtotime($waktu_sekarang) <= strtotime($waktu_selesai)) {
                                        //     echo "ujian sedang berlangsung";
                                        // }
                                    ?>
                                </td>
                                <td class="text-center"><a href="{{route('waitExam',$item->id)}}">
                                      <button type="button" class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit fa-sm"></i> Masuk
                                        </button> </a>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                    <div class="ml-1">
                      {{$peserta->links()}}
                    </div>


            </div>
        </div>
    </div>
</div>

@endif
<div  class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="border-radius:2px;  box-shadow: 3px 3px 5px grey;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Join Exam</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                     {{ session('status') }}
                </div>
            @endif
        <form method="POST" action="{{ route('joinExam') }}">
            @csrf
                <div class="form-row align-items-center">
                    <div class="col-sm-8  offset-md-1">
                         <input style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;"id="kode_akses" type="kode_akses" class="form-control @error('kode_akses') is-invalid @enderror" name="kode_akses" required placeholder="Masukkan Kode Akses">
                    </div>
                    <div class="col-sm-2 ">
                        <button type="submit" class="btn btn-success" style="border-radius:10px; box-shadow: 3px 3px 5px grey;">
                            <strong> {{ __('Join') }}</strong>
                        </button>
                    </div>
                </div>
        </form>
     </div>
      <div class="modal-footer col-auto">
       Nb : Kode akses hanya diperoleh dari guru/dosen!
    </div>
  </div>
</div>
</div>
@endsection
