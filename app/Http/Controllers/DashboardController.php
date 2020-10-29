<?php

namespace App\Http\Controllers;

use App\Produk;
use App\Orders;
use App\Detail_order;
use App\User;
use App\Obat;
use App\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $obat = Obat::orderBy('stok','asc')->take(5)->get();
        $jml_obat = \DB::table('obat')->count();
        $jml_transaksi = \DB::table('transaksi')->count();
        $income = Transaksi::where('created_at','like','%'.date('Y-m-d').'%')->sum('total_bayar');
        $incomethis = Transaksi::where('created_at','like','%'.date('Y-m').'%')->sum('total_bayar');
        return view('dashboard.index',[
            'obat' => $obat,
            'jml_obat' => $jml_obat,
            'jml_transaksi' => $jml_transaksi,
            'income' => $income,
            'incomethis' => $incomethis
        ]);
    }
}
