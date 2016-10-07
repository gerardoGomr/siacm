<?php
namespace Siacme\Dominio\Expedientes;

/**
 * Class DentintionTemporal
 * @package Siacme\Dominio\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class DentincionTemporal
{
    /**
     * @var AbstractEscalon
     */
    private $escalonMesial;

    /**
     * @var AbstractEscalon
     */
    private $escalonDistal;

    /**
     * @var AbstractEscalon
     */
    private $escalonRecto;

    /**
     * @var AbstractEscalon
     */
    private $mesialExagerado;

    /**
     * @var AbstractEscalon
     */
    private $mesialNoDeterminado;

    /**
     * @var AbstractEscalon
     */
    private $relacionCanina;

    /**
     * DentintionTemporal constructor.
     * @param AbstractEscalon $escalonMesial
     * @param AbstractEscalon $escalonDistal
     * @param AbstractEscalon $escalonRecto
     * @param AbstractEscalon $mesialExagerado
     * @param AbstractEscalon $mesialNoDeterminado
     * @param AbstractEscalon $relacionCanina
     */
    public function __construct(AbstractEscalon $escalonMesial, AbstractEscalon $escalonDistal, AbstractEscalon $escalonRecto, AbstractEscalon $mesialExagerado, AbstractEscalon $mesialNoDeterminado, AbstractEscalon $relacionCanina)
    {
        $this->escalonMesial       = $escalonMesial;
        $this->escalonDistal       = $escalonDistal;
        $this->escalonRecto        = $escalonRecto;
        $this->mesialExagerado     = $mesialExagerado;
        $this->mesialNoDeterminado = $mesialNoDeterminado;
        $this->relacionCanina      = $relacionCanina;
    }

    /**
     * @return AbstractEscalon
     */
    public function getEscalonMesial()
    {
        return $this->escalonMesial;
    }

    /**
     * @return AbstractEscalon
     */
    public function getEscalonDistal()
    {
        return $this->escalonDistal;
    }

    /**
     * @return AbstractEscalon
     */
    public function getEscalonRecto()
    {
        return $this->escalonRecto;
    }

    /**
     * @return AbstractEscalon
     */
    public function getMesialExagerado()
    {
        return $this->mesialExagerado;
    }

    /**
     * @return AbstractEscalon
     */
    public function getMesialNoDeterminado()
    {
        return $this->mesialNoDeterminado;
    }

    /**
     * @return AbstractEscalon
     */
    public function getRelacionCanina()
    {
        return $this->relacionCanina;
    }
}