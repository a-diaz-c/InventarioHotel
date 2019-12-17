<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubWarehouse extends Model
{
    protected $fillable = [
        'id_sub_warehouses',
        'nombre_sub_warehouses',
        'id_warehouses',
    ];
}
