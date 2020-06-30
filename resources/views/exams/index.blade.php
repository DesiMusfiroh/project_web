@extends('layouts.sidebar')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            Ujian
                        </div>
                        <div class="col-md-6 ">
                            <div class="text-right" style="font-size:20px; font-family:segoe ui black; font-weight:bold;">
                                <a href="{{route('createExam')}}"> <button type="button" class="btn" style="background-color:#7BEDC4;">
                                    [ <i class="fa fa-plus"></i> ]  Buat Ujian </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">


                <table class="table table-striped table-bordered table-sm">
                        <thead class="thead-light text-center">
                            <tr>
                                <th scope="col" style="width:50px">No</th>
                                <th scope="col" >Nama Ujian </th>
                                <th scope="col" >Judul Paket Soal </th>
                                <th scope="col" >Jadwal Ujian </th>
                                <th scope="col" style="width:100px">Opsi</th>        
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; ?>                                                 
                            @foreach ($ujian as $item) 
                            <tr>
                                <td scope="row" class="text-center"><?php  $i++;  echo $i; ?></td>
                                <td >{{$item->nama_ujian}}</td>
                                <td class="text-center">{{ $item->paket_soal->judul }} </td>    
                                <td class="text-center"> {{$item->waktu_mulai}} </td>                             
                                <td class="text-center">
                                    <a href="{{route('editExam',$item->id)}}">
                                        <button type="button" class="btn btn-warning btn-sm">  
                                            <i class="fa fa-edit fa-sm"></i>           
                                        </button>
                                    </a>
                                    <a href="{{route('deleteExam',$item->id)}}">
                                        <button type="button" class="btn btn-danger btn-sm">  
                                            <i class="fa fa-trash fa-sm"></i>        
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
