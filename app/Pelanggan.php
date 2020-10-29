<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $fillable = [
        'nama_pelanggan',
        'alamat',
        'no_telp',
        'info_tambahan'
    ];
}
