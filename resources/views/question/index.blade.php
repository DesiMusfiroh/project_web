@extends('layouts.sidebar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Question
                    <a href="" class="ml-auto"> <button class="btn btn sm"> + Buat Soal Baru  </button></a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Buat Paket Soal Baru
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
