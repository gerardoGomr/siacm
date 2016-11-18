<?php
namespace Siacme\Dominio\Expedientes;

use Siacme\Dominio\Listas\IColeccion;

/**
 * Class TratamientoOdontologia
 * @package Siacme\Dominio\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 */
class TratamientoOdontologia
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $dx;

    /**
     * @var double
     */
    private $costo;

    /**
     * @var int
     */
    private $duracion;

    /**
     * @var int
     */
    private $mensualidades;

    /**
     * @var bool
     */
    private $ortopedia;

    /**
     * @var bool
     */
    private $ortodoncia;

    /**
     * @var bool
     */
    private $atendido;

    /**
     * @var double
     */
    private $saldo;

    /**
     * @var ExpedienteJohanna
     */
    private $expedienteEspecialidad;

    /**
     * @var IColeccion
     */
    private $pagos;

    /**
     * TratamientoOdontologia constructor.
     * @param string $dx
     * @param string $costo
     * @param string $duracion
     * @param int $mensualidades
     * @param ExpedienteJohanna $expedienteEspecialidad
     */
    public function __construct($dx, $costo, $duracion, $mensualidades, ExpedienteJohanna $expedienteEspecialidad, IColeccion $pagos)
    {
        $this->dx                     = $dx;
        $this->costo                  = $costo;
        $this->duracion               = $duracion;
        $this->mensualidades          = $mensualidades;
        $this->atendido               = false;
        $this->expedienteEspecialidad = $expedienteEspecialidad;
        $this->saldo                  = $costo;
        $this->pagos                  = $pagos;
    }

    /**
     * generar uno o dos tratamientos
     * @param bool $ortopedia
     * @param bool $ortodoncia
     */
    public function generarTratamientos($ortopedia, $ortodoncia)
    {
        $this->ortopedia  = $ortopedia;
        $this->ortodoncia = $ortodoncia;
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
    public function getDx()
    {
        return $this->dx;
    }

    /**
     * @return string
     */
    public function getCosto()
    {
        return $this->costo;
    }

    /**
     * @return string
     */
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * @return int
     */
    public function getMensualidades()
    {
        return $this->mensualidades;
    }

    /**
     * @return ExpedienteJohanna
     */
    public function getExpedienteEspecialidad()
    {
        return $this->expedienteEspecialidad;
    }

    /**
     * @return float
     */
    public function getSaldo()
    {
        return $this->saldo;
    }

    /**
     * @return IColeccion
     */
    public function getPagos()
    {
        return $this->pagos;
    }

    /**
     * @return boolean
     */
    public function ortopedia()
    {
        return $this->ortopedia;
    }

    /**
     * @return boolean
     */
    public function ortodoncia()
    {
        return $this->ortodoncia;
    }

    /**
     * indica si el tratamiento está atendido o no
     * @return boolean
     */
    public function atendido()
    {
        return $this->atendido;
    }

    /**
     * indica el tratamiento ya ha sido pagado
     * @return bool
     */
    public function pagado()
    {
        return $this->saldo === 0;
    }

    /**
     * devuelve una descripción de los tratamientos que se generaron
     * @return string
     */
    public function descripcionTratamientos()
    {
        $descripcion = '';

        if ($this->ortopedia()) {
            $descripcion .= 'Ortopedia';
        }

        if ($this->ortodoncia()) {
            if ($this->ortopedia()) {
                $descripcion .= ' ---- ';
            }

            $descripcion .= 'Ortodoncia';
        }

        return $descripcion;
    }

    /**
     * costo formateado
     * @return string
     */
    public function costo()
    {
        return '$' . number_format($this->costo, 2);
    }

    /**
     * @return float
     */
    public function abonoMinimo()
    {
        return round($this->costo / $this->mensualidades, 2);
    }
}