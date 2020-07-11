<?php

namespace App\Http\Controllers;

use App\Profil;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
        return view('profil.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'user_id' => 'required',
            'no_hp' => 'required',
            'institusi' => 'required',
            'alamat' => 'required',
            'foto' => 'required|file|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $file = $request->file('foto');
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'images';
        $file->move($tujuan_upload,$nama_file);

        Profil::create([
            'user_id' => $request->user_id,
            'no_hp' => $request->no_hp,
            'institusi' => $request->institusi,
            'alamat' => $request->alamat,
            'foto' => $nama_file,
        ]);

        return redirect()->back()
        ->with('success','Great! Biodata berhasil di simpan');
    }

    public function show(ProfilController $profilController)
    {
        //
    }

    public function edit($id)
    {
        $profil = Profil::find($id);
        return view('profil.edit', ['profil' => $profil]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'user_id' => 'required',
            'no_hp' => 'required',
            'institusi' => 'required',
            'alamat' => 'required',
            'foto' => 'required|file|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $file = $request->file('foto');
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'images';
        $file->move($tujuan_upload,$nama_file);

        $update = [
            'user_id' => $request->user_id,
            'no_hp' => $request->no_hp,
            'institusi' => $request->institusi,
            'alamat' => $request->alamat,
            'foto' => $nama_file,
        ];

        Profil::whereId($id)->update($update);

        return redirect('/profil')
       ->with('success','Great! Biodata berhasil di update');
    }

    public function destroy(ProfilController $profilController)
    {
        //
    }
}
