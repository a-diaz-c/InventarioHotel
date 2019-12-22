<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id',
        'descripcion_products',
        'foto_products',
        'maximo_products',
        'minimo_products',
        'existencia_products',
        'seguridad_products',
        'id_measures',
        'id_brands',
        'id_warehouses',

    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
