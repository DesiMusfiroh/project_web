@extends('layouts.sidebar')
@section('content')
<?php
use App\Ujian ; 
?>
<div class="container row justify-content-center">
<div class="col-md-10">

    <div class="card" style="border-radius:20px;  box-shadow: 10px 10px 5px rgba(48, 10, 64, 0.5);">
        <div class="card-header  pt-3 pb-2 text-center" style="border-radius: 20px 20px 0px 0px; background: #EDE5E5;">
          <strong style="font-size: 18px;">Edit Ujian</strong>
        </div>
        <div class="card-body">

            <div class="container">

              <form class="" action="{{route('updateExam',$ujian->id)}}" method="post" class="form-control">
                @method('PATCH')
                @csrf
                <div class="row mr-3">
                  <div class="col-md-3 offset-md-1">
                    <label for=""> <strong> Nama Ujian</strong> </label>
                  </div>
                  <div class="col-md-8">
                    <input type="text" name="nama_ujian" value="{{$ujian->nama_ujian}}" class="form-control" >
                  </div>
                </div>
                 <div class="row mt-2 mr-3">
                  <div class="col-md-3  offset-md-1">
                    <label for="">Pilih paket soal</label>
                  </div>
                  <div class="col-md-8">
                    <select class="form-control" name="paket_soal_id" value="" >
                      <option value="{{$ujian->paket_soal->id}}" >{{$ujian->paket_soal->judul}}</option>
                      @foreach($paket_soal as $item)
                      <option value="{{$item->id}}"> {{$item->judul}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="row mt-2 mr-3">
                  <div class="col-md-3  offset-md-1">
                    <label for="">Waktu mulai</label>
                  </div>
                  <div class="col-md-8">
                    <input type="hidden" id="waktu_awal"  value="{{$ujian->waktu_mulai}}" >
                    <input class="form-control" type="datetime-local" name="waktu_mulai" value = ""  id="waktu_input">
                  </div>
                </div>
                <hr>
                  <div class="row mt-2 offset-md-10">
                  <button type="submit" class="btn" style="background-color:#7BEDC4; border: none; box-shadow: 3px 3px 3px rgba(119, 52, 171, 0.46);">
                    Simpan</button>
                  </div>
                
              </form>
            </div>

        </div>
    </div>
</div>
</div>

<script>
$(document).ready(function(){
    var waktu_awal = document.getElementById("waktu_awal").value;
    let waktu = new Date(waktu_awal);

    var dateControl = document.querySelector('input[type="datetime-local"]');
    dateControl.value = waktu.toISOString().substring(0, 16);
});
</script>

@endsection

