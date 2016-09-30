<?php
namespace Siacme\Dominio\Expedientes;

/**
 * Class ExamenIntraoral
 * @package Siacme\Dominio\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class ExamenIntraoral
{
    /**
     * @var string
     */
    protected $labios;

    /**
     * @var string
     */
    protected $carrillos;

    /**
     * @var string
     */
    protected $frenillos;

    /**
     * @var string
     */
    protected $paladar;

    /**
     * @var string
     */
    protected $lengua;

    /**
     * @var string
     */
    protected $pisoDeBoca;

    /**
     * @var string
     */
    protected $parodonto;

    /**
     * @var string
     */
    protected $uvula;

    /**
     * @var string
     */
    protected $orofaringe;

    /**
     * ExamenIntraoral constructor.
     * @param string $labios
     * @param string $carrillos
     * @param string $frenillos
     * @param string $paladar
     * @param string $lengua
     * @param string $pisoDeBoca
     * @param string $parodonto
     * @param string $uvula
     * @param string $orofaringe
     */
    public function __construct($labios, $carrillos, $frenillos, $paladar, $lengua, $pisoDeBoca, $parodonto, $uvula, $orofaringe)
    {
        $this->labios     = $labios;
        $this->carrillos  = $carrillos;
        $this->frenillos  = $frenillos;
        $this->paladar    = $paladar;
        $this->lengua     = $lengua;
        $this->pisoDeBoca = $pisoDeBoca;
        $this->parodonto  = $parodonto;
        $this->uvula      = $uvula;
        $this->orofaringe = $orofaringe;
    }

    /**
     * @return string
     */
    public function getLabios()
    {
        return $this->labios;
    }

    /**
     * @return string
     */
    public function getCarrillos()
    {
        return $this->carrillos;
    }

    /**
     * @return string
     */
    public function getFrenillos()
    {
        return $this->frenillos;
    }

    /**
     * @return string
     */
    public function getPaladar()
    {
        return $this->paladar;
    }

    /**
     * @return string
     */
    public function getLengua()
    {
        return $this->lengua;
    }

    /**
     * @return string
     */
    public function getPisoDeBoca()
    {
        return $this->pisoDeBoca;
    }

    /**
     * @return string
     */
    public function getParodonto()
    {
        return $this->parodonto;
    }

    /**
     * @return string
     */
    public function getUvula()
    {
        return $this->uvula;
    }

    /**
     * @return string
     */
    public function getOrofaringe()
    {
        return $this->orofaringe;
    }
}