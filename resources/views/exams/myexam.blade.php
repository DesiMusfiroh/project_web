@extends('layouts/sidebar')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            {{$ujian->nama_ujian}}
                        </div>
                        <!-- <div class="col-md-6 ">
                            <div class="text-right" style="font-size:20px; font-family:segoe ui black; font-weight:bold;">
                                <a href="{{route('createExam')}}"> <button type="button" class="btn" style="background-color:#7BEDC4; border: none; box-shadow: 3px 3px 3px rgba(119, 52, 171, 0.46);">
                                    [ <i class="fa fa-plus"></i> ]  Buat Ujian </button>
                                </a>
                            </div>
                        </div> -->
                    </div>
                </div>
                <?php
                  $durasi_jam   =  date('H', strtotime($ujian->paket_soal->durasi));
                  $durasi_menit =  date('i', strtotime($ujian->paket_soal->durasi));
                ?>
                <div class="card-body">
                    <table>
                      <tr>
                        <td>Paket soal</td>
                        <td>:</td>
                        <th>{{$ujian->paket_soal->judul}}</th>
                      </tr>
                      <tr>
                        <td>Jumlah soal</td>
                        <td>:</td>
                        <th>{{$ujian->paket_soal->jumlah_soal()}}</th>
                      </tr>
                      <tr>
                        <td>Durasi</td>
                        <td>:</td>
                        <th>{{ $durasi_jam }} jam {{ $durasi_menit }} menit</th>
                      </tr>
                    </table>
                    <div id="teks"></div>
                  <h3>Peserta</h3>
                <table class="table table-striped table-bordered table-sm">
                        <thead class="thead-light text-center">
                            <tr>
                                <th scope="col" style="width:50px">No.</th>
                                <th scope="col" >Nama </th>
                                <th>Nilai</th>
                                <th scope="col" >&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($ujian->peserta as $item)
                            <tr>
                              <td>{{$loop->iteration}}</td>
                              <td class="text-center">{{$item->user->name}}</td>
                              <td class="text-center">{{$item->nilai}}</td>
                              <td class="text-center">  <a href="{{route('koreksi',$item->id)}}">
                                        <button type="button" class="btn btn-info btn-sm" >
                                        Koreksi
                                        </button>

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
