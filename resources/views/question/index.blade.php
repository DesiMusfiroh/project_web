@extends('layouts.sidebar')

@section('content')
@if(session('pesan'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{session('pesan')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<div class="container">
    <div class="row  justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"  style="border-radius: 20px 20px 0px 0px; background: #EDE5E5;">
                    <div class="row">
                        <div class="col-md-6">
                            <strong style="font-size:18px"> Paket Soal </strong>
                        </div>
                        <div class="col-md-6 ">
                            <div class="text-right" style="font-size:20px; font-family:segoe ui black; font-weight:bold;">
                                <a href="/question_create"> <button type="button" class="btn" style="border: none; box-shadow: 3px 3px 3px rgba(119, 52, 171, 0.46); background-color:#7BEDC4;">
                                    [ <i class="fa fa-plus"></i> ]  Buat Paket Soal Baru </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                @if($paketsoal->count() != 0)
                    <table class="table table-striped table-bordered table-sm">
                        <thead class="thead-dark text-center">
                            <tr>
                                <th scope="col" style="width:50px">No</th>
                                <th scope="col" >Judul Paket Soal </th>
                                <th scope="col" style="width:150px">Durasi </th>
                                <th scope="col" style="width:130px">Jumlah Soal </th>
                                <th scope="col" style="width:150px">Download </th>
                                <th scope="col" style="width:150px">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; ?>
                            @foreach ($paketsoal as $item)
                            <tr>
                                <td scope="row" class="text-center"><?php  $i++;  echo $i; ?></td>
                                <td >{{ $item->judul }}</td>
                                <td class="text-center">
                                    <?php
                                    $durasi_jam   =  date('H', strtotime($item->durasi));
                                    $durasi_menit =  date('i', strtotime($item->durasi));
                                    ?>
                                    {{ $durasi_jam }} jam {{ $durasi_menit }} menit
                                 </td>

                                <td class="text-center">{{$item->jumlah_soal()}} Soal</td>
                                <td class="text-center">

                                <a  href="{{route('exportSoal',$item->id)}}" target="_blank" >
                                    <button type="button" class="btn btn-info btn-sm">
                                    <i class="fa fa-download" aria-hidden="true"> Soal</i>
                                        </button>
                                    </a>
                                <a  href="{{route('exportJawaban',$item->id)}}" target="_blank" >
                                    <button type="button" class="btn btn-secondary btn-sm">
                                    <i class="fa fa-download" aria-hidden="true"> Kunci</i>
                                        </button>
                                    </a>

                                </td>
                                <td class="text-center">
                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target=".update_modal_paket"
                                    id="update"
                                    data-id_paket_update="{{ $item->id }}"
                                    data-user_id_paket_update="{{ $item->user->id }}"
                                    data-judul_paket_update="{!! $item->judul!!}"
                                    data-durasi_paket_update="{!! $item->durasi !!}"
                                     title="Ubah paket soal">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                                </button>
                                    <a href="{{route('question_create_soal_satuan',$item->id)}}" title="Tambah soal">
                                        <button type="button" class="btn btn-success btn-sm">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </a>
                                    <a href="#" title="Hapus paket soal" class="hapus" paket_soal_id="{{$item->id}}" paket_soal_judul="{{$item->judul}}">
                                        <button type="button" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash fa-sm"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong> Belum ada paket soal yang di buat. Silahkan buat paket soal baru!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>


<!-- update Modal (paket)-->
<div class="modal fade update_modal_paket"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title " id="exampleModalLabel"> <strong>Edit Paket Soal</strong> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/question/update" method="post">

                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="container">

                            <input type="hidden" name="id" id="id_paket_update" value="">
                            <input type="hidden" name="user_id" id="user_id_paket_update" value="">

                            <div class="form-row mb-0 mt-0 pt-0">
                                <div class="form-group col-md-9">
                                    <label for="judul"><b> Judul  : </b></label>
                                    <input type="text" class="form-control" id="judul_paket" value="" name="judul" placeholder="Nama paket soal" style="border-radius:10px;  box-shadow: 3px 0px 5px grey;">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="durasi"> <b> Durasi </b> </label>
                                    <input type="hidden" id="durasi_paket_update" value="">
                                    @if($errors->has('durasi'))
                                                <span class="help-block">{{$errors->first('durasi')}}</span>
                                    @endif
                                    <!-- <input  id="time" class="form-control"  type="time" name="durasi" onchange="ampm(this.value)"  style="border-radius:10px; box-shadow: 3px 0px 5px grey;"> -->
                                    <input  id="time" class="form-control" type="time" name="durasi" style="border-radius:10px; box-shadow: 3px 0px 5px grey;">
                                    <span id="display_time"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- Penutup Create Modal -->
<!-- <script>
function ampm(time) {
    console.log(time);
    if (time.value !== "") {
        var hours = time.split(":")[0];
        var minutes = time.split(":")[1];
        var suffix = hours >= 12 ? "pm" : "am";
        hours = hours % 12 || 12;
        hours = hours < 10 ? "0" + hours : hours;

        var displayTime = hours + ":" + minutes + " " + suffix;
        document.getElementById("display_time").innerHTML = displayTime;
    }
}
</script> -->
<!--edit essay-->
<script type="text/javascript">
$(document).ready(function(){
    $(document).on('click','#update', function(){
        var id_paket_update        = $(this).data('id_paket_update');
        var user_id_paket_update   = $(this).data('user_id_paket_update');
        var judul_paket_update     = $(this).data('judul_paket_update');
        var durasi_paket_update    = $(this).data('durasi_paket_update');
        $('#id_paket_update ').val(id_paket_update );
        $('#user_id_paket_update').val(user_id_paket_update);
        $('#judul_paket').val(judul_paket_update );
        $('#durasi_paket_update').val(durasi_paket_update );

        var durasi_awal = document.getElementById("durasi_paket_update").value;

        // var timeControl = document.querySelector('input[type="time"]');
        // timeControl.value = durasi_awal.toISOString().substring(7, 16);
        console.log(durasi_awal);
    });
    $('.hapus').click(function(){
      // const menghapus = confirm('yakin mau hapus?');
      // if (menghapus) {
      //   window.location = "/exam/delete/{{$item->id}}";
      // }
      var paket_soal_id = $(this).attr('paket_soal_id');
      var paket_soal_judul = $(this).attr('paket_soal_judul');
      swal({
        title: "Yakin?",
        text: "Menghapus ujian "+paket_soal_judul+ " ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location = 'question/delete/'+paket_soal_id;
        }
      });
    });
});

</script>
<!--edit-->
@endsection
