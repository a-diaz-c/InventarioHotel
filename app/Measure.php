<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Measure extends Model
{
    protected $fillable = [
        'id_measures',
        'descripcion_measures',
    ];
}
