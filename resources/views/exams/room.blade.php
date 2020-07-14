@extends('layouts.sidebar')
@section('content')
<style>
:fullscreen {
  background-color:black;
}
</style>
@if(session('sukses'))
  <div class="alert alert-success" role="alert">
    {{session('sukses')}}
  </div>
@endif
<div class="container">
    @if($ujian_run->count() != 0) 
    <div class="row justify-content-center">
        @foreach ($ujian_run as $item)
        <div class="col-sm-4">
            <div class="card text-center mb-4">
                <div class="card-header"  style="border-radius: 20px 20px 0px 0px; background: #EDE5E5; "><strong style="color:black">{{$item->nama_ujian}}</strong></div>
                <div class="card-body">  
                    <p class="card-text">
                        Waktu Mulai : {{date("d-m-Y H:i:s",strtotime($item->waktu_mulai))}} <br>
                        <?php   $durasi_jam   =  date('H', strtotime($item->paket_soal->durasi));
                                $durasi_menit =  date('i', strtotime($item->paket_soal->durasi)); ?>
                        Durasi : {{ $durasi_jam }} jam {{ $durasi_menit }} menit
                    </p>
                    <button type="button" onclick="openFullscreen();" class="btn btn-info btn-sm monitoring" id="{{$item->id}}" data-ujian_id="{{$item->id}}">
                        <i class="fa fa-laptop fa-sm"></i> Monitoring Ujian 
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
<hr>

    @if($ujian_aktif->count() != 0) 
    <div class="text-center alert alert-warning"> <strong style="font-size:18px">Ujian yang akan datang</strong></div>
    <div class="row">
        @foreach ($ujian_aktif as $item)
        <div class="col-sm-4">
            <div class="card text-center mb-4">
            <div class="card-body">
                <strong  style="color:black">{{$item->nama_ujian}}</strong> 
                <p class="card-text">
                    Waktu Mulai : {{date("d-m-Y H:i:s",strtotime($item->waktu_mulai))}} <br>
                    <?php   $durasi_jam   =  date('H', strtotime($item->paket_soal->durasi));
                            $durasi_menit =  date('i', strtotime($item->paket_soal->durasi)); ?>
                    Durasi : {{ $durasi_jam }} jam {{ $durasi_menit }} menit
                </p>
            </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong> Tidak ada ujian yang perlu di awasi</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
    @endif

</div>

<!-- fullscreen monitoring ujian   -->
<div id="fullscreenExam">
        <div class="row"> 
            <div class="card" style="border-radius:0px; height:120px; width:100%; background: linear-gradient(180deg, rgba(247, 253, 251, 0.85) 0%, rgba(39, 182, 130, 0.85) 100%);" >
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="row justify-content-center">
                    <div class="card mt-4 ml-10 mr-10" style="border-radius:0px; background:black; box-shadow:0px 0px 0px black;">
                        <video autoplay="true" id="video-webcam" width="600px" height="440px"> </video>
                    </div>
                </div>
                <div class="row">
                
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="border-radius:0px; height:650px; background: linear-gradient(180deg, rgba(17, 0, 23, 0.96) -83.9%, rgba(44, 5, 60, 0.96) -2.49%, #5E2575 54.53%, #BEA2CF 111.53%);">
                    
                </div>
            </div>
        </div>
</div>
<!-- penutup fullscreen  -->

<script>

$("#fullscreenExam").hide();

// Menampilkan fullscreen pengawasan ujian
var elem = document.querySelector("#fullscreenExam");
function openFullscreen() {
    
    $("#fullscreenExam").show();
    if (elem.requestFullscreen) {
        elem.requestFullscreen();
    }
}

