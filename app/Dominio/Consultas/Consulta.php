<?php
namespace Siacme\Dominio\Consultas;

use DateTime;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Expedientes\ComportamientoFrankl;
use Siacme\Dominio\Usuarios\Usuario;

/**
 * Class Consulta
 * @package Siacme\Dominio\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class Consulta
{
    /**
     * @var int
     */
	private $id;

    /**
     * @var string
     */
    private $padecimientoActual;

    /**
     * @var string
     */
    private $interrogatorioAparatosSistemas;

    /**
     * @var ExploracionFisica
     */
    private $exploracionFisica;

    /**
     * @var string
     */
    private $notaMedica;

    /**
     * @var ComportamientoFrankl
     */
    private $comportamientoFrankl;

    /**
     * @var double
     */
    private $costo;

    /**
     * @var RecetaConsulta
     */
    private $receta;

    /**
     * @var Expediente
     */
    private $expediente;

    /**
     * @var ConsultaCosto
     */
    private $consultaCosto;

    /**
     * @var DateTime
     */
    private $fecha;

    /**
     * @var Usuario
     */
    private $medico;

    /**
     * Consulta constructor.
     * @param string $padecimientoActual
     * @param string $interrogatorioAparatosSistemas
     * @param ExploracionFisica $exploracionFisica
     * @param string $notaMedica
     * @param ComportamientoFrankl $comportamientoFrankl
     * @param double $costo
     * @param DateTime $fecha
     * @param Usuario $medico
     */
    public function __construct($padecimientoActual, $interrogatorioAparatosSistemas, ExploracionFisica $exploracionFisica, $notaMedica, ComportamientoFrankl $comportamientoFrankl, $costo, $fecha, $medico)
    {
        $this->padecimientoActual             = $padecimientoActual;
        $this->interrogatorioAparatosSistemas = $interrogatorioAparatosSistemas;
        $this->exploracionFisica              = $exploracionFisica;
        $this->notaMedica                     = $notaMedica;
        $this->comportamientoFrankl           = $comportamientoFrankl;
        $this->costo                          = $costo;
        $this->fecha                          = $fecha;
        $this->medico                         = $medico;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPadecimientoActual()
    {
        return $this->padecimientoActual;
    }

    /**
     * @return string
     */
    public function getInterrogatorioAparatosSistemas()
    {
        return $this->interrogatorioAparatosSistemas;
    }

    /**
     * @return ExploracionFisica
     */
    public function getExploracionFisica()
    {
        return $this->exploracionFisica;
    }

    /**
     * @return string
     */
    public function getNotaMedica()
    {
        return $this->notaMedica;
    }

    /**
     * @return ComportamientoFrankl
     */
    public function getComportamientoFrankl()
    {
        return $this->comportamientoFrankl;
    }

    /**
     * @return float
     */
    public function getCosto()
    {
        return $this->costo;
    }

    /**
     * dar consulta de cortesia
     */
    public function cortesia()
    {
        $this->costo = 0;
    }

    /**
     * @return RecetaConsulta
     */
    public function getReceta()
    {
        return $this->receta;
    }

    /**
     * indica si la consulta es nueva o ya existe
     * @return string
     */
    public function nuevaOSubsecuente() {
        if ($this->id === 0 || is_null($this->id)) {
            return 'Nueva';
        }

        return 'Existente';
    }

    /**
     * indica si tiene receta generada
     * @return bool
     */
    public function tieneReceta()
    {
        if (!is_null($this->receta)) {
            return true;
        }

        return false;
    }

    /**
     * @return Expediente
     */
    public function getExpediente()
    {
        return $this->expediente;
    }

    /**
     * @return ConsultaCosto
     */
    public function getConsultaCosto()
    {
        return $this->consultaCosto;
    }

    /**
     * @return string
     */
    public function getFecha()
    {
        return $this->fecha->format('Y-m-d');
    }

    /**
     * @return Usuario
     */
    public function getMedico()
    {
        return $this->medico;
    }

    /**
     * agregar una receta
     * @param RecetaConsulta $receta
     */
    public function agregarReceta(RecetaConsulta $receta)
    {
        $this->receta = $receta;
    }

    /**
     * generar la consulta para un expediente
     * @param Expediente $expediente
     */
    public function generadaPara(Expediente $expediente)
    {
        $this->expediente = $expediente;
    }
}