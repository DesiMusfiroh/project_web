<!DOCTYPE html>
<html lang="en" dir="ltr">
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
    <div class="row justify-content-center">
        <div class="col-md-6 text-center" id="kiri">
            <img src="/images/feattest 1.png" alt="" id="vektor">
        </div>
        <div class="col-md-6" id="kanan">
            <div class="row" id="keterangan" >
                <h1>Error</h1>
                <br/>

            </div>
            <div class="row text-center" id="aksi">
              <h4>{{$error}}</h4>
            </div>

        </div>
    </div>
  </body>
</html>
