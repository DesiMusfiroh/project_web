<div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header" style=" background: #EDE5E5;" >Soal Ujian</div>
          <div class="card-body "  >
         
  <style type="text/css">

		.pagination li{
     
			margin:5px;
      
		}
    .li:after{

    }
   
	</style>
          
            @foreach($soal_satuan as $item)
                
                <div class=" container row" >
                    <div class="col-md-3"><h6>Soal No.    </h6></div>
                    <div class="col-md-8 text-right"><h6>Poin : {{$item->poin}}</h6></div>
                </div>
                <div class="container" >
                <table >
                @if($item->jenis == "Essay")
                    <b> Pertanyaan </b> :
                        {!!$item->essay->pertanyaan!!}
                    <div class="mt-2">
                    <b> Jawaban : </b> 
                      <textarea class="form-control" name="jawab" id="jawaban_essay" cols="30" rows="3" ></textarea>
                      <input type="hidden" id="essay_id" value="{{$item->essay->id}}">
                      <input type="hidden" id="user_id" value="{{Auth::user()->id}}">
                    </div>

                @elseif($item->jenis == "Pilihan Ganda")
                    <tr>
                        <td><b> Pertanyaan </b> :<br/> <p>{!!$item->pilgan->pertanyaan!!} </p> </td>
                    </tr>
                    <tr>  
                        <td>
                          <input type="radio" class="pilihan" name="pilihan" value="A" > A . {{$item->pilgan->pil_a}}  <br>
                          <input type="radio" class="pilihan" name="pilihan" value="B" > B . {{$item->pilgan->pil_b}}  <br>
                          <input type="radio" class="pilihan" name="pilihan" value="C" > C . {{$item->pilgan->pil_c}}  <br>
                          <input type="radio" class="pilihan" name="pilihan" value="D" > D . {{$item->pilgan->pil_d}}  <br>
                          <input type="radio" class="pilihan" name="pilihan" value="E" > E . {{$item->pilgan->pil_e}}  <br>                     
                        </td>
                    </tr>
                    <input type="hidden" id="pilgan_id" value="{{$item->pilgan->id}}">
                    <input type="hidden" id="user_id" value="{{Auth::user()->id}}">
                    <input type="hidden" id="poin" value="{{$item->poin}}">
                    <input type="hidden" id="kunci" value="{{$item->pilgan->kunci}}">
                    @endif
                </table>
                </div>

                <hr>
            @endforeach

            
           
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <div class="card-header"  style=" background: #EDE5E5;">Navigasi</div>
          <div class="card-body">
            <div class="row ">
              <div class="col-12 text-center " style=" overflow: Auto;">
              {!! $soal_satuan->links() !!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <input type="hidden" value="{{ $ujian->id }}" id="ujian_id">
    <input type="hidden" value="{{ $peserta->id }}" id="peserta_id">

<script>
// Pengaturan JS untuk simpan jawaban essay
$("#jawaban_essay").change(function(){
    var jawab_essay  = $("#jawaban_essay").val();
    var essay_id     = $("#essay_id").val();
    var peserta_id   = $("#peserta_id").val();
    var user_id      = $("#user_id").val();
    const ujian_id   = $('#ujian_id').val();

    $.ajax({
        url: "{{ url('store/essay_jawab') }}",
        type: "GET",
        dataType: 'json',
        data: {
            jawab_essay: jawab_essay, 
            essay_id: essay_id,
            peserta_id: peserta_id,
            user_id: user_id,
            ujian_id: ujian_id
        },
        success: function(data) {
					  console.log(data);
				}
    });
});

// Pengaturan JS untuk simpan jawaban pilgan
$('input[type=radio][name="pilihan"]').click(function() {
    var jawab_pilgan = document.querySelector('input[name = "pilihan"]:checked').value;
    var pilgan_id    = $("#pilgan_id").val();
    var peserta_id   = $("#peserta_id").val();
    var user_id      = $("#user_id").val();
    const ujian_id   = $('#ujian_id').val();

    var poin        = $("#poin").val();
    var kunci       = $("#kunci").val();
    if ( jawab_pilgan == kunci ) {
        var score  = poin;
        var status = "T";
    } else {
        var score  = 0;
        var status = "F"; 
    }
    $.ajax({
        url: "{{ url('store/pilgan_jawab') }}",
        type: "GET",
        dataType: 'json',
        data: {
            jawab_pilgan: jawab_pilgan, 
            pilgan_id: pilgan_id,
            peserta_id: peserta_id,
            user_id: user_id,
            score: score,
            status: status,
            ujian_id: ujian_id
        },
        success: function(data) {
					  console.log(data);
				}
    });
});

</script>