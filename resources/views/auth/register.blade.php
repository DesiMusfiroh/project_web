@extends('layouts.splash')
<style>
 html, body {
                background: url('images/back.png');
                background-size: cover;
                color: #636b6f;
                font-family: Pangolin ;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card" style="border-radius:10px" >
                <div class="card-header" style="font-family: Chelsea Market; font-size:22px; background: #ecdfed 100%; color:#590580; " >{{ __('Register') }}</div>

                <div class="card-body" style="border-radius:0px 0px 10px 10px; box-shadow: 0px 15px 15px 0px #e1b5f7;
                background: linear-gradient(180deg, #e5cce8 0%, rgba(200, 181, 201) 10.21%,rgba(207, 113, 217) 70.83%,  #b372ba 100%); 
                color: #ffffff; -webkit-transition: all 0.3s; -o-transition: all 0.3s; transition: all 0.3s; ">
                
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                        <div class="col-md-10 offset-md-1">
                            <label for="disabledTextInput"><strong>   {{ __('Name') }}</strong> </label>
                        </div>
                            <div class="col-md-10 offset-md-1">
                                <input style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                        <div class="col-md-10 offset-md-1">
                            <label for="disabledTextInput"><strong>   {{ __('Email') }}</strong> </label>
                        </div>
                            <div class="col-md-10 offset-md-1">
                                <input style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                        <div class="col-md-10 offset-md-1">
                            <label for="disabledTextInput"><strong>   {{ __(' Password') }}</strong> </label>
                        </div>
                            <div class="col-md-10 offset-md-1">
                                <input style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                        <div class="col-md-10 offset-md-1">
                            <label for="disabledTextInput"><strong>   {{ __('Confirm Password') }}</strong> </label>
                        </div>
                            <div class="col-md-10 offset-md-1">
                                <input style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-3 offset-md-4">
                                <button type="submit" style="border-radius:10px; border-color:#c4cdcf; font-family: Chelsea Market; font-size:15px; box-shadow: 3px 3px 5px grey;">
                                    {{ __('Register') }}
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
