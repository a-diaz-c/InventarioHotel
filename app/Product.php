<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id',
        'descripcion',
        'foto',
        'maximo',
        'minimo',
        'existencia',
        'seguridad',
        'id_measure',
        'id_brand',
        'id_warehouse',

    ];
}
