<?php

namespace App\Http\Controllers;
use App\Temp_order;
use App\Transaksi;
use App\detail_order;
use App\Obat;
use App\Obat_masuk;
use Illuminate\Http\Request;
use DB;
use PDF;
class TransaksiController extends Controller
{
    public function addTemp(Request $request)
    {

        // dd($request->all());
        
        $cek_stok = Obat::where('id',$request->obat_id)->get();
        foreach($cek_stok as $cs){
            if($cs->stok < $request->qty){
                return redirect(url('kasirpage'))->with('FlashError','Stok Obat Tidak mencukupi');
            }else{
                $harga = \DB::select("SELECT harga_jual from obat where id = '$request->obat_id' limit 1");
                foreach($harga as $harga){
                    $fixharga = $harga->harga_jual;
                }
                $total_harga = $fixharga * $request->qty;
                $temp = new Temp_order();
                $temp->no_invoice = $request->no_invoice;
                $temp->obat_id = $request->obat_id;
                $temp->qty = $request->qty;
                $temp->total_harga = $total_harga;
                $temp->satuan_id = $request->satuan_id;
                $temp->jml_satuan = $request->jml_satuan;
                $temp->save();
                return redirect(url('kasirpage'));
            }
        }
        // dd($request->all());
        
    }

    public function deleteTemp($id)
    {
        $temp = Temp_order::findOrFail($id);
        $temp->delete();
        return redirect(url('kasirpage'));
    }

    public function simpantrans(Request $request)
    {
        $cek_temp = \DB::table('temp_order')->count();
        if($cek_temp > 0){
            if($request->uang_bayar < $request->total_bayar){
                return redirect(url('kasirpage'))->with('FlashError','Pembayaran Kurang');
            }else{
                $temp = Temp_order::all();
                foreach($temp as $temp){
                    $updatestok = Obat::find($temp->obat_id);
                    $updatestok->stok = $updatestok->stok - $temp->qty;
                    $updatestok->save();
                    $detail = new detail_order();
                    $detail->no_invoice = $temp->no_invoice;
                    $detail->obat_id = $temp->obat_id;
                    $detail->qty = $temp->qty;
                    $detail->total_harga = $temp->total_harga;
                    $detail->satuan_id = $temp->satuan_id;
                    $detail->jml_satuan = $temp->jml_satuan;
                    $detail->tgl_transaksi = date('Y-m-d');
                    $detail->save();
                }
                // dd($request->all());
                $transaksi = new Transaksi();
                $transaksi->no_invoice = $request->no_invoice;
                $transaksi->pelanggan_id = $request->pelanggan_id;
                $transaksi->kasir_id = $request->kasir_id;
                $transaksi->jumlah_item = $request->jumlah_item;
                $transaksi->total_bayar = $request->total_bayar;
                $transaksi->uang_bayar = $request->uang_bayar;
                $transaksi->uang_kembali = $request->uang_kembali;
                $transaksi->catatan = $request->catatan;
                $transaksi->tgl_transaksi = date('Y-m-d');
                $transaksi->save();
                $deleteTemp = Temp_order::query()->truncate();
                return redirect(url('kasirpage'))->with('FlashSukses','Transaksi Selesai');
            }
        }else{
            return redirect(url('kasirpage'))->with('FlashError','Belum Ada Item');
        }

        
        
    }

