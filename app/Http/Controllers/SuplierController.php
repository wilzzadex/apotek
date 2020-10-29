<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Suplier;
use App\Obat;

class SuplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suplier = Suplier::all();
        return view('suplier.suplier',['suplier' => $suplier]);
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
        $suplier = Suplier::create($request->all());
        return redirect(url('suplier'))->with('FlashSukses','Data suplier berhasil di tambahkan ');
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
        $suplier = Suplier::findOrFail($id);
        return view('suplier.edit',['suplier' => $suplier]);
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
        $suplier = Suplier::findOrFail($id);
        $suplier->update($request->all());
        return redirect(url('suplier'))->with('FlashSukses','Data berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $cek_obat = Obat::where('suplier_id','=',$id)->count();
        if($cek_obat > 0){
            return redirect(url('suplier'))->with('Dangers','Data tidak bisa terhapus karena masih ada obat dengan Suplier tsb !');

        }else{
            $suplier = Suplier::findOrFail($id);
            $suplier->delete();
            return redirect(url('suplier'))->with('FlashSukses','Data berhasil di hapus');
        }
        
       
    }
}
