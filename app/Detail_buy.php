<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_buy extends Model
{
    protected $fillable = [
        'id',
        'id_product',
        'precio',
        'cantidad',
    ];
}
