<!doctype html>
<html lang="en">
  <head>
  	<title>LiveEx</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" href="{{asset('css/style.css')}}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

    <style>
        .nav-icon{
            width:30px;
            color: #82e8b5;
            font-size: 20px;
        }
    </style>
  </head>

    <?php  use App\Profil;
        $profil = Profil::where('user_id', Auth::user()->id )->first();
    ?>
    <body>
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar" >
				<div class="p-4 pt-5">
		  		<a href="#">
                    @if ($profil !== null)
                        <img src="/images/{{$profil->foto}}"  style="width: 150px; height: 150px; border-radius: 50%; display: block; margin: auto; ">
                        <center> <strong>{{auth()->user()->name}}</strong> </center>
                        </a>
                    @else
                        <img src="/images/logo.png"  style="width: 150px; height: 150px; border-radius: 50%; display: block; margin: auto; ">
                    @endif

                <ul class="list-unstyled components mb-5 ">
                    <li class="nav-item ">
                        <a href="{{ route('home') }}"><strong style="font-size:16px"> <i class="nav-icon fa fa-home"></i>  Dashboard</strong> </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{(request()->is('profil')) ? 'active' : ''}} " href="/profil"><strong style="font-size:16px"> <i class="nav-icon fa fa-user"></i>  Profil</strong></a>
                    </li>
                    <li class="nav-item ">
                    <a type="button"  data-toggle="modal" data-target="#exampleModal" ><strong style="font-size:16px"> <i class="nav-icon fa fa-plus"></i> Join Exam</strong></a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{route('question')}}"><strong style="font-size:16px"> <i class="nav-icon fa fa-comment"></i>  Question</strong></a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{route('getExam')}}"><strong style="font-size:16px"> <i class="nav-icon fa fa-thumb-tack"></i> Create Exam</strong></a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{route('resultExam')}}"><strong style="font-size:16px"> <i class="nav-icon fa fa-graduation-cap"></i> Result Exam</strong></a>
                    </li>

                    <!-- <li class="nav-item ">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Question</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a class="nav-link {{(request()->is('question/create')) ? 'active' : ''}} " href="/question/create">Buat Soal Baru</a>
                        </li>
                        <li>
                            <a class="nav-link {{(request()->is('question/history')) ? 'active' : ''}} " href="/question/history">Riwayat Soal</a>
                        </li>
                        </ul>
                    </li> -->

                    <!-- <li class="nav-item ">
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Exam</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="#">Make Exam</a>
                            </li>
                            <li>
                                <a href="#">History</a>
                            </li>
                        </ul>
                    </li> -->


                </ul>

	        <div class="footer">
	        	<p> Copyright &copy;<script>document.write(new Date().getFullYear());</script></p>
	        </div>

	      </div>
    	</nav>

        <!-- Page Content  -->

    <div id="content" class="p-4 p-md-5">

        <nav class="navbar navbar-expand-lg navbar-light " style="background-color: #daf5e4; box-shadow: 3px 3px 10px #b5aeb8">
          <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle mb-0 mt-0 pt-0 pb-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <strong style="font-size:15px">{{ Auth::user()->name }}  <i class="fa fa-user mr-3 ml-1" style="font-size:24px"></i> <span class="caret"></span> </strong>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
            </div>
          </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>



    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/20.0.0/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

    @yield('ckeditor')

    <div  class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="border-radius:2px;  box-shadow: 3px 3px 5px grey;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Join Exam</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                     {{ session('status') }}
                </div>
            @endif
        <form method="POST" action="{{ route('joinExam') }}">
            @csrf
                <div class="form-row align-items-center">
                    <div class="col-auto  offset-md-1">
                         <input style="border-radius:10px; border-color:#c4cdcf; box-shadow: 3px 3px 5px grey;"id="kode_akses" type="kode_akses" class="form-control @error('kode_akses') is-invalid @enderror" name="kode_akses" required placeholder="Masukkan Kode Akses">
                    </div>
                    <div class="col-auto ">
                        <button type="submit" style="border-radius:10px; border-color:#c4cdcf; font-family: Chelsea Market; font-size:18px; box-shadow: 3px 3px 5px grey;">
                            <strong> {{ __('Join') }}</strong>
                        </button>
                    </div>
                </div>
        </form>
     </div>
      <div class="modal-footer col-auto">
       Nb : Kode akses hanya diperoleh dari guru/dosen!
    </div>
  </div>
</div>
  </body>
</html>
