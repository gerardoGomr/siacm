<?php

namespace Siacme\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CrearUsuarioRequest
 *
 * @package Siacme\Http\Requests
 * @author Gerardo Adrián Gómez Ruiz
 * @version
 */
class CrearUsuarioRequest extends FormRequest
{
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
        return [
            'clave'        => 'required',
            'passwd'       => 'required',
            'rol'          => 'required',
            'especialidad' => 'required',
            'nombre'       => 'required',
            'paterno'      => 'required',
            'telefono'     => 'numeric',
            'celular'      => 'numeric',
            'email'        => 'email'
        ];
    }
}
