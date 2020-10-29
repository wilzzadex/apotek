<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = [
        'no_invoice',
        'pelanggan_id',
        'kasir_id',
        'jumlah_item',
        'total_bayar',
        'uang_bayar',
        'uang_kembali',
        'catatan',
        'tgl_transaksi'
    ];
}
