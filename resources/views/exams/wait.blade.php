@extends('layouts.sidebar')

@section('content')
<style>
:fullscreen {
  background-color: #7BEDC4;
}
video{
    background: #ccc;
    border: 5px solid grey;
    margin-right: 0%;
    margin-left: 85%
}
</style>

<div class="card"  style="border-radius:20px;  box-shadow: 10px 10px 5px rgba(48, 10, 64, 0.5);" >
    <div class="card-header text-center "  style="border-radius: 20px 20px 0px 0px; background-color:#7BEDC4;">
        <h4>{{ $ujian->nama_ujian}} </h4>
    </div>
    <div class="card-body">
        <?php
          $durasi_jam   =  date('H', strtotime($ujian->paket_soal->durasi));
          $durasi_menit =  date('i', strtotime($ujian->paket_soal->durasi));
        ?>
        <p>Durasi : {{ $durasi_jam }} jam {{ $durasi_menit }} menit</p>
        <p>Waktu Mulai : {{$ujian->waktu_mulai}}</p>

        <div id="teks"></div>
    </div>
    <div class="card-footer  text-center " id="start">
        <!-- <a href="{{route('runExam',$ujian->id)}}"><button  class="btn btn-warning">Mulai</button></a> -->
        <button class="btn btn-success" onclick="openFullscreen();">Mulai Ujian</button>
    </div>
</div>


<div id=fullscreenExam >
  <div class="container">
<br> <br>

    <div class="row">
      <div class="col-md-12">
        <div class="card pt-3 pl-5 pr-5 pb-3">
          <h4>{{ $ujian->paket_soal->judul }}</h4>
          <h6>Durasi Pengerjaan : {{ $durasi_jam }} jam {{ $durasi_menit }} menit </h6>
          <div id="teks_durasi"></div>
        </div>
      </div>
    </div>

    <div id="table_data">
      @include('exams.pagination_data')
      
    </div>

    <div class="row">
      <div class="col-md-8"></div>
      <div class="col-md-4">
        <button class="btn btn-danger" onclick="closeFullscreen();"> Akhiri Ujian </button>
      </div>
    </div>

    
    <div class="container">     
      <div  class="row">
        <video autoplay="true" id="video-webcam" width="160px" height="122px"> </video>
      </div>
    </div>

  </div>
</div>


<script>

$("#fullscreenExam").hide();
$("#text").hide();
$("#start").hide();

var elem = document.querySelector("#fullscreenExam");
function openFullscreen() {
    $("#fullscreenExam").show();
<<<<<<< HEAD
    if (elem.webkitRequestFullScreen) {
        elem.webkitRequestFullScreen();
    }  
    const waktu_selesai = new Date('<?php echo $waktu_selesai ?>').getTime(); 
=======
    if (elem.requestFullscreen) {
        elem.requestFullscreen();
    }
    const waktu_selesai = new Date('<?php echo $waktu_selesai ?>').getTime();
>>>>>>> 9c850ac57b6d3ad06338fa1b7ef860189092967b

    const hitung_durasi = setInterval(function() {
        const sekarang = new Date().getTime();
        const durasi = waktu_selesai - sekarang;

        const jam = Math.floor(durasi % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
        const menit = Math.floor(durasi % (1000 * 60 * 60 ) / (1000 * 60 ));
        const detik = Math.floor(durasi % (1000 * 60 ) / 1000 );

        const teks_durasi = document.getElementById('teks_durasi');
        teks_durasi.innerHTML = 'Ujian akan di berakhir dalam : ' + jam + ' jam ' + menit + ' menit ' + detik + ' detik lagi ';

        if( durasi < 0 ) {
            clearInterval(hitung_durasi);
            teks_durasi.innerHTML = 'Ujian telah berakhir';
            closeFullscreen();
        }
    }, 1000);

}

function closeFullscreen() {
    if (document.exitFullscreen) {
        document.exitFullscreen();
        $("#fullscreenExam").hide();
    }
}
// --------------------------------------------------------------------------

// pengaturan JS untuk hitung waktu mulai ujian
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
// --------------------------------------------------------------------------


//Pengaturan JS untuk akses kamera user
    // seleksi elemen video
    var video = document.querySelector("#video-webcam");

    // minta izin user
    navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;

    // jika user memberikan izin
    if (navigator.getUserMedia) {
        // jalankan fungsi handleVideo, dan videoError jika izin ditolak
        navigator.getUserMedia({ video: true }, handleVideo, videoError);
    }

    // fungsi ini akan dieksekusi jika  izin telah diberikan
    function handleVideo(stream) {
        video.srcObject = stream;
    }

    // fungsi ini akan dieksekusi kalau user menolak izin
    function videoError(e) {
        // do something
        alert("Izinkan menggunakan webcam untuk demo!")
    }



// Pengaturan JS untuk Pagination
$(document).ready(function(){
    $(document).on('click', '.pagination a',function(event){
        event.preventDefault(); //stop refresh webpage
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
    });
    function fetch_data(page)
    {
        const ujian_id = $('#ujian_id').val();
        $.ajax({
            url:"/pagination/fetch_data?page="+page,
            type: "GET",
            data: {
              ujian_id: ujian_id
            },
            success: function(soal_satuan)
            {
                $('#table_data').html(soal_satuan);
            }
        });
    }
});

</script>
@endsection
