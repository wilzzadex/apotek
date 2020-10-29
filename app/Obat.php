<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $table = 'obat';
    protected $fillable = [
        'kode_obat',
        'no_bet',
        'nama_obat',
        'suplier_id',
        'harga_suplier',
        'harga_jual',
        'stok',
        'expired',
        'slug',
    ];

    public function suplier(){
        return $this->belongsTo(Suplier::class);
    }
}
