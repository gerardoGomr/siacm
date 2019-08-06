<?php

namespace Siacme;

use Illuminate\Database\Eloquent\Model;

class Cirugia extends Model
{
    protected $table = 'cirugia';
    
    protected $fillable = [
        'Nombre',
        'Activo',
        'Costo'
    ];
}
