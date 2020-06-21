
@extends('layouts.splash')
<style>
 html, body {
                background: url('images/backbiru.png');
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
                <div class="card-header" style="font-family: Chelsea Market; font-size:20px; background: #ecdfed 100%; color:#590580; text-shadow:3px 2px 1px grey;" >{{ __('Login') }}</div>

                <div class="card-body" style="border-radius:0px 0px 10px 10px; box-shadow: 0px 15px 15px 0px #e1b5f7;
                background: linear-gradient(180deg, #e5cce8 0%, rgba(200, 181, 201) 10.21%,rgba(207, 113, 217) 70.83%,  #b372ba 100%); 
                color: #ffffff; -webkit-transition: all 0.3s; -o-transition: all 0.3s; transition: all 0.3s; ">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row ">
                        <div class="col-md-8 offset-md-2">
                            <label for="disabledTextInput"><b> Email </b> </label>
                        </div>
                            <div class="col-md-8 offset-md-2">
                                <input style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;"id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="form-group row">
                        <div class="col-md-8 offset-md-2">
                            <label for="disabledTextInput"><b> Password </b> </label>
                        </div>
                            <div class="col-md-8 offset-md-2">
                                <input style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <div class="form-check">
                                    <input style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;" class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-10 offset-md-2">
                                <button type="submit" style="border-radius:10px; border-color:#c4cdcf; font-family: Chelsea Market; font-size:15px; box-shadow: 3px 3px 5px grey;">
                                   <b> {{ __('Login') }}</b>
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}"  style="color: #ffffff";>
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection