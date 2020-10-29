<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detail_order extends Model
{
    protected $table = 'detail_order';
    protected $fillable = [
        'no_invoice',
        'obat_id',
        'qty',
        'total_harga',
        'satuan_id',
        'jml_satuan',
        'tgl_transaksi',
    ];
}
