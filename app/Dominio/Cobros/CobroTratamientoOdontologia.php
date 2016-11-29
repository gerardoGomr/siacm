<?php
namespace Siacme\Dominio\Cobros;

use DateTime;
use Siacme\Dominio\Expedientes\TratamientoOdontologia;
use Siacme\Exceptions\PagoConsultaEsMenorATotalException;

/**
 * Class CobroTratamientoOdontologia
 * @package Siacme\Dominio\Cobros
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class CobroTratamientoOdontologia extends Cobro
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var TratamientoOdontologia
     */
    private $tratamientoOdontologia;

    /**
     * CobroTratamientoOdontologia constructor.
     * @param double $abono
     * @param double $pago
     * @param int $formaPago
     * @param DateTime $fechaPago
     * @param TratamientoOdontologia $tratamientoOdontologia
     */
    public function __construct($abono, $pago, $formaPago, DateTime $fechaPago, TratamientoOdontologia $tratamientoOdontologia)
    {
        $this->abono                  = $abono;
        $this->pago                   = $pago;
        $this->tratamientoOdontologia = $tratamientoOdontologia;

        parent::__construct($this->abono, $formaPago, $fechaPago);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return TratamientoOdontologia
     */
    public function getTratamientoOdontologia()
    {
        return $this->tratamientoOdontologia;
    }

    /**
     * registrar el abono/pago del tratamiento
     * @throws PagoConsultaEsMenorATotalException
     */
    public function registrarPago()
    {
        // TODO: Implement registrarPago() method.
        if ($this->enEfectivo()) {
            if ($this->abono > $this->pago) {
                throw new PagoConsultaEsMenorATotalException('El monto del pago no puede ser menor que el total del abono.');
            }

            $this->cambio = $this->pago - $this->abono;

        } else {
            $this->pago   = $this->abono;
            $this->cambio = 0;
        }
    }
}