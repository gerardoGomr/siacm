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
        'fechaNacimiento'             => 'date_format:d/m/Y',
        'edadAnios'                   => 'required|number',
        'edadMeses'                   => 'required|number',
        'lugarNacimiento'             => 'required',
        'direccion'                   => 'required',
        'cp'                          => 'required',
        'municipio'                   => 'required',
        'automedicado'                => 'required',
        'alergico'                    => 'required',
        'nombrePadre'                 => 'required',
        'ocupacionPadre'              => 'required',
        'nombreMadre'                 => 'required',
        'ocupacionMadre'              => 'required',
        'motivoConsulta'              => 'required',
        'historiaEnfermedad'          => 'required',
        'viveMadre'                   => 'required',
        'enfermedadesMadre'           => 'required',
        'vivePadre'                   => 'required',
        'enfermedadesPadre'           => 'required',
        'enfermedadesAbuelosPaternos' => 'required',
        'enfermedadesAbuelosMaternos' => 'required',
        'numHermanos'                 => 'required|number',
        'numHermanosVivos'            => 'required|number',
        'numHermanosFinados'          => 'required|number',
        'nombresEdades'               => 'required',
        'enfermedadesHermanos'        => 'required',
        'tipoCepillo'                 => 'required',
        'marcaPasta'                  => 'required',
        'vecesCepilla'                => 'required|number',
        'edadErupcionaPrimerDiente'   => 'required',
        'vecesCome'                   => 'required|number'
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
