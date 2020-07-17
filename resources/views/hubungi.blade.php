<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"> -->
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Bowlby+One+SC&family=Bungee&family=Chelsea+Market&family=Lilita+One&family=Pangolin&family=Rambla&family=Tenali+Ramakrishna&display=swap');
            @media screen and (max-width: 1000px) {
                #vektor {
                    width: 350px;
                }
                #kiri {
                    width: 100%;
                }
                #kanan {
                    width: 100%;
                    margin: 0px 40px 20px 40px;
                }
            }
            @media screen and (min-width: 1000px) {
                #vektor {
                    width: 550px;
                }
            }

            @media screen and (max-width: 600px) {
                .hr-bawah{
                    width:60%;
                    align:auto;
                }
                .input-email{
                    width:100%;
                    }

                .input-pesan{
                    width:100%;
                }
                .wadah {
                    align-content:center;
                }


            }


            html, body {
                background: url('images/backbiru.png');
                color: #636b6f;
                font-family: Pangolin ;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            button {
                width: 120px;
                height: 45px;
                font-size: 20px;
                font-family: "Chelsea Market";
                padding: 5px;
                margin:10px;
                background: #35de9d;
                border-radius: 18px;
                border: none;
                box-shadow: 6px 6px 6px rgba(119, 52, 171, 0.46);
            }
            #keterangan{
                margin:60px 40px 10px 0px;
                padding:20px 0px 20px 0px;
            }
            #logo_keterangan{
                margin: 10px 0px 20px 0px;
            }


        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg "  style="background: #EDE5E5; box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.25);  font-family: Chelsea Market; font-size:20px; color:black;">
            <div class="container">
                <a class="navbar-brand" href="{{route('welcome')}}"><img src="/images/LiveEx.png" alt="" width="80px"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav ml-auto ">
                    <li class="nav-item active">
                            <a class="nav-link" href="/">Beranda </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/tim">Tim Kami</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="/hubungi">Hubungi Kami</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container justify-content-center wadah">
            <div class="container"style="margin:10px 0px 0px 0px" >
                <span class="row  justify-content-center " style="color: #244D49; padding:30px 0px 0px 0px; text-shadow: 3px 3px 0px #D7DACC;"><h3> Hubungi Kami </h3></span>
                    <hr class="hr-bawah "width="20%"/>
            </div>
            <div class="container">
      <div class="row">
        <div class="mx-auto p-4 col-md-7">
          <form>
            <div class="form-group"> <input type="email" class="form-control" id="" placeholder=" Email" > </div>
            <div class="form-group"> <textarea class="form-control" id="" rows="3" placeholder="Pesan"></textarea> </div>
             <button type="submit" class="btn btn-primary btn-block">Send</button>
          </form>
        </div>
      </div>
    </div>


        </div>








    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


    </body>
</html>
