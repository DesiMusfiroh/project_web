<?php

namespace App\Http\Controllers;
use App\Peserta;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index()
    {
        $peserta = Peserta::where('user_id',auth()->user()->id)->get();
        return view('home',compact(['peserta']));
    }

    public function logout(){
        auth()->logout();
        return view('welcome');
    }
}
