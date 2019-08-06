<?php
namespace Siacme\Dominio\Expedientes;

use DateTime;
use Siacme\Dominio\Listas\IColeccion;

/**
 * Class PacienteJohanna
 * @package Siacme\Dominio\Pacientes;
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class ExpedienteRigoberto extends AbstractExpediente
{
    /**
     * @var string
     */
    private $representanteLegal;

    /**
     * @var int
     */
    private $perioricidadBanio;

    /**
     * @var int
     */
    private $perioricidadHigieneBucal;

    /**
     * @var int
     */
    private $perioricidadLavaManos;

    /**
     * @var int
     */
    private $frecuenciaCambioRopa;

    /**
     * @var int
     */
    private $vecesComeDia;

    /**
     * @var int
     */
    private $tiempoEntreComidas;

    /**
     * @var int
     */
    private $horasDuerme;

    /**
     * @var string
     */
    private $frecuenciaEjercicio;

    /**
     * @var int
     */
    private $regimenAlimenticio;

    /**
     * @var string
     */
    private $descripcionRegimen;

	public function __construct()
	{
		parent::__construct();
	}
    /**
     * completar los datos personales
     * @param string $nombrePadre
     * @param string $ocupacionPadre
     * @param string $nombreMadre
     * @param string $ocupacionMadre
     */
    public function agregarDatosPersonales($nombrePadre, $ocupacionPadre, $nombreMadre, $ocupacionMadre)
    {
        $this->nombrePadre    = $nombrePadre;
        $this->ocupacionPadre = $ocupacionPadre;
        $this->nombreMadre    = $nombreMadre;
        $this->ocupacionMadre = $ocupacionMadre;
    }

    /**
     * @return string
     */
    public function getRepresentanteLegal()
    {
        return $this->representanteLegal;
    }

    /**
     * @return int
     */
    public function getPerioricidadBanio()
    {
        return $this->perioricidadBanio;
    }

    /**
     * @return int
     */
    public function getPerioricidadHigieneBucal()
    {
        return $this->perioricidadHigieneBucal;
    }

    /**
     * @return int
     */
    public function getPerioricidadLavaManos()
    {
        return $this->perioricidadLavaManos;
    }

    /**
     * @return int
     */
    public function getFrecuenciaCambioRopa()
    {
        return $this->frecuenciaCambioRopa;
    }

    /**
     * @return int
     */
    public function getVecesComeDia()
    {
        return $this->vecesComeDia;
    }

    /**
     * @return int
     */
    public function getTiempoEntreComidas()
    {
        return $this->tiempoEntreComidas;
    }

    /**
     * @return int
     */
    public function getHorasDuerme()
    {
        return $this->horasDuerme;
    }

    /**
     * @return string
     */
    public function getFrecuenciaEjercicio()
    {
        return $this->frecuenciaEjercicio;
    }

    /**
     * @return int
     */
    public function getRegimenAlimenticio()
    {
        return $this->regimenAlimenticio;
    }

    /**
     * @return string
     */
    public function getDescripcionRegimen()
    {
        return $this->descripcionRegimen;
    }

    /**
     * Inicializar antecedentes no patológicos
     * 
     * @param  integer $perioricidadBanio
     * @param  integer $perioricidadHigieneBucal 
     * @param  integer $perioricidadLavaManos    
     * @param  integer $frecuenciaCambioRopa     
     * @param  integer $vecesComeDia     
     * @param  integer $tiempoEntreComidas       
     * @param  integer $regimenAlimenticio       
     * @param  integer $especifiqueRegimen       
     * @param  integer $horasDuerme      
     * @param  integer $frecuenciaEjercicio   
     *    
     * @return void                
     */
    public function agregarDatosNoPatologicos($perioricidadBanio, $perioricidadHigieneBucal, $perioricidadLavaManos, $frecuenciaCambioRopa, $vecesComeDia, $tiempoEntreComidas, $regimenAlimenticio, $especifiqueRegimen, $horasDuerme, $frecuenciaEjercicio)
    {
        $this->perioricidadBanio        = $perioricidadBanio;
        $this->perioricidadHigieneBucal = $perioricidadHigieneBucal;
        $this->perioricidadLavaManos    = $perioricidadLavaManos;
        $this->frecuenciaCambioRopa     = $frecuenciaCambioRopa;
        $this->vecesComeDia             = $vecesComeDia;
        $this->tiempoEntreComidas       = $tiempoEntreComidas;
        $this->regimenAlimenticio       = $regimenAlimenticio;
        $this->especifiqueRegimen       = $especifiqueRegimen;
        $this->horasDuerme              = $horasDuerme;
        $this->frecuenciaEjercicio      = $frecuenciaEjercicio;
    }

    /**
     * verifica que todos los tratamientos y odontogramas estén atendidos
     * @return bool
     */
    public function dadoDeAlta()
    {
        return false;
    }
}