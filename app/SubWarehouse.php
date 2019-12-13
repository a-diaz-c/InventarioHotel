<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubWarehouse extends Model
{
    protected $fillable = [
        'id',
        'nombre',
        'id_warehouse',
    ];
}
