<?php

namespace App\Http\Controllers;
use App\User;
use App\Obat;
use App\Pelanggan;
use App\Transaksi;
use App\Temp_order;
use Carbon\Carbon;
use App\Box;
use DB;
use PDF;
use Response;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index()
    {

        // $delete = \DB::table('temp_order')->where('user_id',auth()->user()->id)->delete();

        $awalan = 'INV-'.date('Y-m-d').'-';
        $lebar = 4;
        $query = \DB::select('SELECT no_invoice from transaksi ORDER BY no_invoice desc limit 1');
        $jumlahrecord = \DB::table('transaksi')->count();
        if($jumlahrecord == 0)
        {
            $nomor = 1;
        }else{
            foreach($query as $row){
                $nomor = intval(substr($row->no_invoice,strlen($awalan)))+1;
            }
        }
        if($lebar>0){
            $angka = $awalan.str_pad($nomor,$lebar,"0",STR_PAD_LEFT);
        }else{
            $angka = $awalan.$nomor;
        }
        // dd($angka);
        $temp = DB::select("SELECT temp_order.id,temp_order.jml_satuan,temp_order.satuan_id,temp_order.obat_id,obat.nama_obat,obat.kode_obat,obat.no_bet,obat.harga_jual,temp_order.qty,temp_order.total_harga from temp_order INNER JOIN obat ON obat.id = temp_order.obat_id");
        $pelanggan = Pelanggan::all();
        $obat = Obat::all();
        $box = Box::all();
        $grandTotal = DB::select("SELECT SUM(total_harga) as total,SUM(qty) as qty from temp_order");
        return view('kasirpage.transaksi.index',['box' => $box,'no_invoice' => $angka,'obat' => $obat,'temp' => $temp,'grandTotal' => $grandTotal,'pelanggan' => $pelanggan]);
    }
    public function profile()
    {
        return view('kasirpage.profile.index');
    }
    public function updateprofile(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->username = $request->username;

        $image = $request->file('foto');
        $slug = str_slug($request->name);
        if(isset($image)){
            $currentdate = Carbon::now()->toDateString();
            $imagename = $slug . $currentdate . uniqid() . '.' . $image->getClientOriginalExtension();
            if(!file_exists('images/image_profile'))
            {
                mkdir('images/image_profile', 0777 , true);
            }
            $image->move('images/image_profile',$imagename);
            $user->foto = $imagename;
        }
        if($request->password != null){
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect(url('kasir/profile'))->with('FlashSukses','Berhasil mengubah profile');
        
    }

    public function select2json()
    {
        $obat = Obat::all();
        return response()->json($obat);

    }
    public function riwayatP()
    {
        $id_kasir = auth()->user()->id;
        $transaksi = DB::select("SELECT a.no_invoice,a.created_at, a.jumlah_item,a.total_bayar,a.uang_bayar,a.uang_kembali,a.catatan,b.nama_pelanggan,c.name FROM transaksi as a INNER JOIN pelanggan as b ON b.id = a.pelanggan_id INNER JOIN users as c ON c.id = a.kasir_id WHERE a.kasir_id = '$id_kasir' ORDER BY a.no_invoice DESC");
        return view('kasirpage.transaksi.riwayat',['transaksi' => $transaksi]);
    }
    public function infoObat()
    {
        $obat = Obat::all();
        return view('kasirpage.transaksi.obat',['obat' => $obat]);
    }
    public function infoPelanggan()
    {
        $pelanggan = Pelanggan::all();
        return view('kasirpage.transaksi.pelanggan',['pelanggan' => $pelanggan]);
    }
    public function detailOrder($id)
    {
        $detail_order = DB::select("SELECT * from detail_order INNER JOIN obat ON obat.id = detail_order.obat_id WHERE detail_order.no_invoice = '$id'");
        $transaksi = DB::select("SELECT a.no_invoice,a.created_at, a.jumlah_item,a.total_bayar,a.uang_bayar,a.uang_kembali,a.catatan,b.nama_pelanggan,c.name FROM transaksi as a INNER JOIN pelanggan as b ON b.id = a.pelanggan_id INNER JOIN users as c ON c.id = a.kasir_id where a.no_invoice = '$id'");
        return view('kasirpage.transaksi.detail',['detail_order' => $detail_order,'no_invoice' => $id,'transaksi' => $transaksi]);
    }

    public function cetakStruk($id)
    {
        $detail_order = DB::select("SELECT * from detail_order INNER JOIN obat ON obat.id = detail_order.obat_id WHERE detail_order.no_invoice = '$id'");
        $transaksi = DB::select("SELECT a.no_invoice,a.created_at, a.jumlah_item,a.total_bayar,a.uang_bayar,a.uang_kembali,a.catatan,b.nama_pelanggan,c.name FROM transaksi as a INNER JOIN pelanggan as b ON b.id = a.pelanggan_id INNER JOIN users as c ON c.id = a.kasir_id where a.no_invoice = '$id'");
        return view('kasirpage.transaksi.struk',['detail_order' => $detail_order,'no_invoice' => $id,'transaksi' => $transaksi]);
    }
    public function laporanpdf()
    {
        $id_kasir = auth()->user()->id;
        $tanggal = date('Y-m-d');
        $transaksi = DB::select("SELECT a.no_invoice,a.created_at, a.jumlah_item,a.total_bayar,a.uang_bayar,a.uang_kembali,a.catatan,b.nama_pelanggan,c.name FROM transaksi as a INNER JOIN pelanggan as b ON b.id = a.pelanggan_id INNER JOIN users as c ON c.id = a.kasir_id where a.kasir_id = '$id_kasir' AND a.created_at LIKE '%$tanggal%' ");
        $total_uang = DB::select("SELECT sum(total_bayar) as total from transaksi where kasir_id = '$id_kasir' AND created_at LIKE '%$tanggal%'");
        $pdf = PDF::loadView('kasirpage.laporan.pdf_penjualan',['transaksi' => $transaksi,'total_uang' => $total_uang]);
        return $pdf->download('LaporanPenjualan-'.date('d-M-Y',strtotime(date('Y-m-d'))).'-(Kasir:'.auth()->user()->name.').pdf');
    }
    public function laporanexcel()
    {
        $id_kasir = auth()->user()->id;
        $tanggal = date('Y-m-d');
        $transaksi = DB::select("SELECT a.no_invoice,a.created_at, a.jumlah_item,a.total_bayar,a.uang_bayar,a.uang_kembali,a.catatan,b.nama_pelanggan,c.name FROM transaksi as a INNER JOIN pelanggan as b ON b.id = a.pelanggan_id INNER JOIN users as c ON c.id = a.kasir_id where a.kasir_id = '$id_kasir' AND a.created_at LIKE '%$tanggal%' ");
        $total_uang = DB::select("SELECT sum(total_bayar) as total from transaksi where kasir_id = '$id_kasir' AND created_at LIKE '%$tanggal%'");
        return view('kasirpage.laporan.excel_penjualan',[
            'transaksi' => $transaksi,
            'total' => $total_uang,
        ]);
    }

    public function indexUbahHarga($id)
    {
        $query = DB::table('temp_order')
                ->select('temp_order.id','obat.harga_jual')
                ->join('obat','obat.id','=','temp_order.obat_id')
                ->where('temp_order.id',$id)->first();
        return view('kasirpage.transaksi._ubahharga',['row' => $query]);
    }

    public function ubahHarga(Request $request,$id)
    {
        // dd($request->all());
        $temp = Temp_order::find($id);
        $temp->total_harga = $request->harga_baru * $temp->qty;
        $temp->save();
        return redirect()->back()->with('FlashSukses','Berhasil mengubah harga');
    }
}
