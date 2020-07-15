<div class="row"> 
            <div class="card pl-7 pt-7 pt-3" style="border-radius:0px; height:120px; width:100%; background: linear-gradient(180deg, rgba(247, 253, 251, 0.85) 0%, rgba(39, 182, 130, 0.85) 100%);" >
            {!!$ujian_room ?? '
                <div class="text-center"> <h4 style=""> <strong>Judul ujian</strong></h4> </div>
                   
            ' !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="row justify-content-center">
                    <div class="card mt-4 ml-10 mr-10" style="border-radius:0px; background:black; box-shadow:0px 0px 0px black;">
                        <video autoplay="true" id="video-webcam" width="600px" height="440px"> </video>
                    </div>
                </div>
                <div class="row">
                   {!!$ujian_room ?? '
                   
                   
                   ' !!}

                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="border-radius:0px; height:650px; background: linear-gradient(180deg, rgba(17, 0, 23, 0.96) -83.9%, rgba(44, 5, 60, 0.96) -2.49%, #5E2575 54.53%, #BEA2CF 111.53%);">
                    
                </div>
            </div>
        </div>