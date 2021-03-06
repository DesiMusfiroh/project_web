@extends('layouts.sidebar')
@section('content')
<style>
@media screen and (max-width: 1000px) {
   .input-waktu{width:120%;}
   .input-data{width:140%;}
}
</style>
<div class="container ">
<div class="row justify-content-center">
<div class="col-md-10">
    <div class="card ">
        <div class="card-header pt-3 pb-2 text-center" style="border-radius: 20px 20px 0px 0px; background: #EDE5E5; ">
            <strong style="font-size: 18px;">Buat Ujian</strong>
        </div>
        <div class="card-body">

            <div class="container ">

              <form class="" action="{{route('storeExam')}}" method="post" class="form-control">
                @csrf
                <div class="row mr-3">
                  <div class="col-md-3 offset-md-1">
                    <label for=""> <strong> Nama Ujian</strong></label>
                  </div>
                  <div class="col-md-8 input-data">
                    <input type="text" name="nama_ujian" value="" class="form-control" placeholder="nama ujian">
                  </div>
                </div>
                <div class="row mt-2  mr-3">
                  <div class="col-md-3 offset-md-1">
                    <label for=""> <strong>Pilih Paket Soal</strong> </label>
                  </div>
                  <div class="col-md-8 input-waktu">
                    <select class="form-control" name="paket_soal_id">
                      <option disabled selected>Pilih ...</option>
                      @foreach($paketsoal as $item)
                      <option value="{{$item->id}}"> {{$item->judul}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="row mt-2 mb-2  mr-3">
                  <div class="col-md-3 offset-md-1">
                    <label for=""> <strong>Waktu Mulai</strong> </label>
                  </div>
                  <div class="col-md-8 input-waktu">
                    <input type="datetime-local"  class="form-control" name="waktu_mulai" value="" id="jam">
                  </div>
                </div>
                <hr>
                <div class="row mt-2 offset-md-9">        
                  <div class="text-right col-md-10"> <button type="submit" class="btn btn-primary" style="box-shadow: 3px 2px 5px grey;"> Simpan </button> </div>
                </div>
              </form>
            </div>

        </div>
    </div>
</div>
</div>
</div>
@endsection
