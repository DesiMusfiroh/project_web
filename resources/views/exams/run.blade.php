@extends('layouts.sidebar')

@section('content')

<div class="card"  style="border-radius:20px;  box-shadow: 10px 10px 5px rgba(48, 10, 64, 0.5);" >
    <div class="card-header text-center "  style="border-radius: 20px 20px 0px 0px; background-color:#7BEDC4;">
        <h4>{{ $ujian->nama_ujian}} </h4>
    </div>
    <div class="card-body">
        <p>Durasi : {{ $ujian->paket_soal->durasi}}</p>
        <p>Waktu Mulai : {{$ujian->waktu_mulai}}</p>
            
        <div id="teks">Waktu </div>
    
        <hr>
    
        <div id="soal">
            judul {{ $ujian->paket_soal->judul }}
            <div class="container">
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
           
        </div>
    </div>
</div>




<script>

const waktu_selesai = new Date('<?php echo $waktu_selesai ?>').getTime(); 

const hitung_mundur = setInterval(function() {
    const waktu_sekarang = new Date().getTime();
    const selisih = waktu_selesai - waktu_sekarang;

    const jam = Math.floor(selisih % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
    const menit = Math.floor(selisih % (1000 * 60 * 60 ) / (1000 * 60 ));
    const detik = Math.floor(selisih % (1000 * 60 ) / 1000 );

    const teks = document.getElementById('teks');
    teks.innerHTML = 'Ujian akan di berakhir dalam : ' + jam + ' jam ' + menit + ' menit ' + detik + ' detik lagi ';
    $("#start").hide();

    if( selisih < 0 ) {
        clearInterval(hitung_mundur);
        teks.innerHTML = 'Ujian telah berakhir';
        $("#start").show();
    }
}, 1000);

   
</script>


@endsection
