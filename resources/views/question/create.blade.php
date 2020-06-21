@extends('layouts.sidebar')

@section('content')

<div class="col-md-12">
    <div class="card" style="border-radius:20px;  box-shadow: 10px 10px 5px rgba(48, 10, 64, 0.5);">
        <div class="card-header  pt-3 pb-2 text-center" style="border-radius: 20px 20px 0px 0px; background-color:#7BEDC4;">
            <h4 class="card-title"> Buat paket soal  </h4>
        </div>
        <div class="card-body">
            <form action="{{route('paketSoalStore')}}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="container">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }} ">
                <div class="form-row mb-0 mt-0 pt-0">
                    <div class="form-group col-md-9">
                        <label for="judul"><b> Judul  : </b></label>
                        <input type="text" class="form-control" id="judul" name="judul" placeholder="Nama paket soal" style="border-radius:10px;  box-shadow: 3px 0px 5px grey;">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="durasi"> <b> Durasi </b> </label>
                        <input type="text" class="form-control" id="durasi" name="durasi" style="border-radius:10px; box-shadow: 3px 0px 5px grey;">
                    </div>
                </div>
                <hr>

                <div class="text-right"> <button type="submit" class="btn btn-primary" style="box-shadow: 3px 2px 5px grey;">Save </button> </div>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
