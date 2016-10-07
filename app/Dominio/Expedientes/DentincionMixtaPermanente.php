<?php
namespace Siacme\Dominio\Expedientes;

/**
 * Class DentincionMixtaPermanente
 * @package Siacme\Dominio\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
abstract class DentincionMixtaPermanente
{
    /**
     * @var bool
     */
    protected $derechaI;

    /**
     * @var bool
     */
    protected $derechaII;

    /**
     * @var bool
     */
    protected $derechaIII;

    /**
     * @var bool
     */
    protected $izquierdaI;

    /**
     * @var bool
     */
    protected $izquierdaII;

    /**
     * @var bool
     */
    protected $izquierdaIII;

    /**
     * DentincionMixtaPermanente constructor.
     * @param bool $derechaI
     * @param bool $derechaII
     * @param bool $derechaIII
     * @param bool $izquierdaI
     * @param bool $izquierdaII
     * @param bool $izquierdaIII
     */
    public function __construct($derechaI, $derechaII, $derechaIII, $izquierdaI, $izquierdaII, $izquierdaIII)
    {
        $this->derechaI     = $derechaI;
        $this->derechaII    = $derechaII;
        $this->derechaIII   = $derechaIII;
        $this->izquierdaI   = $izquierdaI;
        $this->izquierdaII  = $izquierdaII;
        $this->izquierdaIII = $izquierdaIII;
    }

    /**
     * @return boolean
     */
    public function derechaI()
    {
        return $this->derechaI;
    }

    /**
     * @return boolean
     */
    public function derechaII()
    {
        return $this->derechaII;
    }

    /**
     * @return boolean
     */
    public function derechaIII()
    {
        return $this->derechaIII;
    }

    /**
     * @return boolean
     */
    public function izquierdaI()
    {
        return $this->izquierdaI;
    }

    /**
     * @return boolean
     */
    public function izquierdaII()
    {
        return $this->izquierdaII;
    }

    /**
     * @return boolean
     */
    public function izquierdaIII()
    {
        return $this->izquierdaIII;
    }
}