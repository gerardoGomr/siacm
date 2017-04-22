<?php

namespace Siacme\Http\Controllers\Pagos;

use DateTime;
use Illuminate\Http\Request;
use Siacme\Dominio\Consultas\Repositorios\ConsultasRepositorio;
use Siacme\Dominio\Usuarios\Repositorios\UsuariosRepositorio;
use Siacme\Http\Controllers\Controller;

/**
 * Class ConsultasPagosController
 *
 * @package Siacme\Http\Controllers\Pagos
 * @category Controller
 * @author Gerardo Adrián Gómez Ruiz <gerardo.gomr@gmail.com>
 */
class ConsultasPagosController extends Controller
{
    /**
     * @var UsuariosRepositorio
     */
    protected $usuariosRepositorio;

    /**
     * @var ConsultasRepositorio
     */
    protected $consultasRepositorio;

    /**
     * ConsultasController constructor.
     *
     * @param UsuariosRepositorio $usuariosRepositorio
     * @param ConsultasRepositorio $consultasRepositorio
     */
    public function __construct(UsuariosRepositorio $usuariosRepositorio, ConsultasRepositorio $consultasRepositorio)
    {
        $this->usuariosRepositorio  = $usuariosRepositorio;
        $this->consultasRepositorio = $consultasRepositorio;
    }

    /**
     * mostrar las consultas pendientes de pago del día
     *
     * @param string $medicoId el id del médico
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($medicoId = null)
    {
        $this->validarQueryString($medicoId);

        $medicoId = (int)base64_decode($medicoId);
        if(is_null($medico = $this->usuariosRepositorio->obtenerPorId($medicoId))) {
            return view('error');
        }

        $fecha     = new DateTime();
        $consultas = $this->consultasRepositorio->obtenerConsultasNoPagadasDelDia($fecha);

        return view('consultas.consultas_pagos', compact('medico', 'consultas', 'fecha'));
    }

    /**
     * buscar consultas en base al día
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function buscarNoPagadas(Request $request)
    {
        $respuesta = ['estatus' => 'OK'];
        $fecha     = DateTime::createFromFormat('Y-m-d', $request->get('fecha'));
        $consultas = $this->consultasRepositorio->obtenerConsultasNoPagadasDelDia($fecha);

        $respuesta['html'] = view('consultas.consultas_pagos_lista', compact('consultas', 'fecha'))->render();

        return response()->json($respuesta);
    }
}