    public function adminRiwayat()
    {
        $transaksi = DB::select("SELECT a.no_invoice,a.created_at, a.jumlah_item,a.total_bayar,a.uang_bayar,a.uang_kembali,a.catatan,b.nama_pelanggan,c.name FROM transaksi as a INNER JOIN pelanggan as b ON b.id = a.pelanggan_id INNER JOIN users as c ON c.id = a.kasir_id ORDER BY a.no_invoice DESC");
        return view('transaksi.transaksi',['transaksi' => $transaksi]);
    }
    public function laporanpdf(Request $request)
    {
        $dari = $request->dari;
        $hingga = $request->hingga;
        // dd($request->all());
        $transaksi = DB::select("SELECT a.no_invoice,a.created_at, a.jumlah_item,a.total_bayar,a.uang_bayar,a.uang_kembali,a.catatan,b.nama_pelanggan,c.name FROM transaksi as a INNER JOIN pelanggan as b ON b.id = a.pelanggan_id INNER JOIN users as c ON c.id = a.kasir_id where (a.tgl_transaksi BETWEEN '$dari' AND '$hingga') ORDER BY a.no_invoice DESC");
        $total_uang = DB::select("SELECT sum(total_bayar) as total from transaksi  where (tgl_transaksi BETWEEN '$dari' AND '$hingga')");
        $pdf = PDF::loadView('laporan.pdf_penjualan',['transaksi' => $transaksi,'total_uang' => $total_uang]);
        return $pdf->download('LaporanPenjualan-'.date('d M Y',strtotime($dari)).'-'.date('d M Y',strtotime($hingga)).'.pdf');
    }
    public function obatkeluar(){
        $detail_order = DB::select("SELECT detail_order.id,detail_order.no_invoice,detail_order.qty,detail_order.total_harga,detail_order.created_at,obat.id,obat.nama_obat,obat.harga_jual,obat.kode_obat from detail_order INNER JOIN obat ON obat.id = detail_order.obat_id ORDER by detail_order.no_invoice DESC");
        $transaksi = DB::select("SELECT a.no_invoice,a.created_at, a.jumlah_item,a.total_bayar,a.uang_bayar,a.uang_kembali,a.catatan,b.nama_pelanggan,c.name FROM transaksi as a INNER JOIN pelanggan as b ON b.id = a.pelanggan_id INNER JOIN users as c ON c.id = a.kasir_id ");
        return view('transaksi.obat_keluar',['detail_order' => $detail_order,'transaksi' => $transaksi]);
    }
    public function pdfobatkeluar(Request $request)
    {
        $dari = $request->dari;
        $hingga = $request->hingga;
        $total_uang = DB::select("SELECT sum(total_harga) as total from detail_order where (tgl_transaksi BETWEEN '$dari' AND '$hingga')");
        $detail_order = DB::select("SELECT detail_order.id,detail_order.no_invoice,detail_order.qty,detail_order.total_harga,detail_order.created_at,obat.id,obat.nama_obat,obat.harga_jual,obat.kode_obat from detail_order INNER JOIN obat ON obat.id = detail_order.obat_id where (detail_order.tgl_transaksi BETWEEN '$dari' AND '$hingga') ORDER by detail_order.no_invoice DESC");
        $total_pengeluaran = DB::table('detail_order')
        ->select(DB::raw('sum(obat.harga_suplier*detail_order.qty) as harga_suplier'))
        ->join('obat','obat.id','=','detail_order.obat_id')
        ->whereBetween('detail_order.created_at',[$dari,$hingga])
        ->first();
      
        $pdf = PDF::loadView('laporan.pdf_obatkeluar',['detail_order' => $detail_order,'total_uang' => $total_uang,'total_pengeluaran' => $total_pengeluaran]);
        return $pdf->download('LaporanObatKeluar-'.date('d M Y',strtotime($dari)).'-'.date('d M Y',strtotime($hingga)).'-'.time().'.pdf');
    }

