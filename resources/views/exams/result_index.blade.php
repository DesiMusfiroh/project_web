@extends('layouts.sidebar')
@section('content')
@if(session('sukses'))
  <div class="alert alert-success" role="alert">
    {{session('sukses')}}
  </div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center"  style="border-radius: 20px 20px 0px 0px; background: #EDE5E5;">
                    <strong style="font-size:18px"> Hasil Ujian </strong>
                    
                </div>

                <div class="card-body">

                @if($peserta->count() != 0) 
                <table class="table table-striped table-bordered table-sm" >
                        <thead class="thead-dark text-center">
                            <tr>
                                <th scope="col" style="width:50px">No</th>
                                <th scope="col" >Nama Ujian </th>
                                <th scope="col" >Judul Paket Soal </th>
                                <th scope="col" >Tanggal Ujian </th>
                                <th scope="col" >Nilai Ujian </th>
                                <th scope="col" style="width:150px">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; ?>
                            @foreach ($peserta as $item)
                            <tr>
                                <td scope="row" class="text-center"><?php  $i++;  echo $i; ?></td>
                                <td >{{$item->ujian->nama_ujian}}</td>
                                <td class="text-center">{{ $item->ujian->paket_soal->judul }} </td>
                                <td class="text-center"> {{date("d-m-Y",strtotime($item->ujian->waktu_mulai))}} </td>
                                <td class="text-center"> @if ($item->nilai !== null) {{ $item->nilai }} @else -@endif </td>
                                <td class="text-center">
                                    <a href="{{route('resultDetail',$item->id)}}">
                                        <button type="button" class="btn btn-info btn-sm">
                                            <i class="fa fa-eye fa-sm"></i> Detail
                                        </button>
                                    </a>
                                   
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong> Belum ada ujian yang di telah dikerjakan. </strong>
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
@endsection
