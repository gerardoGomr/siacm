<?php
namespace Siacme\Http\Requests;

use Siacme\Http\Requests\Request;

/**
 * Class RegistrarExpedienteRequest
 * @package Siacme\Http\Requests
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class RegistrarExpedienteRequest extends Request
{
    protected $rules = [
        'nombre'                      => '',
        'paterno'                     => '',
        'fechaNacimiento'             => 'date_format:Y-m-d',
        'edadAnios'                   => 'numeric',
        'edadMeses'                   => 'numeric',
        'lugarNacimiento'             => '',
        'direccion'                   => '',
        'cp'                          => '',
        'municipio'                   => '',
        'nombrePadre'                 => '',
        'ocupacionPadre'              => '',
        'nombreMadre'                 => '',
        'ocupacionMadre'              => '',
        'motivoConsulta'              => '',
        'viveMadre'                   => '',
        'enfermedadesMadre'           => '',
        'vivePadre'                   => '',
        'enfermedadesPadre'           => '',
        'enfermedadesAbuelosPaternos' => '',
        'enfermedadesAbuelosMaternos' => '',
        'numHermanos'                 => 'numeric',
        'numHermanosVivos'            => 'numeric',
        'numHermanosFinados'          => 'numeric',
        'nombresEdades'               => '',
        'enfermedadesHermanos'        => '',
        'tipoCepillo'                 => '',
        'marcaPasta'                  => '',
        'vecesCepilla'                => 'numeric',
        'edadErupcionaPrimerDiente'   => '',
        'vecesCome'                   => 'numeric'
    ];
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->rules;
    }
}
