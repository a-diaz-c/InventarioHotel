<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Out_product extends Model
{
    protected $fillable = [
        'id_out_products',
        'fecha_out_products',
        'cantidad_out_products',
        'id_products',
    ];
}
