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
        'nombre'                      => 'required',
        'paterno'                     => 'required',
        'fechaNacimiento'             => 'date_format:Y-m-d',
        'edadAnios'                   => 'required|numeric',
        'edadMeses'                   => 'required|numeric',
        'lugarNacimiento'             => 'required',
        'direccion'                   => 'required',
        'cp'                          => 'required',
        'municipio'                   => 'required',
        'nombrePadre'                 => 'required',
        'ocupacionPadre'              => 'required',
        'nombreMadre'                 => 'required',
        'ocupacionMadre'              => 'required',
        'motivoConsulta'              => 'required',
        'viveMadre'                   => 'required',
        'enfermedadesMadre'           => 'required',
        'vivePadre'                   => 'required',
        'enfermedadesPadre'           => 'required',
        'enfermedadesAbuelosPaternos' => 'required',
        'enfermedadesAbuelosMaternos' => 'required',
        'numHermanos'                 => 'required|numeric',
        'numHermanosVivos'            => 'required|numeric',
        'numHermanosFinados'          => 'required|numeric',
        'nombresEdades'               => 'required',
        'enfermedadesHermanos'        => 'required',
        'tipoCepillo'                 => 'required',
        'marcaPasta'                  => 'required',
        'vecesCepilla'                => 'required|numeric',
        'edadErupcionaPrimerDiente'   => 'required',
        'vecesCome'                   => 'required|numeric'
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
