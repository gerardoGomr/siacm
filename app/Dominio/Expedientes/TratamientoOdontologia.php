<?php
namespace Siacme\Dominio\Expedientes;

use DateTime;
use Exception;
use Siacme\Dominio\Cobros\Cobro;
use Siacme\Dominio\Listas\IColeccion;
use Siacme\Exceptions\AbonoATratamientoDeOdontologiaEsMenorAlAbonoMinimoException;

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
     * @var string La descripción del padecimiento
     */
    private $dx;

    /**
     * @var string Las observaciones posibles
     */
    private $observaciones;

    /**
     * @var string La descripcion de las fases
     */
    private $tx;

    /**
     * @var double
     */
    private $costo;

    /**
     * @var DateTime
     */
    private $fechaInicio;

    /**
     * @var DateTime
     */
    private $fechaTermino;

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
     * @var bool
     */
    private $pagado;

    /**
     * TratamientoOdontologia constructor.
     *
     * @param string $dx
     * @param string $tx
     * @param string $observaciones
     * @param string $costo
     * @param DateTime $fechaInicio
     * @param DateTime $fechaTermino
     * @param int $mensualidades
     * @param ExpedienteJohanna $expedienteEspecialidad
     * @param IColeccion $pagos
     */
    public function __construct($dx, $tx, $observaciones, $costo, DateTime $fechaInicio, DateTime $fechaTermino, $mensualidades, ExpedienteJohanna $expedienteEspecialidad, IColeccion $pagos)
    {
        $this->dx                     = $dx;
        $this->observaciones          = $observaciones;
        $this->tx                     = $tx;
        $this->costo                  = $costo;
        $this->fechaInicio            = $fechaInicio;
        $this->fechaTermino           = $fechaTermino;
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
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * @return string
     */
    public function getTx()
    {
        return $this->tx;
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
        //return $this->duracion;
    }

    /**
     * @return DateTime
     */
    public function getFechaInicio(): DateTime
    {
        return $this->fechaInicio;
    }

    /**
     * @return DateTime
     */
    public function getFechaTermino(): DateTime
    {
        return $this->fechaTermino;
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
        return round(($this->costo / $this->mensualidades), 2);
    }

    /**
     * verifica si el tratamiento está pagado o no
     * @return bool
     */
    public function estaPagado()
    {
        return $this->pagado;
    }

    /**
     * devuelve el saldo del tratamiento
     * @return float
     */
    public function obtenerSaldo()
    {
        $saldo = $this->costo;

        foreach ($this->pagos as $pago) {
            $saldo -= $pago->getAbono();
        }

        return $saldo;
    }

    /**
     * saldo formateado a 2 decimales
     * @return string
     */
    public function saldoFormateado()
    {
        return '$' . number_format($this->obtenerSaldo(), 2);
    }

    /**
     * registrar un nuevo abono al total del tratamiento
     * verifica si el tratamiento ya no tiene saldo y cambia su estatus a pagado
     * @param Cobro $cobroTratamientoOdontologia
     * @throws Exception
     */
    public function registrarPago(Cobro $cobroTratamientoOdontologia)
    {
        try {
            if ($cobroTratamientoOdontologia->getAbono() < $this->abonoMinimo()) {
                throw new AbonoATratamientoDeOdontologiaEsMenorAlAbonoMinimoException('El abono mínimo a realizar al tratamiento es de ' . $this->abonoMinimo());
            }

            $cobroTratamientoOdontologia->registrarPago();

        } catch (Exception $e) {
            throw $e;
        }

        $this->pagos->add($cobroTratamientoOdontologia);

        if ($this->obtenerSaldo() === 0) {
            $this->pagado = true;
        }
    }

    /**
     * se marca el tratamiento como atendido
     */
    public function finalizarAtencion()
    {
        $this->atendido = true;
    }

    /**
     * actualizar tratamiento
     *
     * @param string $dx
     * @param string $tx
     * @param string $observaciones
     * @param float $costo
     * @param int $duracion
     * @param int $mensualidades
     */
    public function actualizar($dx, $observaciones, $tx, $costo, $duracion, $mensualidades)
    {
        $this->dx            = $dx;
        $this->observaciones = $observaciones;
        $this->tx            = $tx;
        $this->costo         = $costo;
        $this->duracion      = $duracion;
        $this->mensualidades = $mensualidades;
    }
}