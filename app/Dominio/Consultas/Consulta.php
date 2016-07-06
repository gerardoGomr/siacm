<?php
namespace Siacme\Dominio\Consultas;

use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Pacientes\ComportamientoFrankl;

/**
 * Class Consulta
 * @package Siacme\Dominio\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
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
     * @var Receta
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
     * @var string
     */
    private $fecha;

    /**
     * Consulta constructor.
     * @param int $id
     * @param string $padecimientoActual
     * @param string $interrogatorioAparatosSistemas
     * @param ExploracionFisica $exploracionFisica
     * @param string $notaMedica
     * @param ComportamientoFrankl $comportamientoFrankl
     * @param double $costo
     */
    public function __construct($id = 0, $padecimientoActual, $interrogatorioAparatosSistemas, ExploracionFisica $exploracionFisica, $notaMedica, ComportamientoFrankl $comportamientoFrankl, $costo, $fecha = '')
    {
        $this->id                             = $id;
        $this->padecimientoActual             = $padecimientoActual;
        $this->interrogatorioAparatosSistemas = $interrogatorioAparatosSistemas;
        $this->exploracionFisica              = $exploracionFisica;
        $this->notaMedica                     = $notaMedica;
        $this->comportamientoFrankl           = $comportamientoFrankl;
        $this->costo                          = $costo;
        $this->fecha                          = $fecha;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getPadecimientoActual()
    {
        return $this->padecimientoActual;
    }

    /**
     * @param string $padecimientoActual
     */
    public function setPadecimientoActual($padecimientoActual)
    {
        $this->padecimientoActual = $padecimientoActual;
    }

    /**
     * @return string
     */
    public function getInterrogatorioAparatosSistemas()
    {
        return $this->interrogatorioAparatosSistemas;
    }

    /**
     * @param string $interrogatorioAparatosSistemas
     */
    public function setInterrogatorioAparatosSistemas($interrogatorioAparatosSistemas)
    {
        $this->interrogatorioAparatosSistemas = $interrogatorioAparatosSistemas;
    }

    /**
     * @return ExploracionFisica
     */
    public function getExploracionFisica()
    {
        return $this->exploracionFisica;
    }

    /**
     * @param ExploracionFisica $exploracionFisica
     */
    public function setExploracionFisica(ExploracionFisica $exploracionFisica)
    {
        $this->exploracionFisica = $exploracionFisica;
    }

    /**
     * @return string
     */
    public function getNotaMedica()
    {
        return $this->notaMedica;
    }

    /**
     * @param string $notaMedica
     */
    public function setNotaMedica($notaMedica)
    {
        $this->notaMedica = $notaMedica;
    }

    /**
     * @return ComportamientoFrankl
     */
    public function getComportamientoFrankl()
    {
        return $this->comportamientoFrankl;
    }

    /**
     * @param ComportamientoFrankl $comportamientoFrankl
     */
    public function setComportamientoFrankl(ComportamientoFrankl $comportamientoFrankl)
    {
        $this->comportamientoFrankl = $comportamientoFrankl;
    }

    /**
     * @return float
     */
    public function getCosto()
    {
        return $this->costo;
    }

    /**
     * @param float $costo
     */
    public function setCosto($costo)
    {
        if ($costo < 0) {
            throw new \InvalidArgumentException('Por favor, especifique un costo mayor o igual a $0.00');
        }

        $this->costo = $costo;
    }

    /**
     * dar consulta de cortesia
     */
    public function cortesia()
    {
        $this->costo = 0;
    }

    /**
     * @return Receta
     */
    public function getReceta()
    {
        return $this->receta;
    }

    /**
     * @param Receta $receta
     */
    public function setReceta(Receta $receta)
    {
        $this->receta = $receta;
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
     * @param Expediente $expediente
     */
    public function setExpediente(Expediente $expediente)
    {
        $this->expediente = $expediente;
    }

    /**
     * @return ConsultaCosto
     */
    public function getConsultaCosto()
    {
        return $this->consultaCosto;
    }

    /**
     * @param ConsultaCosto $consultaCosto
     */
    public function setConsultaCosto(ConsultaCosto $consultaCosto)
    {
        $this->consultaCosto = $consultaCosto;
    }

    /**
     * @return string
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param string $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
}