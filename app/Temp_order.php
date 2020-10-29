<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temp_order extends Model
{
    protected $table = 'temp_order';
    protected $fillable = [
        'no_invoice',
        'obat_id',
        'qty',
        'total_harga',
        'satuan_id',
        'jml_satuan'

    ];
}
