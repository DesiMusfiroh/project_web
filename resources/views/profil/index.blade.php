@extends('layouts.sidebar')

@section('content')
<?php  use App\Profil;
    $profil = Profil::where('user_id', Auth::user()->id )->first();
?>
<main class="main">

    <div class="container-fluid">
        <div class="animated fadeIn">

        @if ( Profil::where('user_id', Auth::user()->id )->first() != null )
            <div class="row">

                <div class="col-md-8">
                    <div class="card"  style="border-radius:20px;  box-shadow: 10px 10px 10px grey;">
                        <div class="card-header pt-3 pb-2 text-center" style="border-radius: 20px 20px 0px 0px; background: #EDE5E5; ">
                            <strong style="font-size:18px"> Profil</strong>
                        </div>
                        <div class="card-body" >
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                            <div class="container">

                                    <div class="form-row ">
                                        <div class="form-group col-md-6">
                                            <label for="disabledTextInput"><b> User Name </b> </label>
                                            <div class="input-group mb-0">
                                            <div class="input-group-prepend" style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;">
                                                <span class="input-group-text" id="basic-addon1"> <span class="fa fa-user"></span> </span>
                                            </div>
                                            <input type="text" id="disabledTextInput" class="form-control" placeholder="{{auth()->user()->name}}" readonly="">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="disabledTextInput"><b> Email </b></label>
                                            <div class="input-group mb-0">
                                            <div class="input-group-prepend" style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;">
                                                <span class="input-group-text" id="basic-addon1"> <span class="fa fa-envelope"></span> </span>
                                            </div>
                                            <input type="text" id="disabledTextInput" class="form-control" placeholder="{{auth()->user()->email}}" readonly="">
                                            </div>
                                        </div>
                                    </div>

                                    <table class="table table-hover table-sm">
                                        <tr>
                                            <td col><b> Nomor HP </b> </td>
                                            <td> : </td>
                                            <td>{{ $profil->no_hp }}</td>
                                        </tr>
                                        <tr>
                                            <td col><b> Institusi </b> </td>
                                            <td> : </td>
                                            <td>{{ $profil->institusi }}</td>
                                        </tr>
                                        <tr>
                                            <td col><b> Alamat </b> </td>
                                            <td> : </td>
                                            <td>{{ $profil->alamat }}</td>
                                        </tr>
                                        <tr>
                                            <td col><b> Jenis Kelamin </b> </td>
                                            <td> : </td>
                                            <td>{{ $profil->jk }}</td>
                                        </tr>
                                    </table>
                            </div>
                        </div>

                        <div class="card-footer" style="border-radius: 0px 0px 20px 20px ">
                            <div class="row justify-content-center">
                                <a href="profil/edit/{{$profil->id}}"><button class="btn btn-primary"  style="box-shadow: 3px 2px 5px grey;"> Edit Profil </button></a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card"  style="border-radius:20px;  box-shadow: 10px 10px 10px grey;">
                        <div class="card-header pt-3 pb-2 text-center" style="border-radius: 20px 20px 0px 0px; background-color:#6BCB9D;">
                            <strong style="font-size:18px"> Foto Profil </strong>
                        </div>
                        <div class="card-body text-center">
                            <div class="form-group">
                                <img src="/images/{{$profil->foto}}" class="img-fluid mx-auto ">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </div>
        @else

            <form action="{{route('storeProfil')}}" method="post" enctype="multipart/form-data" >
            @csrf
                <div class="row">


                    <div class="col-md-8">
                        <div class="card"  style="border-radius:20px;  box-shadow: 10px 10px 5px rgba(48, 10, 64, 0.5);">
                            <div class="card-header  pt-3 pb-2 text-center"  style="border-radius: 20px 20px 0px 0px; background: #EDE5E5;">
                                <strong style="font-size:18px"> Profil </strong>
                            </div>
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                <div class="container">

                                        <div class="form-row ">
                                            <div class="form-group col-md-6">
                                                <label for="disabledTextInput"><b> User Name </b> </label>
                                                <div class="input-group mb-0">
                                                <div class="input-group-prepend" style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;">
                                                    <span class="input-group-text" id="basic-addon1"> <span class="fa fa-user"></span> </span>
                                                </div>
                                                <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ Auth::user()->name }}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="disabledTextInput"><b> Email </b></label>
                                                <div class="input-group mb-0">
                                                <div class="input-group-prepend" style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;">
                                                    <span class="input-group-text" id="basic-addon1"> <span class="fa fa-envelope"></span> </span>
                                                </div>
                                                <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ Auth::user()->email }}" readonly >
                                                </div>
                                            </div>
                                        </div>

                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }} ">
                                    <div class="form-row mb-0 mt-0 pt-0">
                                        <div class="form-group col-md-6">
                                            <label for="no_hp"><b> Nomor HP  : </b></label>
                                            <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="+62 ..." style="border-radius:10px;  box-shadow: 3px 0px 5px grey;">
                                            @if($errors->has('no_hp'))
                                            <span class="help-block">{{$errors->first('no_hp')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="institusi"> <b> Institusi : </b> </label>
                                            <input type="text" class="form-control" id="institusi" name="institusi" style="border-radius:10px; box-shadow: 3px 0px 5px grey;">
                                            @if($errors->has('institusi'))
                                            <span class="help-block">{{$errors->first('institusi')}}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="jk"> <b> Jenis Kelamin : </b> </label>
                                            <input type="text" class="form-control" id="jk" name="jk" style="border-radius:10px; box-shadow: 3px 0px 5px grey;">
                                            @if($errors->has('jk'))
                                            <span class="help-block">{{$errors->first('jk')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group mt-0 text-center ">
                                        <label for="alamat" class="text-left"><b> Alamat : </b> </label>
                                        <textarea class="form-control" id="alamat" rows="2" name="alamat" style="border-radius:10px;  box-shadow: 2px 1px 3px grey;"> </textarea>
                                    </div>


                                    <div class="text-right" > <button type="submit" class="btn btn-primary" style="box-shadow: 3px 2px 5px grey;">Save </button> </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card"  style="border-radius:20px;  box-shadow: 10px 10px 5px rgba(48, 10, 64, 0.5);">
                            <div class="card-header  pt-3 pb-2 text-center"  style="border-radius: 20px 20px 0px 0px ; background-color:#7BEDC4;">
                                <strong style="font-size:18px"> Foto Profil </strong>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="file_foto"> <b> Foto : </b> </label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile"  name="foto">
                                        <label class="custom-file-label" for="customFile">Pilih File Foto ..</label>
                                    </div>
                                    @if($errors->has('foto'))
                                      <span class="help-block">{{$errors->first('foto')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </form>

        @endif
        </div>
    </div>

</main>
@endsection
