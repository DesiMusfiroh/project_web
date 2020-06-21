@extends('layouts.sidebar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            Paket Soal
                        </div>
                        <div class="col-md-6 ">
                            <div class="text-right" style="font-size:20px; font-family:segoe ui black; font-weight:bold;">
                                <a href="/question_create"> <button type="button" class="btn" style="background-color:#7BEDC4;">
                                    [ <i class="fa fa-plus"></i> ]  Buat Paket Soal Baru </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table">
                      @foreach($paketsoal as $item)
                      <tr>
                        <td><a href="{{route('getSingleQuestion',$item->id)}}">{{$item->judul}}</a></td>
                      </tr>
                      @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
