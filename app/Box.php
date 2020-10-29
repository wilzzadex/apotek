<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    protected $table = 'master_type';
    protected $fillable = [
        'nama',
        'jumlah'
    ];
}
