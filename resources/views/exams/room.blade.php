@extends('layouts.sidebar')
@section('content')
@if(session('sukses'))
  <div class="alert alert-success" role="alert">
    {{session('sukses')}}
  </div>
@endif
<div class="container">
    @if($ujian_aktif->count() != 0) 
    <div class="row">
        @foreach ($ujian_aktif as $item)
        <div class="col-sm-4">
            <div class="card text-center mb-4">
            <div class="card-body">
                <h5 class="card-title"><strong>{{$item->nama_ujian}}</strong> </h5>
                <p class="card-text">
                    Waktu Mulai : {{date("d-m-Y H:i:s",strtotime($item->waktu_mulai))}} <br>
                    <?php   $durasi_jam   =  date('H', strtotime($item->paket_soal->durasi));
                            $durasi_menit =  date('i', strtotime($item->paket_soal->durasi)); ?>
                    Durasi : {{ $durasi_jam }} jam {{ $durasi_menit }} menit
                </p>
                <button type="button" onclick="openFullscreen();" class="btn btn-info btn-sm tombol_monitoring" id="{{$item->id}}" data-ujian_id="{{$item->id}}">
                    <i class="fa fa-laptop fa-sm"></i> Monitoring Ujian 
                </button>
            </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong> Tidak ada ujian yang akan berlangsung</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
    @endif

</div>

<!-- fullscreen monitoring ujian   -->
<div id="fullscreenExam">
    <div class="container">
        <div class="row"> Judul </div>
        <div class="row">
            <div class="col-md-9">
                Tampilan Kamera
            </div>
            <div class="col-md-3">
                Peserta
            </div>
        </div>
        <div class="row">
            scrolling
        </div>
    </div>
</div>
<!-- penutup fullscreen  -->
<script>
$("#fullscreenExam").hide();
$(".tombol_monitoring").hide();

var elem = document.querySelector("#fullscreenExam");
function openFullscreen() {
    
    $("#fullscreenExam").show();
    // var ujian_id = $(this).data('ujian_id');
    // alert(ujian_id);
    // $.ajax({
    //     url: "{{ url('run/exam') }}",
    //     type: "GET",
    //     dataType: 'json',
    //     data: {
    //         ujian_id: ujian_id
    //     },
    //     success: function(data) {
	// 		console.log(data);
	// 	}
    // });
    if (elem.requestFullscreen) {
        elem.requestFullscreen();
    }
}

setInterval(myTimer, 1000);

function myTimer() {
    var d               = new Date();
    var tanggal         = d.toISOString().split('T')[0];
    var jam             = parseInt(d.toISOString().substr(11,2)) + 7 ;
    var menit_detik     = d.toISOString().substr(13, 6);
    var waktu_sekarang  = tanggal + ' ' + jam + menit_detik;
   
    var ujian = <?php echo $tabel ?>; // mengambil data object array ujian dari controller

    for (var key in ujian) {
        var waktu_ujian = (key, ujian[key][3]);
        var ujian_id = (key, ujian[key][0]);
        if (waktu_ujian !== waktu_sekarang) {
            // munculkan tombol monitoring yang id nya = ujian id
        }
    }
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
</script>
@endsection
