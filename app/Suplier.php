<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
    protected $table = 'suplier';
    protected $fillable = [
        'nama_suplier',
        'penanggung_jawab',
        'no_telp',
        'keterangan'
    ];
    public function suplier(){
        return $this->hasMany(Obat::class);
    }
}
