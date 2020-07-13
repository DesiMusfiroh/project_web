@extends('layouts.sidebar')
@section('content')
<p>Detail Hasil Ujian </p>

<div class="row mb-4">
    <div class="col-sm-7">
        <div class="card"  style="height: 120px;">
            <div class="card-body pb-2 pt-2">
            <div class="row">
                <div class="col-sm-3 ">
                    @if ( $fotoprofil !== null)
                        <img src="/images/{{$fotoprofil}}" class="card-img" width="120px" height="100px"  >
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

    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
        <li class="nav-item">
            <span class="nav-link" id="nav_hasil">Hasil Ujian Peserta</span>  
        </li>
       
        </ul>
                                    @if($peserta->nilai != null )
                                    <a  href="{{route('hasil_pdf',$peserta->id)}}"  target="_blank">   
                                    <button type="button" class="btn btn-info btn-sm">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                    
                                    </button>
                                    </a>
                                    @endif 
        
    </div>

    <div class="card-body">
      @if ($peserta->nilai !== null)
        <div id="hasil">

            <div class="alert alert-success" role="alert">
                Total Score : {{$peserta->nilai}} <br>
                Total Poin : {{$total_poin}} <br>
                Nilai Akhir : {{$nilai_akhir}}
            </div>

            <h5>Hasil Ujian Pilihan Ganda Peserta</h5>
            <table class="table table-striped table-bordered table-sm">
                <thead class="thead-dark text-center">
                    <tr>
                        <th scope="col" style="width:50px">No</th>
                        <th scope="col" style="width:400px">Jawaban Peserta</th>
                        <th scope="col" style="width:150px">Kunci Jawaban</th>
                        <th scope="col" style="width:150px">Keterangan</th>
                        <th scope="col" style="width:140px">score</th>

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

            <h5>Hasil Ujian Essay Peserta</h5>
            <table class="table table-striped table-bordered table-sm">
                <thead class="thead-dark text-center">
                    <tr>
                        <th scope="col" style="width:50px">No</th>
                        <th scope="col" style="width:400px">Pertanyaan</th>
                        <th scope="col" style="width:150px">Jawaban Peserta</th>
                        <th scope="col" style="width:140px">score</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i=0; ?>
                    @foreach ($essay_jawab as $item)
                    <tr>
                        <td scope="row"><?php  $i++;  echo $i; ?></td>
                        <td>{!!$item->essay->pertanyaan!!}</td>
                        <td>{{$item->jawab}}</td>
                        <td>{{$item->score}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
      @else
      <script>
        alert("Soal sedang di koreksi");
      </script>
      <strong>Menunggu di koreksi </strong>
      @endif
    </div>
</div>
@endsection
