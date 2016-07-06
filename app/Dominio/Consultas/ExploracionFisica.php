<?php
namespace Siacme\Dominio\Consultas;

/**
 * Class ExploracionFisica
 * @package Siacme\Dominio\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
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
     * @param float $peso
     */
    public function setPeso($peso)
    {
        $this->peso = $peso;
    }

    /**
     * @return float
     */
    public function getTalla()
    {
        return $this->talla;
    }

    /**
     * @param float $talla
     */
    public function setTalla($talla)
    {
        $this->talla = $talla;
    }

    /**
     * @return string
     */
    public function getPulso()
    {
        return $this->pulso;
    }

    /**
     * @param string $pulso
     */
    public function setPulso($pulso)
    {
        $this->pulso = $pulso;
    }

    /**
     * @return float
     */
    public function getTemperatura()
    {
        return $this->temperatura;
    }

    /**
     * @param float $temperatura
     */
    public function setTemperatura($temperatura)
    {
        $this->temperatura = $temperatura;
    }

    /**
     * @return string
     */
    public function getTensionArterial()
    {
        return $this->tensionArterial;
    }

    /**
     * @param string $tensionArterial
     */
    public function setTensionArterial($tensionArterial)
    {
        $this->tensionArterial = $tensionArterial;
    }
}