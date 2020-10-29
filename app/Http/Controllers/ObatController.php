<?php

namespace App\Http\Controllers;

use App\Box;
use App\Obat;
use App\Suplier;
use App\Obat_masuk;
use App\Obat_satuan;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obat = Obat::orderBy('created_at','DESC')->get();
        $suplier = Suplier::all();
        $box = Box::orderBy('id','ASC')->get();

        $data['obat'] = $obat;
        $data['suplier'] = $suplier;
        $data['box'] = $box;
        return view('obat.obat',$data);
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
        // dd($request->all());


        $hapus = ['Rp.','.'];
        $input_harga = $request->harga_keseluruhan;
        $input_harga_suplier = $request->harga_suplier;
        $harga_keseluruhan = str_replace($hapus,"",$input_harga);
        $harga_suplier = str_replace($hapus,"",$input_harga_suplier);
        
        $cek_obat_ext = Obat::where('slug',str_slug($request->nama_obat))->count();

        // if($cek_obat_ext == 0){
            $obat = new Obat();
            $obat->kode_obat = $request->kode_obat;
            $obat->no_bet = $request->no_bet;
            $obat->nama_obat = ucfirst($request->nama_obat);
            $obat->slug = str_slug($request->nama_obat);
            $obat->suplier_id = $request->suplier_id;
            $obat->harga_suplier = $harga_suplier;
            $obat->harga_jual = $request->harga_jual;
            $obat->stok = $request->stok;
            $obat->expired = $request->expired;
            $obat->save();

            $faktur = new Obat_masuk();
            $faktur->id_suplier = $obat->suplier_id;
            $faktur->id_faktur = $request->no_faktur;
            $faktur->jml_item = $request->stok;
            
            $satuan = Box::where('id',$request->satuan)->first();
            $faktur->jml_satuan = $request->jml_satuan . " " . $satuan->nama;
            $faktur->id_obat = $obat->id;
            $faktur->tanggal_masuk = date('Y-m-d');
            $faktur->harga = $harga_keseluruhan;
            $faktur->save();


            $obat_satuan = new Obat_satuan();
            $obat_satuan->obat_id = $obat->id;
            $obat_satuan->satuan_id = $request->satuan;
            $obat_satuan->jml_satuan = $request->jml_satuan;
            $obat_satuan->save();
        // }else{
        //     $cek = Obat::where('slug',str_slug($request->nama_obat))->first();
        //     dd($cek);
        //     $obat = Obat::find($cek->id);
        //     $obat->kode_obat = $request->kode_obat;
        //     $obat->no_bet = $request->no_bet;
        //     $obat->nama_obat = $request->nama_obat;
        //     $obat->slug = str_slug($request->nama_obat);
        //     $obat->suplier_id = $request->suplier_id;
        //     $obat->harga_suplier = $harga_suplier;
        //     $obat->harga_jual = $request->harga_jual;
        //     $obat->stok = $request->stok;
        //     $obat->expired = $request->expired;
        //     $obat->save();
        // }


        

        return redirect(url('obat'))->with('FlashSukses','Data Obat Berhasil Di tambahkan');
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
        $obat = Obat::findOrFail($id);
        $suplier = Suplier::all();
        $satuan = Box::all();
        return view('obat.edit',['obat' => $obat,'suplier' => $suplier ,'satuan' => $satuan]);
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
        // dd($request->all());
        $obat = Obat::findOrFail($id);
        $obat->kode_obat = $request->kode_obat;
        $obat->no_bet = $request->no_bet;
        $obat->nama_obat = $request->nama_obat;
        $obat->suplier_id = $request->suplier_id;
        $obat->harga_suplier = $request->harga_suplier;
        $obat->harga_jual = $request->harga_jual;
        $obat->stok = $request->stok;
        $obat->expired = $request->expired;
        $obat->save();

        $obat_satuan = Obat_satuan::where('obat_id',$obat->id)->first();
        $obat_satuan->satuan_id = $request->satuan;
        $obat_satuan->jml_satuan = $request->jml_satuan;
        $obat_satuan->save();
        return redirect(url('obat'))->with('FlashSukses','Data Obat Berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $obat = Obat::findOrFail($id);
        $satuan = Obat_satuan::where('obat_id',$obat->id)->delete();
        $obat->delete();
        return redirect(url('obat'))->with('FlashSukses','Data Obat Berhasil di hapus');
    }

    public function obatMasuk(Request $request)
    {
        $select = 'obat_masuk.id_faktur,obat_masuk.jml_satuan,obat_masuk.harga,obat_masuk.tanggal_masuk,suplier.nama_suplier,obat.nama_obat';
        $obat_keluar = Obat_masuk::selectRaw($select)
                                    ->join('suplier','suplier.id','=','obat_masuk.id_suplier')
                                    ->join('obat','obat.id','=','obat_masuk.id_obat')
                                    ->orderBy('tanggal_masuk','desc')
                                    ->get();
        if(isset($request->awal) && isset($request->akhir)){
            $obat_keluar = Obat_masuk::selectRaw($select)
                                    ->join('suplier','suplier.id','=','obat_masuk.id_suplier')
                                    ->join('obat','obat.id','=','obat_masuk.id_obat')
                                    ->whereBetween('tanggal_masuk',[$request->awal,$request->akhir])
                                    ->orderBy('tanggal_masuk','desc')
                                    ->get();
            if($request->awal == $request->akhir){
                $obat_keluar = Obat_masuk::selectRaw($select)
                                    ->join('suplier','suplier.id','=','obat_masuk.id_suplier')
                                    ->join('obat','obat.id','=','obat_masuk.id_obat')
                                    ->where('tanggal_masuk',$request->awal)
                                    ->orderBy('tanggal_masuk','desc')
                                    ->get();
            }
        }
        // dd($obat_keluar);
        $data['obat_masuk'] = $obat_keluar;
        return view('obat.obat_masuk',$data);
    }

    public function satuan()
    {

        $satuan = Box::orderBy('created_at','DESC')->get();
        $data['satuan'] = $satuan;
        return view('kasirpage.satuan.satuan',$data);
    }

    public function satuanStore(Request $request)
    {
        // dd($request->all());
        $create = Box::create($request->all());
        return redirect(route('satuan'))->with('FlashSukses','Data Berhasil di tambah');
    }

    public function satuanEdit(Request $request)
    {
        $data['satuan'] = Box::find($request->id);
        return view('kasirpage.satuan.modal_edit',$data);
    }

    public function satuanDestroy($id)
    {
        $cek = Obat_Satuan::where('satuan_id',$id)->count();
        // dd($cek);
        if($cek > 0){
            return redirect(route('satuan'))->with('Dangers','Data tidak bisa dihapus !');
        }else{
            $box = Box::find($id)->delete();
            return redirect(route('satuan'))->with('FlashSukses','Data Berhasil di hapus');

        }
    }
}
