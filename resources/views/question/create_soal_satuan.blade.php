@extends('layouts.sidebar')

@section('content')

<div class="col-md-12">
    <div class="card" style="border-radius:20px;  box-shadow: 10px 10px 5px rgba(48, 10, 64, 0.5);">
        <div class="card-header  pt-3 pb-2 text-center" style="border-radius: 20px 20px 0px 0px; background-color:#7BEDC4;">
            <h4 class="card-title"> Soal  </h4>
        </div>
        <div class="card-body">

            <div class="container">
            
                    <input type="hidden" name="paket_soal_id" value="{{ $paket_soal_id }}">
                    <div class="row">
                        <div class="col-md-1">No. 1</div>
                        <div class="col-md-4">
                            <select name="jenis" class="form-control" required width="100%">
                                <option value="">Jenis Soal</option>
                                <option value="essay" >Essay</option>
                                <option value="pilgan" >Pilihan Ganda</option>
                                <option value="pilbanyak">Pilihan Banyak</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="poin" class="poin form-control" placeholder="Poin" >
                        </div>
                        <div class="col-md-3">   
                            <button type="submit" class="btn btn-primary" data-toggle="modal" data-target=".create_modal" 
                                    id="create" 
                                    data-paket_soal_id = "{{ $paket_soal_id }}" 
                                    style="box-shadow: 3px 2px 5px grey;"> <i class="fa fa-plus"></i> Tambah Soal</button>
                        </div>
                    </div>
            </div>

        </div>
    </div>
</div>


<!-- Create Modal (essay)-->
<div class="modal fade create_modal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title " id="exampleModalLabel"> Soal No. </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="question_store/essay_store" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="container">  

                            <input type="hidden" name="paket_soal_id" id="paket_soal_id" value="">
                            <input type="hidden" name="soal_satuan_id" id="soal_satuan_id" value="1">
                           
                            <div class="form-group row">
                                <label for="nama" class="col-sm-2 col-form-label">No. 1</label>
                                <div class="col-sm-6">
                                <input type="text" class="form-control" id="jenis" name="jenis" value="" readonly>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend" >
                                            <div class="input-group-text">Poin</div>
                                        </div>
                                        <input type="text" name="poin" id="poin" value=""  class="form-control text-right" readonly>
                                    </div>
                                </div>
                            </div>  

                            <div class="form-group">
                                <label for="alamat"> Pertanyaan </label>
                                <textarea class="form-control" id="pertanyaan" rows="2" name="pertanyaan" placeholder=""> </textarea>
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



<script>
$(document).ready(function(){
    $(document).on('click','#create', function(){
        var id              = $(this).data('id');
        var paket_soal_id   = $(this).data('paket_soal_id');
        var poin            = $(".poin").val();
        var jenis           = $('select').val();
           
        $('#id').val(id); 
        $('#paket_soal_id').val(paket_soal_id); 
        $('#poin').val(poin); 
        $('#jenis').val(jenis); 
    });    
});
</script>


@endsection