// menghitung timer
setInterval(myTimer, 1000);
function myTimer() {
    var d               = new Date();
    var tanggal         = d.toISOString().split('T')[0];
    var time            = new Date().toString('hh:mm:tt');
    var time_string     = time.substr(16,8);
    var waktu_sekarang  = tanggal + ' ' + time_string;

    var ujian = <?php echo $tabel ?>; // mengambil data object array ujian dari controller
    console.log(ujian);
    for (var key in ujian) {
        var waktu_ujian = (key, ujian[key][3]);
        var ujian_id = (ujian[key][0]);
        
        // perbandingan waktu mulai ujian dengan waktu sekarang
        if (waktu_ujian === waktu_sekarang) {
            console.log('mulai ujian');
            $(".tombol_monitoring").show();
            $.ajax({
                url: "{{ url('run/exam') }}",
                type: "GET",
                dataType: 'json',
                data: {
                    ujian_id: ujian_id
                },
                success: function(data) {
                    console.log(data);
                }
            });
        } else {
            console.log(waktu_ujian);
        }
        // ------------------------------------
    }
}

// hitung selisih waktu, jika sudah masuk waktu mulai maka status berubah jadi 1
var ujian_data = <?php echo $tabel ?>;    
for (var key in ujian_data) { 
    var start       = (key, ujian_data[key][5]);
    var finish      = (key, ujian_data[key][6]);
    var ujian_id       = (ujian_data[key][0]);

    const mulai     = new Date(start).getTime();
    const sekarang  = new Date().getTime();
    const selisih   = mulai - sekarang;

    if( selisih <= 0 ) {
        $.ajax({
            url: "{{ url('run/exam') }}",
            type: "GET",
            dataType: 'json',
            data: {
                ujian_id: ujian_id
            },
            success: function(data) {
                console.log(data);
            }
        });
    }
}
// ---------------------------------------------------

// ubah status jadi 2 jika ujian telah selesai 
var ujian_run = <?php echo $run ?>;    
for (var key in ujian_run) { 
    var start       = (key, ujian_run[key][5]);
    var finish      = (key, ujian_run[key][6]);
    var ujian_id    = (ujian_run[key][0]);

    const selesai   = new Date(finish).getTime();
    const sekarang  = new Date().getTime();
    const selisih   = selesai - sekarang;

    if( selisih < 0 ) {
        $.ajax({
            url: "{{ url('stop/exam') }}",
            type: "GET",
            dataType: 'json',
            data: {
                ujian_id: ujian_id
            },
            success: function(data) {
                console.log(data);
            }
        });
    }
}
// ---------------------------------------------------

//Pengaturan JS untuk akses kamera user
var video = document.querySelector("#video-webcam");
navigator.getUserMedia   =  navigator.getUserMedia || 
                            navigator.webkitGetUserMedia || 
                            navigator.mozGetUserMedia || 
                            navigator.msGetUserMedia || 
                            navigator.oGetUserMedia;
if (navigator.getUserMedia) {
    navigator.getUserMedia({ video: true }, handleVideo, videoError);
}
function handleVideo(stream) {
    video.srcObject = stream;
}
function videoError(e) {
    alert("Izinkan menggunakan webcam untuk demo!")
}



// // Objek hanya bisa di buka melalui console
// console.log(obj);
// console.log(obj.waktu_mulai);
  // ujian.forEach(function() {
//       var waktu_mulai = 
//       if (waktu_mulai == waktu_sekarang) {
//           ajax. update status run
//           munculkan tombol monitoring
//       }
//   })



// tombol monitoring di klik, fullscreen tampil. bawa data ujian id ke kontroller. balikin detail ujian 
// hitung durasi
// kalo duraasi habis, update status ujian jadi finish



    // var options         = {  year: 'numeric', month: 'numeric', day: 'numeric', hour: 'numeric', hour24:true, minute: 'numeric', second: 'numeric' };
    // var d               = new Date().toLocaleString("en-US",options, {timeZone: "Asia/Jakarta"});
    // var jam             = parseInt(d.toISOString().substr(11,2)) + 7 ;
    // var menit_detik     = d.toISOString().substr(13, 6);
</script>
@endsection
