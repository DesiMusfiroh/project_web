@extends('layouts.sidebar')

@section('content')
    @if(session('sukses'))
      <div class="alert alert-success" role="alert">
        {{session('sukses')}}
      </div>
    @endif
        <div class="container">
            <?php $i=0; ?>
            @foreach($jawaban_essay as $item)
                <div class="row">
                    <div><h6>Soal No.  <?php  $i++;  echo $i; ?> </h6></div>
                    <div class="col-md-1 text-right"><h6>{{$item->jawab}}</h6></div>
                    <div class="col-md-7 text-right"><h6>Jawaban: {{$item->jawab}}</h6></div>
                    <div class="col-md-7 text-right"><h6>Score: {{$item->score}}</h6></div>
                </div>
            @endforeach
        </div>
    </div>
</div>



<!-- Create Modal (essay)-->
<div class="modal fade create_modal_essay"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title " id="exampleModalLabel"> Soal No. </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{route('storeSingleQuestionEssay')}}" enctype="multipart/form-data" method="post">
                   @csrf
                    <div class="modal-body">
                        <div class="container">

                            <input type="hidden" name="paket_soal_id" class="paket_soal_id" value="">
                            <input type="hidden" name="soal_satuan_id" id="soal_satuan_id" value="">

                            <div class="form-group row">
                                <label for="nama" class="col-sm-2 col-form-label">No. 1</label>
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="jenis" name="jenis" value="Essay" readonly >
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend" >
                                            <div class="input-group-text">Poin</div>
                                        </div>
                                        <input type="text" name="poin" id="poin" value=""  class="form-control text-right">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="alamat"> Pertanyaan </label>
                                <textarea class="form-control" id="pertanyaanessay" rows="2" name="pertanyaan" placeholder=""> </textarea>
                            </div>
                            <div class="form-group">
                                <label for="alamat"> Jawaban Benar</label>
                                <textarea class="form-control" id="jawaban" rows="2" name="jawaban" placeholder="opsional"> </textarea>
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

<!-- Create Modal (Pilgan)-->
<div class="modal fade create_modal_pilgan"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title " id="exampleModalLabel"> Soal No. </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{route('storeSingleQuestionPilgan')}}" enctype="multipart/form-data" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="modal-body">
                        <div class="container">

                            <input type="hidden" name="paket_soal_id" class="paket_soal_id" value="">
                            <input type="hidden" name="soal_satuan_id" id="soal_satuan_id" value="">

                            <div class="form-group row">
                                <label for="nama" class="col-sm-2 col-form-label">No. 1</label>
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="jenis" name="jenis" value="Pilihan Ganda" readonly>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend" >
                                            <div class="input-group-text">Poin</div>
                                        </div>
                                        <input type="text" name="poin" id="poin" value=""  class="form-control text-right">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="alamat"> Pertanyaan </label>
                                <textarea class="form-control" id="pertanyaanpilgan" rows="2" name="pertanyaan" placeholder=""> </textarea>
                            </div>
                            <div class="form-group" >
                                <!-- Pilihan A-->
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend" style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;">
                                        <span class="input-group-text" > A </span>
                                    </div>
                                    <input type="text" name="pil_a" id="pil_a" class="form-control" >
                                </div>
                                <!-- Pilihan B-->
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend" style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;">
                                        <span class="input-group-text"> B </span>
                                    </div>
                                    <input type="text" name="pil_b" id="pil_b"  class="form-control" >
                                </div>
                                 <!-- Pilihan C-->
                                 <div class="input-group mb-2">
                                    <div class="input-group-prepend" style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;">
                                        <span class="input-group-text" > C </span>
                                    </div>
                                    <input type="text" name="pil_c" id="pil_c"  class="form-control" >
                                </div>
                                 <!-- Pilihan D-->
                                 <div class="input-group mb-2">
                                    <div class="input-group-prepend" style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;">
                                        <span class="input-group-text"> D </span>
                                    </div>
                                    <input type="text" name="pil_d" id="pil_d"  class="form-control" >
                                </div>
                                 <!-- Pilihan E-->
                                 <div class="input-group mb-2">
                                    <div class="input-group-prepend" style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;">
                                        <span class="input-group-text"> E </span>
                                    </div>
                                    <input type="text" name="pil_e" id="pil_e" class="form-control" >
                                </div>
                                <div class="input-group-inline">
                                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Jawaban Benar</label>
                                        <select class="custom-select my-1 mr-sm-2" name="kunci" >
                                            <option selected>Choose...</option>
                                            <option value="A" >A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                            <option value="E">E</option>
                                        </select>
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

