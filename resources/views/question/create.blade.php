@extends('layouts.sidebar')

@section('content')
<form class="form-control" action="{{route('postQuestionPackage')}}" method="post">
  @csrf
    <div class="form-row mb-0 mt-0 pt-0">
        <div class="form-group col-md-6">
            <label for="judul"><b> Judul  : </b></label>
            <input type="text" class="form-control" id="judul" name="judul" placeholder="Nama paket" style="border-radius:10px;  box-shadow: 3px 0px 5px grey;">
        </div>
        <div class="form-group col-md-6">
            <label for="durasi"> <b> Durasi </b> </label>
            <input type="text" class="form-control" id="durasi" name="durasi" style="border-radius:10px; box-shadow: 3px 0px 5px grey;">
        </div>
    </div>
    <div class="text-right"> <button type="submit" class="btn btn-primary" style="box-shadow: 3px 2px 5px grey;">Save </button> </div>
</form>
@endsection
