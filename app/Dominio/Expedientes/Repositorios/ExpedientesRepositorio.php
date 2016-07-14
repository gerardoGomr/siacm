<?php
namespace Siacme\Dominio\Expedientes\Repositorios;

use Siacme\Dominio\Pacientes\Paciente;
use Siacme\Dominio\Repositorios\Repositorio;
use Siacme\Dominio\Usuarios\Usuario;

/**
 * Interface ExpedientesRepositorio
 * @package Siacme\Dominio\Expedientes\Repositorios
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
interface ExpedientesRepositorio extends Repositorio
{
    /**
     * obtener un expediente por el paciente al que le pertenece y al médico que atiende
     * @param Paciente $paciente
     * @param Usuario $medico
     * @return Expediente|null
     */
    public function obtenerPorPacienteMedico(Paciente $paciente, Usuario $medico);
}