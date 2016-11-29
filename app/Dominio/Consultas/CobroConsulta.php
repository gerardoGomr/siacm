<?php
namespace Siacme\Dominio\Consultas;

use DateTime;
use Siacme\Dominio\Cobros\Cobro;
use Siacme\Exceptions\PagoConsultaEsMenorATotalException;

/**
 * Class CobroConsulta
 * @package Siacme\Dominio\Consultas
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class CobroConsulta extends Cobro
{
    /**
     * CobroConsulta constructor.
     * @param double $costo
     * @param double $pago
     * @param int $formaPago
     * @param DateTime $fechaPago
     */
    public function __construct($costo, $pago, $formaPago, DateTime $fechaPago)
    {
        $this->pago = $pago;

        parent::__construct($costo, $formaPago, $fechaPago);
    }

    /**
     * registra el pago
     * @throws PagoConsultaEsMenorATotalException
     */
    public function registrarPago()
    {
        // TODO: Implement registrarPago() method.

        if ($this->enEfectivo()) {
            if ($this->costo > $this->pago) {
                throw new PagoConsultaEsMenorATotalException('El monto del pago no puede ser menor que el monto total de la consulta.');
            }

            $this->abono  = $this->costo;
            $this->cambio = $this->pago - $this->costo;

        } else {
            $this->abono  = $this->costo;
            $this->cambio = 0;
        }
    }
}