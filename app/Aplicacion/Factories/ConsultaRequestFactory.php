<?php
namespace Siacme\Aplicacion\Factories;

use Illuminate\Http\Request;
use Siacme\Dominio\Usuarios\Usuario;

/**
 * Class ConsultaRequestFactory
 * @package Siacme\Aplicacion\Factories
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class ConsultaRequestFactory
{
    /**
     * anexa validaciones adicionales al array $rules, que contiene la validación básica
     * y son anexadas las validaciones correspondientes al expediente
     * @param Request $request
     * @param $rules
     */
    public static function crear(Request $request, &$rules)
    {
        switch ((int)$request->get('medicoId')) {
            case Usuario::JOHANNA:
                $rules['morfologiaCraneofacial'] = 'required';
                $rules['morfologiaFacial']       = 'required';
                $rules['convexividadFacial']     = 'required';
                $rules['atm']                    = 'required';
                $rules['labios']                 = 'required';
                $rules['carrillos']              = 'required';
                $rules['frenillos']              = 'required';
                $rules['paladar']                = 'required';
                $rules['lengua']                 = 'required';
                $rules['pisoBoca']               = 'required';
                $rules['parodonto']              = 'required';
                $rules['uvula']                  = 'required';
                $rules['orofaringe']             = 'required';

        }
    }
}