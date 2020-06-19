<?php

namespace App\Http\Controllers;

use App\Profil;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profil.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\ProfilController  $profilController
     * @return \Illuminate\Http\Response
     */
    public function show(ProfilController $profilController)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProfilController  $profilController
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profil = Profil::find($id);
        return view('profil.edit', ['profil' => $profil]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProfilController  $profilController
     * @return \Illuminate\Http\Response
     */
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

        Customer::whereId($id)->update($update);
   
        return redirect('/profil')
       ->with('success','Great! Biodata berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProfilController  $profilController
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfilController $profilController)
    {
        //
    }
}
