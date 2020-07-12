@extends('layouts.app')

@section('content')
<?php use App\Profil ;
?>
<main class="main">

    <div class="container-fluid">
        <div class="animated fadeIn">


            <form action="/profil/update/{{ $profil->id }}" method="post" enctype="multipart/form-data" >
            @csrf
            @method('PATCH')
                <div class="row">
                    <div class="col-md-4">
                        <div class="card"  style="border-radius:20px;  box-shadow: 10px 10px 10px grey;">
                            <div class="card-header  pt-3 pb-2 text-center"  style="border-radius: 20px 20px 0px 0px;  background-color:#6BCB9D;">
                                <h4 class="card-title">Foto Profil</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="file_foto"> <b> Foto :  </b></label> <br>
                                    <input type="file" src="{{ asset('images/' . $profil->foto) }}" name="foto" alt="{{ $profil->foto }}" value="$profil->foto">
                                    @if($errors->has('foto'))
                                    <span class="help-block">{{$errors->first('foto')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card"  style="border-radius:20px;  box-shadow: 10px 10px 10px grey;">
                            <div class="card-header  pt-3 pb-2 bg-primary text-center"  style="border-radius: 20px 20px 0px 0px;  background-color:#6BCB9D;">
                                <h4 class="card-title"> Profil </h4>
                            </div>
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                <div class="container">


                                    <fieldset disabled>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="disabledTextInput"> <b> User Name </b> </label>
                                                <div class="input-group mb-0">
                                                <div class="input-group-prepend" style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;">
                                                    <span class="input-group-text" id="basic-addon1"> <span class="fa fa-user"></span> </span>
                                                </div>
                                                <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ Auth::user()->name }}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="disabledTextInput"> <b> Email </b> </label>
                                                <div class="input-group mb-0">
                                                <div class="input-group-prepend" style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;">
                                                    <span class="input-group-text" id="basic-addon1"> <span class="fa fa-envelope"></span> </span>
                                                </div>
                                                <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ Auth::user()->email }}" readonly >
                                            </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }} ">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="no_hp"> <b> Nomor HP : </b> </label>
                                            <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{$profil->no_hp}}" style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;">
                                            @if($errors->has('no_hp'))
                                            <span class="help-block">{{$errors->first('no_hp')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="nim"> <b> Institusi  : </b> </label>
                                            <input type="text" class="form-control" id="institusi" name="institusi"  value="{{$profil->institusi}}" style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;">
                                            @if($errors->has('institusi'))
                                            <span class="help-block">{{$errors->first('institusi')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group mt-1">
                                        <label for="alamat"> <b> Alamat : </b> </label>
                                        <textarea class="form-control" id="alamat" rows="2" name="alamat" style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;"> {{$profil->alamat}} </textarea>
                                        @if($errors->has('alamat'))
                                        <span class="help-block">{{$errors->first('alamat')}}</span>
                                        @endif
                                    </div>

                                    <div class="text-right"> <button type="submit" class="btn btn-primary" style="box-shadow: 3px 2px 5px grey;"> Update </button> </div>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
</main>
@endsection
