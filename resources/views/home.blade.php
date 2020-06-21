@extends('layouts.sidebar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card"  style="border-radius:20px;  box-shadow: 10px 10px 10px grey;">
                <div class="card-header" style="border-radius: 20px 20px 0px 0px; background-color:#6BCB9D;">Join Quiz</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                <form method="POST" action="#">
                    @csrf

                <div class="form-group row-md-2">
                <input style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;"id="kode_akses" type="kode_akses" class="form-control @error('kode_akses') is-invalid @enderror" name="kode_akses" required placeholder="Masukkan Kode Akses">
                                
                @error('email')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                </span>
                 @enderror
                            
    <div class="col-md-4">
        
    <button type="submit" style="border-radius:10px; border-color:#c4cdcf; font-family: Chelsea Market; font-size:20px; box-shadow: 3px 3px 5px grey;">
                                   <b> {{ __('Join') }}</b>
                                </button>
    </div>
</div>

                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
