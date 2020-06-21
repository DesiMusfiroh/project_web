@extends('layouts.sidebar')

@section('content')
<div class="alert alert-success " role="alert">
  <h4 class="alert-heading">Hai  {{ Auth::user()->name }}, Selamat datang di Website LiveEx!</h4>
  <p>LiveEx adalah website yang dibangun dengan tujuan untuk mempermudah pelaksanaan ujian secara daring dengan fitur live video demi meningkatkan pengawasan dan meminimalisir kecurangan saat ujian berlangsung </p>
  <hr>
    <p>
    Sudah punya kode akses untuk ujian? 
    <a type="button" style="color: #blue" data-toggle="modal" data-target="#exampleModal"> Klik disini</a>
    <p>
<div  class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="border-radius:2px;  box-shadow: 3px 3px 5px grey;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Join Exam</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                     {{ session('status') }}
                </div>
            @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
                <div class="form-row align-items-center">
                    <div class="col-auto  offset-md-1">
                         <input style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;"id="kode_akses" type="kode_akses" class="form-control @error('kode_akses') is-invalid @enderror" name="kode_akses" required placeholder="Masukkan Kode Akses">
                     @error('email')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                     @enderror
                    </div>
                    <div class="col-auto ">
                        <button type="submit" style="border-radius:10px; border-color:#c4cdcf; font-family: Chelsea Market; font-size:18px; box-shadow: 3px 3px 5px grey;">
                            <strong> {{ __('Join') }}</strong>
                        </button>
                    </div>
                </div>
        </form>
     </div>
      <div class="modal-footer col-auto">
       Nb : Kode akses hanya diperoleh dari guru/dosen!
    </div>
  </div>
</div>
 
  

@endsection