    public function excel_penjualan(Request $request)
    {
        $dari = $request->dari;
        $hingga = $request->hingga;
       
        // dd($request->all());
        $transaksi = DB::select("SELECT a.no_invoice,a.created_at, a.jumlah_item,a.total_bayar,a.uang_bayar,a.uang_kembali,a.catatan,b.nama_pelanggan,c.name FROM transaksi as a INNER JOIN pelanggan as b ON b.id = a.pelanggan_id INNER JOIN users as c ON c.id = a.kasir_id WHERE (a.tgl_transaksi BETWEEN '$dari' AND '$hingga') ORDER BY a.no_invoice DESC");
        $total_uang = DB::select("SELECT sum(total_bayar) as total from transaksi WHERE  (tgl_transaksi BETWEEN '$dari' AND '$hingga')");
        return view('laporan.excel_penjualan',[
            'transaksi' => $transaksi,
            'total' => $total_uang,
            'dari' => $dari,
            'hingga' => $hingga,
            
        ]);
    }
    public function excel_obatkeluar(Request $request)
    {
        $dari = $request->dari;
        $hingga = $request->hingga;
        $total_pengeluaran = DB::table('detail_order')
                                ->select(DB::raw('sum(obat.harga_suplier*detail_order.qty) as harga_suplier'))
                                ->join('obat','obat.id','=','detail_order.obat_id')
                                ->whereBetween('detail_order.created_at',[$dari.'%',$hingga.'%'])
                                ->first();
        // dd($total_pengeluaran);
        $total_uang = DB::select("SELECT sum(total_harga) as total from detail_order WHERE (tgl_transaksi BETWEEN '$dari' AND '$hingga')");
        $detail_order = DB::select("SELECT detail_order.id,detail_order.no_invoice,detail_order.qty,detail_order.total_harga,detail_order.created_at,obat.id,obat.nama_obat,obat.harga_jual,obat.kode_obat from detail_order INNER JOIN obat ON obat.id = detail_order.obat_id where (detail_order.tgl_transaksi BETWEEN '$dari' AND '$hingga') ORDER by detail_order.no_invoice DESC");
        return view('laporan.excel_obatkeluar',[
            'transaksi' => $detail_order,
            'total' => $total_uang,
            'dari' => $dari,
            'hingga' => $hingga,
            'total_pengeluaran' => $total_pengeluaran
        ]);
    }

    public function pendapatan(Request $request)
    {
        
        $select = 'obat_masuk.id_faktur,obat_masuk.jml_satuan,obat_masuk.harga,obat_masuk.tanggal_masuk,suplier.nama_suplier,obat.nama_obat';
        $obat_keluar = Obat_masuk::selectRaw($select)
                                    ->join('suplier','suplier.id','=','obat_masuk.id_suplier')
                                    ->join('obat','obat.id','=','obat_masuk.id_obat')
                                    ->orderBy('tanggal_masuk','desc')
                                    ->get();
        $transaksi = DB::select("SELECT a.no_invoice,a.created_at, a.jumlah_item,a.total_bayar,a.uang_bayar,a.uang_kembali,a.catatan,b.nama_pelanggan,c.name FROM transaksi as a INNER JOIN pelanggan as b ON b.id = a.pelanggan_id INNER JOIN users as c ON c.id = a.kasir_id ORDER BY a.no_invoice DESC");

        if(isset($request->awal) && isset($request->akhir)){
            $obat_keluar = Obat_masuk::selectRaw($select)
                                    ->join('suplier','suplier.id','=','obat_masuk.id_suplier')
                                    ->join('obat','obat.id','=','obat_masuk.id_obat')
                                    ->whereBetween('tanggal_masuk',[$request->awal,$request->akhir])
                                    ->orderBy('tanggal_masuk','desc')
                                    ->get();
            $transaksi = DB::select("SELECT a.no_invoice,a.created_at, a.jumlah_item,a.total_bayar,a.uang_bayar,a.uang_kembali,a.catatan,b.nama_pelanggan,c.name FROM transaksi as a INNER JOIN pelanggan as b ON b.id = a.pelanggan_id INNER JOIN users as c ON c.id = a.kasir_id WHERE (a.tgl_transaksi BETWEEN '$request->awal' and '$request->akhir') ORDER BY a.no_invoice DESC");
            if($request->awal == $request->akhir){
                $obat_keluar = Obat_masuk::selectRaw($select)
                                    ->join('suplier','suplier.id','=','obat_masuk.id_suplier')
                                    ->join('obat','obat.id','=','obat_masuk.id_obat')
                                    ->where('tanggal_masuk',$request->awal)
                                    ->orderBy('tanggal_masuk','desc')
                                    ->get();
                $transaksi = DB::select("SELECT a.no_invoice,a.created_at, a.jumlah_item,a.total_bayar,a.uang_bayar,a.uang_kembali,a.catatan,b.nama_pelanggan,c.name FROM transaksi as a INNER JOIN pelanggan as b ON b.id = a.pelanggan_id INNER JOIN users as c ON c.id = a.kasir_id WHERE a.tgl_transaksi = '$request->awal' ORDER BY a.no_invoice DESC");
            }
        }

        $data['obat_masuk'] = $obat_keluar;
        $data['transaksi'] = $transaksi;
        return view('kasirpage.laporan.laporan_pendapatan',$data);
    }
}
