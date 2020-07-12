@extends('layouts.sidebar')
@section('content')
<?php
use App\Ujian ; 
?>
<div class="col-md-12">
    <div class="card" style="border-radius:20px;  box-shadow: 10px 10px 5px rgba(48, 10, 64, 0.5);">
        <div class="card-header  pt-3 pb-2 text-center" style="border-radius: 20px 20px 0px 0px; background-color:#7BEDC4;">
            <h4 class="card-title"> Edit ujian  </h4>
        </div>
        <div class="card-body">

            <div class="container">

              <form class="" action="{{route('updateExam',$ujian->id)}}" method="post" class="form-control">
                @method('PATCH')
                @csrf
                <div class="row">
                  <div class="col-md-3">
                    <label for="">Nama Ujian</label>
                  </div>
                  <div class="col-md-5">
                    <input type="text" name="nama_ujian" value="{{$ujian->nama_ujian}}" class="form-control" >
                  </div>
                </div>
                 <div class="row mt-2">
                  <div class="col-md-3">
                    <label for="">Pilih paket soal</label>
                  </div>
                  <div class="col-md-5">
                    <select class="form-control" name="paket_soal_id" value="" >
                      <option value="{{$ujian->paket_soal->id}}" >{{$ujian->paket_soal->judul}}</option>
                      @foreach($paket_soal as $item)
                      <option value="{{$item->id}}"> {{$item->judul}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <!-- <div class="row mt-2">
                  <div class="col-md-3">
                    <label for="">Paket Soal</label>
                  </div>
                  <div class="col-md-7">
                    <input type="text"  name="paket_soal_id" value = "{{$ujian->paket_soal->judul}}"  disabled> <span style="color:red">*paket  soal tidak bisa di ubah</span>
                  </div>
                </div> -->
                <div class="row mt-2">
                  <div class="col-md-3">
                    <label for="">Waktu mulai</label>
                  </div>
                  <div class="col-md-5">
                    <input   name="waktu_mulai" value = "{{$ujian->waktu_mulai}}"  id="jam">
                  </div>
                </div>
               
                <!-- <script> untuk isi value
                var dateControl = document.querySelector('input[type="datetime-local"]');
                dateControl.value = {{$ujian->waktu_mulai}};
                </script> -->
               

                <div class="row mt-2">
                  <div class="col-md-3">

                  </div>
                  <div class="col-md-5">
                  <button type="submit" class="btn" style="background-color:#7BEDC4; border: none; box-shadow: 3px 3px 3px rgba(119, 52, 171, 0.46);">
                    Simpan</button>
                  </div>
                </div>
              </form>
            </div>

        </div>
    </div>
</div>
@endsection

