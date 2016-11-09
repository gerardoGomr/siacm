<?php
namespace Siacme\Dominio\Expedientes;

/**
 * Class OdontogramaOtroTratamiento
 * @package Siacme\Dominio\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class OdontogramaOtroTratamiento
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Odontograma
     */
    private $odontograma;

    /**
     * @var OtroTratamiento
     */
    private $otroTratamiento;

    /**
     * @var bool
     */
    private $atendido;

    /**
     * OdontogramaOtroTratamiento constructor.
     * @param Odontograma $odontograma
     * @param OtroTratamiento $otroTratamiento
     */
    public function __construct(Odontograma $odontograma, OtroTratamiento $otroTratamiento)
    {
        $this->odontograma     = $odontograma;
        $this->otroTratamiento = $otroTratamiento;
    }

    /**
     * @return Odontograma
     */
    public function getOdontograma()
    {
        return $this->odontograma;
    }

    /**
     * @return OtroTratamiento
     */
    public function getOtroTratamiento()
    {
        return $this->otroTratamiento;
    }

    /**
     * @return boolean
     */
    public function atendido()
    {
        return $this->atendido;
    }

    /**
     * marcar el tratamiento como atendido
     */
    public function atender()
    {
        $this->atendido = true;
    }
}