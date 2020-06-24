<?php

namespace App\Http\Controllers;
use App\Peserta;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $peserta = Peserta::where('user_id',auth()->user()->id)->get();
        //dd($peserta);
        return view('home',compact(['peserta']));
    }

    public function logout(){
      auth()->logout();
      return view('welcome');
    }
}
