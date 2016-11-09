<?php
namespace Siacme\Dominio\Consultas;
use DateTime;
use Siacme\Exceptions\PagoConsultaEsMenorATotalException;

/**
 * Class CobroConsulta
 * @package Siacme\Dominio\Consultas
 * @author Gerardo Adrián Gómez Ruiz
 * @version
 */
class CobroConsulta
{
    /**
     * @var double
     */
    private $pago;

    /**
     * @var double
     */
    private $cambio;

    /**
     * @var int
     */
    private $formaPago;

    /**
     * @var DateTime
     */
    private $fechaPago;

    const EFECTIVO = 1;
    const TARJETA  = 2;

    /**
     * CobroConsulta constructor.
     * @param int $formaPago
     * @param DateTime $fechaPago
     */
    public function __construct($formaPago, DateTime $fechaPago)
    {
        $this->formaPago = $formaPago;
        $this->fechaPago = $fechaPago;
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
     * calcular el cambio real
     * @param double $montoAPagar
     * @throws PagoConsultaEsMenorATotalException
     */
    public function calcularCambio($montoAPagar)
    {
        if ($montoAPagar > $this->pago) {
            throw new PagoConsultaEsMenorATotalException('El monto del pago no puede ser menor que el total a pagar.');
        }

        $this->cambio = $this->pago - $montoAPagar;
    }

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