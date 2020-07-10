@extends('layouts.sidebar')
@section('content')
<div class="col-md-12">
    <div class="card" style="border-radius:20px;  box-shadow: 10px 10px 5px rgba(48, 10, 64, 0.5);">
        <div class="card-header  pt-3 pb-2 text-center" style="border-radius: 20px 20px 0px 0px; background-color:#7BEDC4;">
            <h4 class="card-title"> Edit ujian  </h4>
        </div>
        <div class="card-body">

            <div class="container">

              <form class="" action="{{route('updateExam',$ujian->id)}}" method="post" class="form-control">
                @method('patch')
                @csrf
                <div class="row">
                  <div class="col-md-3">
                    <label for="">Nama Ujian</label>
                  </div>
                  <div class="col-md-5">
                    <input type="text" name="nama_ujian" value="" class="form-control" placeholder="nama ujian">
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-3">
                    <label for="">Pilih paket soal</label>
                  </div>
                  <div class="col-md-5">
                    <select class="form-control" name="paket_soal_id">
                      <option disabled selected>Pilih ...</option>
                      @foreach($paketsoal as $item)
                      <option value="{{$item->id}}"> {{$item->judul}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-3">
                    <label for="">Waktu mulai</label>
                  </div>
                  <div class="col-md-5">
                    <input type="datetime-local" name="waktu_mulai" value="" id="jam">
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-3">

                  </div>
                  <div class="col-md-5">
                    <button type="submit" name="button">Simpan</button>
                  </div>
                </div>
              </form>
            </div>

        </div>
    </div>
</div>
@endsection
