<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obat_satuan extends Model
{
    protected $table = 'obat_satuan';
    protected $fillable = [
        'obat_id',
        'satuan_id'
    ];
}
