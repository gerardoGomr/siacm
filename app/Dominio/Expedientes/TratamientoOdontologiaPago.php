<?php
namespace Siacme\Dominio\Expedientes;

use DateTime;

/**
 * Class TratamientoOdontologiaPago
 * @package Siacme\Dominio\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class TratamientoOdontologiaPago
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var DateTime
     */
    private $fechaPago;

    /**
     * @var int
     */
    private $formaPago;

    /**
     * @var double
     */
    private $abono;

    /**
     * @var double
     */
    private $pago;

    /**
     * @var double
     */
    private $cambio;

    /**
     * @var TratamientoOdontologia
     */
    private $tratamientoOdontologia;

    /**
     * TratamientoOdontologiaPago constructor.
     * @param DateTime $fechaPago
     * @param int $formaPago
     * @param float $abono
     * @param float $pago
     * @param float $cambio
     * @param TratamientoOdontologia $tratamientoOdontologia
     */
    public function __construct(DateTime $fechaPago, $formaPago, $abono, $pago, $cambio, TratamientoOdontologia $tratamientoOdontologia)
    {
        $this->fechaPago              = $fechaPago;
        $this->formaPago              = $formaPago;
        $this->abono                  = $abono;
        $this->pago                   = $pago;
        $this->cambio                 = $cambio;
        $this->tratamientoOdontologia = $tratamientoOdontologia;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return DateTime
     */
    public function getFechaPago()
    {
        return $this->fechaPago;
    }

    /**
     * @return int
     */
    public function getFormaPago()
    {
        return $this->formaPago;
    }

    /**
     * @return float
     */
    public function getAbono()
    {
        return $this->abono;
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
     * @return TratamientoOdontologia
     */
    public function getTratamientoOdontologia()
    {
        return $this->tratamientoOdontologia;
    }
}