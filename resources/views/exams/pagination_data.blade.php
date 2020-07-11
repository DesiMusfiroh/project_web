
<div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Soal Ujian</div>
          <div class="card-body " >
            <?php $i=0; ?>
            @foreach($soal_satuan as $item)
                <div class=" container row">
                    <div class="col-md-3"><h6>Soal No.  <?php  $i++;  echo $i; ?> </h6></div>
                    <div class="col-md-7 text-right"><h6>Poin : {{$item->poin}}</h6></div>
                </div>
                <div class="container">
                <table >
                @if($item->jenis == "Essay")
                    <b> Pertanyaan </b> :
                        {{$item->essay->pertanyaan}}
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
                </div>

                <hr>
            @endforeach


          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <div class="card-header">Navigasi</div>
          <div class="card-body">
            <div class="row ">
            
              <div class="col-12 text-center ">
               
                 {{ $soal_satuan->links() }}
               
            </div>
          </div>
        </div>
      </div>
    </div>

    <input type="hidden" value="{{ $ujian->id }}" id="ujian_id">