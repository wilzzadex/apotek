<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawai = User::all();
        return view('pegawai.pegawai',['pegawai' => $pegawai]);
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
        $pegawai = new User();
        $pegawai->name = $request->name;
        $pegawai->username = $request->username;
        $pegawai->password = bcrypt($request->password);
        $pegawai->foto = 'default.jpg';
        $pegawai->role = $request->role;
        $pegawai->remember_token = str_random(60);
        $pegawai->save();
        return redirect(url('pegawai'))->with('FlashSukses','Data Pegwai Berhasil di simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pegawai = User::findOrFail($id);
        return view('pegawai.edit',['pegawai'=> $pegawai]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pegawai = User::findOrFail($id);
        $pegawai->name = $request->name;
        $pegawai->username = $request->username;
        $pegawai->role = $request->role;
        $pegawai->save();
        return redirect(url('pegawai'))->with('FlashSukses','Data Pegawai Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $pegawai = User::findOrFail($id);
        $pegawai->delete();
        return redirect(url('pegawai'))->with('FlashSukses','Data Pegawai Berhasil di hapus');
    }
    public function reset($id)
    {
        $pegawai = User::findOrFail($id);
        $pegawai->password = bcrypt('pegawai2019');
        $pegawai->save();
        return redirect(url('pegawai'))->with('FlashSukses','Password Berhasil Di Reset!');
    }
}
