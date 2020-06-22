@extends('layouts.sidebar')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Paket Soal</h4>
                        </div>
                        <div class="col-md-6 ">
                            <div class="text-right" style="font-size:20px; font-family:segoe ui black; font-weight:bold;">
                                <a href="/question_create"> <button type="button" class="btn" style="background-color:#7BEDC4;">
                                    [ <i class="fa fa-plus"></i> ]  Buat Paket Soal Baru </button>
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
                                <th scope="col" >Judul Paket Soal </th>
                                <th scope="col" style="width:100px">Durasi </th>
                                <th scope="col" style="width:100px">Jumlah Soal </th>
                                <th scope="col" style="width:100px">Opsi</th>        
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; ?>                                                 
                            @foreach ($paketsoal as $item) 
                            <tr>
                                <td scope="row" class="text-center"><?php  $i++;  echo $i; ?></td>
                                <td >{{ $item->judul }}</td>
                                <td class="text-center">{{ $item->durasi }} menit</td>    
                                <td class="text-center"> xxxx </td>                             
                                <td class="text-center">
                                    <a href="{{route('question_create_soal_satuan',$item->id)}}">
                                        <button type="button" class="btn btn-warning btn-sm">  
                                            <i class="fa fa-edit fa-sm"></i>           
                                        </button>
                                    </a>
                                    <a href="">
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

@endsection
