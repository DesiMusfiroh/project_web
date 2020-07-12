@extends('layouts/sidebar')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card"  style="border-radius:20px;  box-shadow: 10px 10px 5px rgba(48, 10, 64, 0.5);">
                <div class="card-header text-center"  style="border-radius: 20px 20px 0px 0px; background: #EDE5E5;">
                  <strong style="font-size: 18px;">{{$ujian->nama_ujian}}</strong>
                </div>
                <?php
                  $durasi_jam   =  date('H', strtotime($ujian->paket_soal->durasi));
                  $durasi_menit =  date('i', strtotime($ujian->paket_soal->durasi));
                ?>
                <div class="card-body">
                  <div class="row container">
                    <div class="col-md-8">
                      <table>
                        <tr>
                          <td width="150px">Paket soal</td>
                          <td>:</td>
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
                      </table>
                    </div>
                    <div class="col-md-4 text-right">
                      <div class="alert alert-success">Status Ujian </div>
                    </div>
                  </div>
                  
                  <div class="text-center"><h5><strong >Peserta Ujian</strong></h5></div>
                  
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

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
