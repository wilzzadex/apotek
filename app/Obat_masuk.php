<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obat_masuk extends Model
{
    protected $table = 'obat_masuk';
    protected $fillable = [
        'id_faktur',
        'jml_item',
        'jml_satuan',
        'harga',
        'id_obat',
        'tanggal_masuk',
    ];
}
