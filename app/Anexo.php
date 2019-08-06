<?php

namespace Siacme;

use Illuminate\Database\Eloquent\Model;

class Anexo extends Model
{
    protected $table = 'anexo';
    const CREATED_AT = 'FechaCreacion';
    const UPDATED_AT = 'FechaUpdate';
    protected $fillable = [
        'UsuarioId',
        'ExpedienteId',
        'Nombre',
        'FechaDocumento',
        'CategoriaId'
    ];

    public function categoria()
    {
        return $this->belongsTo('Siacme\AnexoCategoria', 'CategoriaId');
    }
}
