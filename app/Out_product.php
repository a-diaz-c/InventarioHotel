<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Out_product extends Model
{
    protected $fillable = [
        'id',
        'fecha',
        'cantidad',
        'id_producto',
    ];
}
