<?php

namespace App\Http\Controllers;

use App\Produk;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $produk = Produk::all();
        return view('produk.makanan',['produk' => $produk,'produk2' => $produk]);
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
        $awalan = 'M-';
        $lebar = 2;
        $query = \DB::select('SELECT kode from produk ORDER BY kode desc limit 1');
        $jumlahrecord = \DB::table('produk')->count();
        if($jumlahrecord == 0)
        {
            $nomor = 1;
        }else{
            foreach($query as $row){
                $nomor = intval(substr($row->kode,strlen($awalan)))+1;
            }
        }
        if($lebar>0){
            $angka = $awalan.str_pad($nomor,$lebar,"0",STR_PAD_LEFT);
        }else{
            $angka = $awalan.$nomor;
        }


        $request->validate([
            'foto' => 'image|file|max:5000',
        ]);
        $produk = Produk::create($request->all());
        $produk->kode = $angka;
        $image = $request->file('foto');
        $slug = str_slug($request->nama);
        if(isset($image)){
            $currentdate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentdate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if(!file_exists('foto_produk'))
            {
                mkdir('foto_produk', 0777 , true);
            }
            $image->move('foto_produk',$imagename);
            $produk->foto = $imagename;
            $produk->save();
        }else{
            $imagename = 'dummy.png';
            $produk->foto = $imagename;
            $produk->save();
        }
        return redirect('/produk')->with('Sukses','Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
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
        $produk = Produk::find($id);
        $produk->update($request->all());
        $image = $request->file('foto');
        $slug = str_slug($request->nama);
        if(isset($image)){
            $currentdate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentdate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if(!file_exists('foto_produk'))
            {
                mkdir('foto_produk', 0777 , true);
            }
            $image->move('foto_produk',$imagename);
            $produk->foto = $imagename;
            $produk->save();
        }
        return redirect('/produk')->with('Sukses','Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);
        if(file_exists('foto_produk/'.$produk->foto)){
            unlink('foto_produk/'.$produk->foto);
        }
        $produk->delete();
        return redirect('/produk')->with('Sukses','Data Berhasil di Hapus');
    }
}
