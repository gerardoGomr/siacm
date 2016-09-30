<?php
namespace Siacme\Dominio\Expedientes;

/**
 * Class ExamenExtraoral
 * @package Siacme\Dominio\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class ExamenExtraoral
{
    /**
     * @var MorfologiaCraneofacial
     */
    private $morfologiaCraneofacial;

    /**
     * @var MorfologiaFacial
     */
    private $morfologiaFacial;

    /**
     * @var ConvexividadFacial
     */
    private $convexividadFacial;

    /**
     * @var ATM
     */
    private $atm;
    
    /**
     * ExamenExtraoral constructor.
     * @param MorfologiaCraneofacial $morfologiaCraneofacial
     * @param MorfologiaFacial $morfologiaFacial
     * @param ConvexividadFacial $convexividadFacial
     * @param ATM $atm
     */
    public function __construct(MorfologiaCraneofacial $morfologiaCraneofacial, MorfologiaFacial $morfologiaFacial, ConvexividadFacial $convexividadFacial, ATM $atm)
    {
        $this->morfologiaCraneofacial = $morfologiaCraneofacial;
        $this->morfologiaFacial       = $morfologiaFacial;
        $this->convexividadFacial     = $convexividadFacial;
        $this->atm                    = $atm;
    }

    /**
     * @return MorfologiaCraneofacial
     */
    public function getMorfologiaCraneofacial()
    {
        return $this->morfologiaCraneofacial;
    }

    /**
     * @return MorfologiaFacial
     */
    public function getMorfologiaFacial()
    {
        return $this->morfologiaFacial;
    }

    /**
     * @return ConvexividadFacial
     */
    public function getConvexividadFacial()
    {
        return $this->convexividadFacial;
    }

    /**
     * @return ATM
     */
    public function getAtm()
    {
        return $this->atm;
    }
}