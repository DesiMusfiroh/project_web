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
                <!-- <div class="row mt-2">
                  <div class="col-md-3">
                    <label for="">Paket Soal</label>
                  </div>
                  <div class="col-md-7">
                    <input type="text"  name="paket_soal_id" value = "{{$ujian->paket_soal->judul}}"  disabled> <span style="color:red">*paket  soal tidak bisa di ubah</span>
                  </div>
                </div> -->
                <div class="row mt-2 mr-3">
                  <div class="col-md-3  offset-md-1">
                    <label for="">Waktu mulai</label>
                  </div>
                  <div class="col-md-8">
                    <input type="hidden" class="form-control"  value = "{{$ujian->waktu_mulai}}"  id="jamawal">
                    <input type="datetime-local" class="form-control"  name="waktu_mulai"   id="jamberubah">
                  
                  </div>
                </div>
               
                <script> 
                var dateControl = document.querySelector('input[type="datetime-local"]');
                var jamawal = $('#jamawal').val();
                
                var jamberubah = jamawal;
                dateControl.value= berubah;
                </script> 
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
@endsection

