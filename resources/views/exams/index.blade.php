@extends('layouts.sidebar')
@section('content')
@if(session('sukses'))
  <div class="alert alert-success" role="alert">
    {{session('sukses')}}
  </div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"  style="border-radius: 20px 20px 0px 0px; background: #EDE5E5;">
                    <div class="row">
                        <div class="col-md-6">
                            <strong style="font-size:18px">  Ujian </strong>
                        </div>
                        <div class="col-md-6 ">
                            <div class="text-right" style="font-size:20px; font-family:segoe ui black; font-weight:bold;">
                                <a href="{{route('createExam')}}"> <button type="button" class="btn" style="background-color:#7BEDC4; border: none; box-shadow: 3px 3px 3px rgba(119, 52, 171, 0.46);">
                                    [ <i class="fa fa-plus"></i> ]  Buat Ujian </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                @if($ujian->count() != 0)
                <table class="table table-striped table-bordered table-sm">
                        <thead class="thead-dark text-center" >
                            <tr>
                                <th scope="col" style="width:50px">No</th>
                                <th scope="col" >Nama Ujian </th>
                                <th scope="col" >Judul Paket Soal </th>
                                <th scope="col" >Kode Akses </th>
                                <th scope="col" >Jadwal Ujian </th>
                                <th scope="col" style="width:150px">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; ?>
                            @foreach ($ujian as $item)
                            <tr>
                                <td scope="row" class="text-center">{{$ujian ->perPage()*($ujian->currentPage()-1)+$i}}</td>
                                <?php $i++; ?>
                                <td >{{$item->nama_ujian}}</td>
                                <td class="text-center">{{ $item->paket_soal->judul }} </td>
                                <td class="text-center">{{ $item->kode_ujian }} </td>
                                <td class="text-center"> {{date("d-m-Y",strtotime($item->waktu_mulai))}} </td>
                                <td class="text-center">
                                    <a href="{{route('editExam',$item->id)}}">
                                        <button type="button" class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit fa-sm"></i>
                                        </button>
                                    </a>
                                    <a href="#" class="hapus_ujian" exam_id="{{$item->id}}" exam_nama="{{$item->nama_ujian}}" >
                                        <button type="button" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash fa-sm"></i>
                                        </button>
                                    </a>
                                    <a href="{{route('openMyExam',$item->id)}}">
                                        <button type="button" class="btn btn-info btn-sm">
                                            <i class="fa fa-eye fa-sm"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div >{{$ujian->onEachSide(4)->links()}}</div>

                    @else
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong> Belum ada ujian yang di buat. Silahkan buat ujian baru!</strong>
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
<script>
$('.hapus_ujian').click(function(){
  // const menghapus = confirm('yakin mau hapus?');
  // if (menghapus) {
  //   window.location = "/exam/delete/{{$item->id}}";
  // }
  var exam_id = $(this).attr('exam_id');
  var exam_nama = $(this).attr('exam_nama');
  swal({
    title: "Yakin?",
    text: "Menghapus ujian "+exam_nama+ " ?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      window.location = "/exam/delete/"+exam_id;
    }
  });
});
</script>
@endsection
