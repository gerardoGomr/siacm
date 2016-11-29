<?php
namespace Siacme\Dominio\Cobros;

use DateTime;

/**
 * Class Cobro
 * @package Siacme\Dominio\Cobros
 * @author Gerardo Adrián Gómez Ruiz
 * @version
 */
abstract class Cobro
{
    /**
     * @var double
     */
    protected $costo;

    /**
     * @var double
     */
    protected $pago;

    /**
     * @var double
     */
    protected $cambio;

    /**
     * @var int
     */
    protected $formaPago;

    /**
     * @var DateTime
     */
    protected $fechaPago;

    /**
     * @var double
     */
    protected $abono;

    const EFECTIVO = 1;
    const TARJETA  = 2;

    /**
     * CobroConsulta constructor.
     * @param double $costo
     * @param int $formaPago
     * @param DateTime $fechaPago
     */
    public function __construct($costo, $formaPago, DateTime $fechaPago)
    {
        $this->costo     = $costo;
        $this->formaPago = $formaPago;
        $this->fechaPago = $fechaPago;
    }

    /**
     * @return float
     */
    public function getCosto()
    {
        return $this->costo;
    }

    /**
     * @return float
     */
    public function getPago()
    {
        return $this->pago;
    }

    /**
     * @return float
     */
    public function getCambio()
    {
        return $this->cambio;
    }

    /**
     * @return int
     */
    public function getFormaPago()
    {
        return $this->formaPago;
    }

    /**
     * @return DateTime
     */
    public function getFechaPago()
    {
        return $this->fechaPago;
    }

    /**
     * @return float
     */
    public function getAbono()
    {
        return $this->abono;
    }

    /**
     * verifica si el medio de pago es en efectivo
     * @return bool
     */
    public function enEfectivo()
    {
        return $this->formaPago === self::EFECTIVO;
    }

    /**
     * registra el monto del pago
     * @param double $monto
     */
    public function montoPago($monto)
    {
        $this->pago = $monto;
    }

    /**
     * registra el pago
     */
    public abstract function registrarPago();

    /**
     * forma de pago en cadena
     * @return string
     */
    public function formaPago()
    {
        if ($this->formaPago === self::EFECTIVO) {
            return 'En Efectivo';
        }

        return 'Tarjeta crédito / débito';
    }
}