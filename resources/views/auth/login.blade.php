@extends('layouts.splash')

@section('content')

<div class="container">
    <div class="row justify-content-center">
    <div  class="col-md-5">
     <div id="card"  style="border-radius:20px;  box-shadow: 10px 10px 10px grey;
        background: linear-gradient(180deg, rgba(17, 0, 23, 0.96) 0%, rgba(44, 5, 60, 0.96) 30.21%, #5E2575 70.83%, #BEA2CF 100%);  /* background sidebar */
        -webkit-transition: all 0.3s; -o-transition: all 0.3s; transition: all 0.3s; ">
                        <div class="card-header pt-3 pb-2 text-center" style="border-radius: 20px 20px 0px 0px; background-color : #EDE5E5;">
                            <h4 class="card-title">Login</h4>
                        </div>
                        <div class="card-body"  >
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
    
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf


                        <div class="form-group row">
                        <label class="sr-only" for="email">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-10 offset-md-1">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><span class="fa fa-envelope"></span></div>
                                 </div>
                                         <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                             </div>   
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                        <label class="sr-only" for="password">{{ __('Password') }}</label>
                            <div class="col-md-10 offset-md-1">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><span class="fa fa-lock" ></span></div>
                                 </div>
                                         <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password"  required autocomplete="current-password">
                             </div>   
                            
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-10 offset-md-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-10 offset-md-1">
                                <button type="submit">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
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
