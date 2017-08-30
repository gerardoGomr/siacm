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
     * primary
     * 
     * @var integer
     */
    private $id;

    /**
     * @var Consulta
     */
    private $consulta;

    /**
     * CobroConsulta constructor.
     * 
     * @param double $abono
     * @param double $pago
     * @param int $formaPago
     * @param DateTime $fechaPago
     * @param Consulta $consulta
     */
    public function __construct($abono, $pago, $formaPago, DateTime $fechaPago, Consulta $consulta)
    {
        $this->abono    = $abono;
        $this->pago     = $pago;
        $this->consulta = $consulta;

        parent::__construct($abono, $formaPago, $fechaPago);
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * retorna la consulta asociada a este cobro
     * 
     * @return Consulta
     */
    public function getConsulta()
    {
        return $this->consulta;
    }

    /**
     * registra el pago
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