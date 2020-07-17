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
                <button class="navbar-toggler btn-secondary" type="button"  style="width:50px" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav ml-auto ">
                    <li class="nav-item active">
                            <a class="nav-link" href="/">Beranda </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/tim">Tim Kami</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="/hubungi">Hubungi Kami</a>
                        </li> -->
                    </ul>
                </div>
            </div>
        </nav>

        <div class="row justify-content-center">
            <div class="col-md-6 text-center" id="kiri">
                <img src="/images/feattest 1.png" alt="" id="vektor">
            </div>
            <div class="col-md-6" id="kanan">
                <div class="row" id="keterangan" >
                    <img src="/images/LiveEx.png" alt="" width="170px" id="logo_keterangan">

                    <h4>Apa Itu LiveEx ? <br> LiveEx adalah website yang dibangun dengan tujuan untuk mempermudah pelaksanaan ujian secara daring dengan fitur live video demi meningkatkan pengawasan dan meminimalisir kecurangan saat ujian berlangsung </h4>
                </div>
                <div class="row text-center" id="aksi">
                @if (Route::has('login'))
                    <div class="container">
                        @auth

                            <a href="{{ route('home') }} "> <button> Home </button> </a>
                        @else
                            <a href="{{ route('login') }}"><button> Login </button> </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"><button> Register </button> </a>
                            @endif
                        @endauth
                    </div>
                @endif

                </div>

            </div>
        </div>

        <!-- <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth

                        <a href="{{ url('/home') }}"> <button> Home </button> </a>
                    @else
                        <a href="{{ route('login') }}"><button> Login </button> </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"><button> Register </button> </a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">

                </div>
            </div>
        </div> -->


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


    </body>
</html>
