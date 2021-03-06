@extends('layouts.sidebar')

@section('content')
<div class="container">
    @if(session('sukses'))
        <div class="alert alert-success" role="alert">
            {{session('sukses')}}
        </div>
    @endif
    <?php
        use App\Profil;
        $fotoprofil = Profil::where('user_id',$peserta->user->id)->value('foto');
        $institusi   = Profil::where('user_id',$peserta->user->id)->value('institusi');
        $no_hp      = Profil::where('user_id',$peserta->user->id)->value('no_hp');
    ?>
    <div class="row mb-4">
        <div class="col-sm-7">
            <div class="card"  style="height: 120px;">
                <div class="card-body pb-2 pt-2">
                <div class="row">
                    <div class="col-sm-3 ">
                        @if ( $fotoprofil !== null)
                            <img src="/images/{{$fotoprofil}}" class="card-img" width="140px" height="100px" >
                        @else
                            <img src="/images/logo.png" class="card-img" alt="..."  width="100px">
                        @endif
                    </div>
                    <div class="col-sm-9">
                    <h5 class="pb-0 mb-0 pt-3 ">{{ $peserta->user->name }} </h5>
                            @if ($institusi !== null)
                                <table>
                                    <tr> <td width="100px"> institusi   </td> <td> : </td> <td> {{$institusi}}  </td> </tr>
                                    <tr> <td> Nomor HP  </td> <td> : </td> <td> {{$no_hp}}  </td> </tr>
                                </table>
                            @else
                                <table>
                                    <tr> <td width="100px"> institusi   </td> <td> : </td> <td> - </td> </tr>
                                    <tr> <td> Nomor HP  </td> <td> : </td> <td> - </td> </tr>
                                </table>
                            @endif
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="card text-right" style="height: 120px;">
            <div class="card-body">
                <h5 class="card-title">{{$peserta->ujian->nama_ujian}}</h5>
                <p class="card-text">Paket Soal {{$peserta->ujian->paket_soal->judul}}</p>
            </div>
            </div>
        </div>
    </div>

    <div class="card text-center">

        <div class="card-header"  style="border-radius: 20px 20px 0px 0px; background: #EDE5E5;">
            <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link active"  id="nav_koreksi"> <strong>Koreksi Jawaban Peserta</strong> </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="nav_hasil"> <strong>Hasil Ujian Peserta</strong> </a>
            </li>
            </ul>
        </div>

        <div class="card-body">
            <div id="koreksi">
            @if($koreksi_jawaban->count() != 0)

                @foreach ($koreksi_jawaban as $item)
                <div class="alert alert-success text-left" role="alert">
                    Pertanyaan : {!!$item->essay->pertanyaan!!} 
                    kunci jawaban : {!!$item->essay->jawaban!!} 
                    Jawaban Peserta : {{$item->jawab}}
                    <hr>
                    <div class="row">
                        <div class="col-md-8 text-left"></div>
                        <div class="col-md-4 ">
                            <form action="/essay_jawab/score/update" method="post">
                            @csrf
                            @method('PATCH')
                                <input type="hidden" name="id" id="id" value="{{$item->id}}">
                                <div class="input-group">
                                <input type="number" name="score" class="form-control" placeholder="Score" aria-label="score" aria-describedby="button-addon2" max="{{$item->essay->soal_satuan->poin}}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit" id="simpan">Simpan</button>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong> Tidak ada jawaban peserta yang perlu di koreksi </strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            </div>
            <div id="hasil">
                @if ($peserta->nilai !== null)
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <div class="alert alert-success" role="alert">
                            Total Score : {{$peserta->nilai}}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="alert alert-success" role="alert">
                            Total Poin : {{$total_poin}} 
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="alert alert-success" role="alert">
                            Nilai Akhir : {{$nilai_akhir}}
                        </div>
                    </div>
                </div>
                @endif

                @if ($pilgan_jawab->count() != 0)
                <h5> <strong>Hasil Ujian Pilihan Ganda Peserta</strong> </h5>
                <table class="table table-striped table-bordered table-sm">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th scope="col" style="width:50px">No</th>
                            <th scope="col" style="width:400px">Jawaban Peserta</th>
                            <th scope="col" style="width:150px">Kunci Jawaban</th>
                            <th scope="col" style="width:150px">Keterangan</th>
                            <th scope="col" style="width:140px">Score</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0; ?>
                        @foreach ($pilgan_jawab as $item)
                        <tr>
                            <td scope="row"><?php  $i++;  echo $i; ?></td>
                            <td>{{$item->jawab}}</td>
                            <td>{{$item->pilgan->kunci}}</td>
                            <td>@if ($item->status == 'T') Benar @else Salah @endif</td>
                            <td>{{$item->score}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif

                @if ($essay_jawab->count() != 0)
                <h5> <strong> Hasil Ujian Essay Peserta</strong></h5>
                <table class="table table-striped table-bordered table-sm">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th scope="col" style="width:50px">No</th>
                            <th scope="col" style="width:400px">Pertanyaan</th>
                            <th scope="col" style="width:150px">Jawaban Peserta</th>
                            <th scope="col" style="width:150px">Poin Soal</th>
                            <th scope="col" style="width:140px">Score</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0; ?>
                        @foreach ($essay_jawab as $item)
                        <tr>
                            <td scope="row"><?php  $i++;  echo $i; ?></td>
                            <td>{!!$item->essay->pertanyaan!!}</td>
                            <td>{!!$item->jawab!!}</td>
                            <td>{!!$item->essay->soal_satuan->poin!!}</td>
                            <td>{{$item->score}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>

</div>

<script>
$("#hasil").hide();
$("#koreksi").show();
$(document).ready(function(){
    $('#nav_koreksi').click(function() {
        $("#hasil").hide();
        $("#nav_koreksi").attr('class','nav-link active');
        $("#nav_hasil").attr('class','nav-link');
        $("#koreksi").show();
    });
    $('#nav_hasil').click(function() {
        $("#koreksi").hide();
        $("#nav_hasil").attr('class','nav-link active');
        $("#nav_koreksi").attr('class','nav-link ');
        $("#hasil").show();
    });
});
</script>
@endsection