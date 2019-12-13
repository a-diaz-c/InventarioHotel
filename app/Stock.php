<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'id',
        'mamximo',
        'minimo',
        'seguridad',
        'existencia',
    ];
}
