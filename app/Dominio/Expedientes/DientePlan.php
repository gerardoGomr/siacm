<?php
namespace Siacme\Dominio\Expedientes;

/**
 * Class DientePlan
 * @package Siacme\Dominio\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class DientePlan
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var DienteTratamiento
     */
    private $dienteTratamiento;

	/**
	 * @var bool
	 */
	private $atendido;

    /**
     * @var OdontogramaDiente
     */
    private $odontogramaDiente;

    /**
     * constructor
     * @param DienteTratamiento $dienteTratamiento
     * @param bool $atendido
     */
	public function __construct(DienteTratamiento $dienteTratamiento, $atendido = false)
	{
        $this->dienteTratamiento = $dienteTratamiento;
		$this->atendido          = $atendido;
	}

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return DienteTratamiento
     */
    public function getDienteTratamiento()
    {
        return $this->dienteTratamiento;
    }

	/**
	 * @return bool
	 */
	public function atendido()
	{
		return $this->atendido;
	}

	/**
	 * atender el tratamiento
	 */
	public function atender()
	{
		$this->atendido = true;
	}

    /**
     * asignar odontograma diente
     * @param OdontogramaDiente $odontogramaDiente
     */
    public function asignarOdontogramaDiente(OdontogramaDiente $odontogramaDiente)
    {
        $this->odontogramaDiente = $odontogramaDiente;
    }
}