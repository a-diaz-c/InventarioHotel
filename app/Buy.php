<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{
    protected $fillable = [
        'id',
        'descripcion',
        'fecha',
    ];    
}
