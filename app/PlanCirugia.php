<?php

namespace Siacme;

use Illuminate\Database\Eloquent\Model;

class PlanCirugia extends Model
{
    protected $table = 'plan_cirugia';
    const CREATED_AT = 'FechaCreacion';
    const UPDATED_AT = 'FechaUpdate';
    protected $fillable = [
        'CirugiaId',
        'ExpedienteRigobertoId',
        'HonorariosMedicos',
        'EquipoAdicional',
        'HospitalSugerido',
        'DiasHospitalizacion',
        'MontoHospitalizacion'
    ];

    /**
     * Indica a que cirugía pertenece
     */
    public function cirugia()
    {
        return $this->belongsTo('Siacme\Cirugia', 'CirugiaId');
    }
}
