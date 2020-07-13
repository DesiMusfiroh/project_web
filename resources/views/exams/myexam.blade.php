@extends('layouts/sidebar')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center"  style="border-radius: 20px 20px 0px 0px; background: #EDE5E5;">
                  <strong style="font-size: 18px;">{{$ujian->nama_ujian}}</strong>
                </div>
                <?php
                  $durasi_jam   =  date('H', strtotime($ujian->paket_soal->durasi));
                  $durasi_menit =  date('i', strtotime($ujian->paket_soal->durasi));
                ?>
                <div class="card-body">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-9">
                        <table>
                          <tr>
                            <td width="150px">Paket soal</td>
                            <td width="10px">:</td>
                            <th>{{$ujian->paket_soal->judul}}</th>
                          </tr>
                          <tr>
                            <td>Jumlah soal</td>
                            <td>:</td>
                            <th>{{$ujian->paket_soal->jumlah_soal()}} soal</th>
                          </tr>
                          <tr>
                            <td>Durasi</td>
                            <td>:</td>
                            <th>{{ $durasi_jam }} jam {{ $durasi_menit }} menit</th>
                          </tr>
                          <tr>
                            <td>Jadwal Ujian </td>
                            <td>:</td>
                            <th>{{$ujian->waktu_mulai}}</th>
                          </tr>
                        </table>
                      </div>
                      <div class="col-md-3">
                        <strong><p>Kode Akses Ujian :</p></strong> 
                        <div class="input-group mb-3" >
                          <input type="text" class="form-control" value="{{$ujian->kode_ujian}}" id="kode_ujian" style="background:#f0f5c1" readonly />
                          <div class="input-group-append">
                            <a href="/copy_kode_ujian"> <button type="button" class="btn btn-warning" onclick="copy_text()">Salin</button> </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="text-center"><h5><strong >Peserta Ujian</strong></h5></div>
                  @if ($ujian->peserta->count() != 0)
                  <table class="table table-striped table-bordered table-sm">
                        <thead class="thead-dark text-center">
                            <tr>
                                <th scope="col" style="width:50px">No.</th>
                                <th scope="col" >Nama Peserta</th>
                                <th scope="col" >Nilai</th>
                                <th scope="col" style="width:150px">&nbsp; Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($ujian->peserta as $item)
                            <tr>
                              <td class="text-center">{{$loop->iteration}}</td>
                              <td class="text-center">{{$item->user->name}}</td>
                              <td class="text-center">{{$item->nilai}}</td>
                              <td class="text-center">
                                  <a href="{{route('koreksi',$item->id)}}">
                                    @if ($item->nilai !== null)
                                    <button type="button" class="btn btn-info btn-sm" >
                                        <i class="fa-fa-eye"></i> Detail Hasil
                                    </button>
                                    @else
                                    <button type="button" class="btn btn-warning btn-sm" >
                                        <i class="fa-fa-eye"></i> Koreksi Jawaban
                                    </button>
                                    @endif
                                  </a>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                  @else
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <strong> Belum ada peserta yang mengikuti ujian ini !</strong>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function copy_text() {
        document.getElementById("kode_ujian").select();
        document.execCommand("copy");
        // alert("Kode Akses Ujian Berhasil di Copy !");
    }
</script>
@endsection
