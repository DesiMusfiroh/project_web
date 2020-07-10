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
        <p>Durasi : {{ $ujian->paket_soal->durasi}}</p>
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
          <h6>Durasi Pengerjaan : {{ $ujian->paket_soal->durasi }}</h6>
          <div id="teks_durasi"></div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Soal Ujian</div>
          <div class="card-body">
            <?php $i=0; ?>   
            @foreach($soal_satuan as $item)
                <div class="row">
                    <div class="col-md-3"><h6>Soal No.  <?php  $i++;  echo $i; ?> </h6></div>
                    <div class="col-md-7 text-right"><h6>Poin : {{$item->poin}}</h6></div>
                </div>
                <table>
                @if($item->jenis == "Essay")
                    <tr>
                        <td width="130px"><b> Pertanyaan </b></td> <td width="10px"> : </td>
                        <td> {{$item->essay->pertanyaan}} </td>
                    </tr>
                    <div>
                      <textarea class="form-control" name="" id="" cols="30" rows="3">Jawaban Anda ...</textarea>
                    </div>
                  
                @elseif($item->jenis == "Pilihan Ganda")
                    <tr>
                        <td width="130px"><b> Pertanyaan </b></td> <td  width="10px"> : </td>
                        <td> {{$item->pilgan->pertanyaan}} </td>
                    </tr>
                    <tr>
                        <td> <b> Pilihan </b> </td> <td> : </td>
                        <td>  A . {{$item->pilgan->pil_a}}  <br>
                                 B . {{$item->pilgan->pil_b}}  <br>
                                 C . {{$item->pilgan->pil_c}}  <br>
                                 D . {{$item->pilgan->pil_d}}  <br>
                                 E . {{$item->pilgan->pil_e}}
                        </td>
                    </tr>
                    @endif
                </table>

                <hr>
            @endforeach

            <div class="row ">
              <div class="col-12 text-center ">
                {{ $soal_satuan->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <div class="card-header">Navigasi</div>
          <div class="card-body">
          
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8"></div>
      <div class="col-md-4">
        <button class="btn btn-danger" onclick="closeFullscreen();"> Selesai </button>
      </div>
    </div>

    <!-- <div class="card">
        <div class="card-header">
        <h4> {{ $ujian->paket_soal->judul }} </h4>
        </div>
        <div class="card-body">
            <?php $i=0; ?>   
            @foreach($soal_satuan as $item)
                <div class="row">
                    <div class="col-md-3"><h6>Soal No.  <?php  $i++;  echo $i; ?> </h6></div>
                    <div class="col-md-7 text-right"><h6>Poin : {{$item->poin}}</h6></div>
                </div>
                <table>
                @if($item->jenis == "Essay")
                    <tr>
                        <td width="130px"><b> Pertanyaan </b></td> <td width="10px"> : </td>
                        <td> {{$item->essay->pertanyaan}} </td>
                    </tr>
                  
                @elseif($item->jenis == "Pilihan Ganda")
                    <tr>
                        <td width="130px"><b> Pertanyaan </b></td> <td  width="10px"> : </td>
                        <td> {{$item->pilgan->pertanyaan}} </td>
                    </tr>
                    <tr>
                        <td> <b> Pilihan </b> </td> <td> : </td>
                        <td>  A . {{$item->pilgan->pil_a}}  <br>
                                 B . {{$item->pilgan->pil_b}}  <br>
                                 C . {{$item->pilgan->pil_c}}  <br>
                                 D . {{$item->pilgan->pil_d}}  <br>
                                 E . {{$item->pilgan->pil_e}}
                        </td>
                    </tr>
                @endif
                </table>

                <hr>
            @endforeach
        </div>
        <div class="card-footer">
           
            
        </div>
    </div> -->


  </div>
</div>


<script>

$("#fullscreenExam").hide();
$("#text").hide();
$("#start").hide();

var elem = document.querySelector("#fullscreenExam");
function openFullscreen() {
    $("#fullscreenExam").show();
    if (elem.requestFullscreen) {
        elem.requestFullscreen();
    }  
    const waktu_selesai = new Date('<?php echo $waktu_selesai ?>').getTime(); 

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

   
</script>


@endsection