<!-- Create Modal (pilbanyak)-->
    <div class="modal fade create_modal_pilbanyak"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header ">
                        <h5 class="modal-title " id="exampleModalLabel"> Soal No. </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="#" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="container">

                                <input type="hidden" name="paket_soal_id" id="paket_soal_id" value="">
                                <input type="hidden" name="soal_satuan_id" id="soal_satuan_id" value="">

                                <div class="form-group row">
                                    <label for="nama" class="col-sm-2 col-form-label">No. 1</label>
                                    <div class="col-sm-6">
                                    <input type="text" class="form-control" id="jenis" name="jenis" value="Pilihan Banyak" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend" >
                                                <div class="input-group-text">Poin</div>
                                            </div>
                                            <input type="text" name="poin" id="poin" value=""  class="form-control text-right">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="alamat"> Pertanyaan </label>
                                    <textarea class="form-control" id="pertanyaan" rows="2" name="pertanyaan" placeholder=""> </textarea>
                                </div>
                                <div class="form-group">


    <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">
            <input type="checkbox"/>
                <div class="control__indicator"></div>
        </label>
        <div class="col-sm-10">
        <input type="text" name="#" id="#"  class="form-control" >
        </div>
    </div>
    <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">
            <input type="checkbox"/>
                <div class="control__indicator"></div>
        </label>
        <div class="col-sm-10">
        <input type="text" name="#" id="#"  class="form-control" >
        </div>
    </div>
    <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">
            <input type="checkbox"/>
                <div class="control__indicator"></div>
        </label>
        <div class="col-sm-10">
        <input type="text" name="#" id="#"  class="form-control" >
        </div>
    </div>
    <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">
            <input type="checkbox"/>
                <div class="control__indicator"></div>
        </label>
        <div class="col-sm-10">
        <input type="text" name="#" id="#"  class="form-control" >
        </div>
    </div>
    <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">
            <input type="checkbox"/>
                <div class="control__indicator"></div>
        </label>
        <div class="col-sm-10">
        <input type="text" name="#" id="#"  class="form-control" >
        </div>
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

<script>
$(document).ready(function(){
    $(document).on('click','#create', function(){
        var id              = $(this).data('id');
        var paket_soal_id   = $(this).data('paket_soal_id');

        $('#id').val(id);
        $('.paket_soal_id').val(paket_soal_id);

    });
});

</script>


@stop
@section('ckeditor')
  <script>
                  ClassicEditor
                              .create( document.querySelector( '#pertanyaanessay' ) )
                              .then( pertanyaanessay => {
                                      console.log( pertanyaanessay );
                              } )
                              .catch( error => {
                                      console.error( error );
                              } );
                              ClassicEditor
                                          .create( document.querySelector( '#jawaban' ) )
                                          .then( jawaban => {
                                                  console.log( jawaban );
                                          } )
                                          .catch( error => {
                                                  console.error( error );
                                          } );

                                          ClassicEditor
                                                      .create( document.querySelector( '#pertanyaanpilgan' ) )
                                                      .then( pertanyaanpilgan => {
                                                              console.log( pertanyaanpilgan );
                                                      } )
                                                      .catch( error => {
                                                              console.error( error );
                                                      } );
  </script>
@stop
