@extends('layouts.sidebar')

@section('content')

<div class="card"  style="border-radius:20px;  box-shadow: 10px 10px 5px rgba(48, 10, 64, 0.5);" >
    <div class="card-header text-center "  style="border-radius: 20px 20px 0px 0px; background-color:#7BEDC4;">
        <h4>{{ $ujian->nama_ujian}} </h4>
    </div>
    <div class="card-body">
        <p>Durasi : {{ $ujian->paket_soal->durasi}}</p>
        <p>Waktu Mulai : {{$ujian->waktu_mulai}}</p>
            
        <div id="teks"></div>
    
        <hr>
        <div id="start">
            <a href="{{route('runExam',$ujian->id)}}"><button class="btn btn-warning">Mulai</button></a>
        </div>

        </div>
    </div>
</div>




<script>

const waktu_mulai = new Date('<?php echo $waktu_mulai ?>').getTime(); 

const hitung_mundur = setInterval(function() {
    const waktu_sekarang = new Date().getTime();
    const selisih = waktu_mulai - waktu_sekarang;

    const hari = Math.floor(selisih / (1000 * 60 * 60 *24));
    const jam = Math.floor(selisih % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
    const menit = Math.floor(selisih % (1000 * 60 * 60 ) / (1000 * 60 ));
    const detik = Math.floor(selisih % (1000 * 60 ) / 1000 );

    const teks = document.getElementById('teks');
    teks.innerHTML = 'Ujian akan di mulai dalam : ' + hari + ' hari ' + jam + ' jam ' + menit + ' menit ' + detik + ' detik lagi ';
    $("#start").hide();

    if( selisih < 0 ) {
        clearInterval(hitung_mundur);
        teks.innerHTML = 'Ujian Dapat di mulai';
        $("#start").show();
    }
}, 1000);

   
</script>


@endsection
