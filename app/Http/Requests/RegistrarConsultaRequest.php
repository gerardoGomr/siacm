<?php
namespace Siacme\Http\Requests;

use Siacme\Aplicacion\Factories\ConsultaRequestFactory;
use Siacme\Http\Requests\Request;

/**
 * Class RegistrarConsultaRequest
 * @package Siacme\Http\Requests
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class RegistrarConsultaRequest extends Request
{
    /**
     * @var array
     */
    protected $rules = [
        'peso'                  => 'numeric',
        'talla'                 => 'numeric',
        'temperatura'           => 'numeric',
        'padecimiento'          => 'required',
        'interrogatorio'        => 'required',
        'nota'                  => 'required',
        'costoAsignadoConsulta' => 'required'
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
     * agregar las validaciones adicionales dependiendo el médico
     * son las validaciones correspondientes al expediente
     */
    public function agregarValidacion()
    {
        ConsultaRequestFactory::crear($this, $this->rules);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->get('primeraVez') === '1') {
            $this->agregarValidacion();
        }

        return $this->rules;
    }
}
