@extends('layouts.app')

@section('content')
<!-- <div id="app"></div> -->
<style>
.booth{
    width: 400px;
    background: #ccc;
    border: 10px solid #ddd;
    margin: 0 auto;
}
</style>
<video autoplay="true" id="video-webcam">
            Browsermu tidak mendukung 
        </video>

<script >

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
</script>
@endsection