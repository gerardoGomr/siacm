<?php
namespace Siacme\Dominio\Consultas;

/**
 * Class ExploracionFisica
 * @package Siacme\Dominio\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class ExploracionFisica
{
    /**
     * @var double
     */
    private $peso;

    /**
     * @var double
     */
    private $talla;

    /**
     * @var string
     */
    private $pulso;

    /**
     * @var double
     */
    private $temperatura;

    /**
     * @var string
     */
    private $tensionArterial;

    /**
     * ExploracionFisica constructor.
     * @param float $peso
     * @param float $talla
     * @param string $pulso
     * @param float $temperatura
     * @param string $tensionArterial
     */
    public function __construct($peso, $talla, $pulso, $temperatura, $tensionArterial)
    {
        $this->peso            = $peso;
        $this->talla           = $talla;
        $this->pulso           = $pulso;
        $this->temperatura     = $temperatura;
        $this->tensionArterial = $tensionArterial;
    }

    /**
     * @return float
     */
    public function getPeso()
    {
        return $this->peso;
    }

    /**
     * @return float
     */
    public function getTalla()
    {
        return $this->talla;
    }

    /**
     * @return string
     */
    public function getPulso()
    {
        return $this->pulso;
    }

    /**
     * @return float
     */
    public function getTemperatura()
    {
        return $this->temperatura;
    }

    /**
     * @return string
     */
    public function getTensionArterial()
    {
        return $this->tensionArterial;
    }
}