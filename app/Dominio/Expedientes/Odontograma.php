<?php
namespace Siacme\Dominio\Expedientes;

use Siacme\Dominio\Listas\IColeccion;
use Siacme\Exceptions\MasDeDosPadecimientosPorDienteException;

/**
 * Class Odontograma
 * @package Siacme\Dominio\Expedientes
 * @author  Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class Odontograma
{
	/**
	 * @var int
	 */
	protected $id;

	/**
	 * lista de dientes
	 * @var IColeccion
	 */
	protected $dientes;

	/**
	 * @var boolean
	 */
	protected $revisado;

    /**
     * @var ExpedienteJohanna
     */
    protected $expedienteEspecialidad;

	/**
	 * construir el odontograma con una lista de dientes
	 * si la lista no se proporciona, se asignan todos los diente
	 * caso contrario, se asigna el que se pasa como parámetro
	 * @param IColeccion $dientes
	 * @param bool  $revisado
	 */
	public function __construct(IColeccion $dientes, $revisado = false)
	{
		$this->revisado = $revisado;
		$this->dientes = $dientes;
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * agregar nuevo diente
	 * @param  Diente $diente
	 */
	public function agregarDiente(Diente $diente)
	{
		$this->dientes->add($diente);
	}

	/**
	 * remover los padecimientos al diente
	 * @param int $numeroDiente
	 */
	public function removerPadecimientosADiente($numeroDiente)
	{
		$this->diente($numeroDiente)->removerPadecimientos();
	}

	/**
	 * agregar un padecimiento al diente
	 * @param int $numeroDiente
	 * @param DientePadecimiento $dientePadecimiento
	 * @return bool
	 * @throws MasDeDosPadecimientosPorDienteException
	 */
	public function agregarPadecimientoADiente($numeroDiente, DientePadecimiento $dientePadecimiento)
	{
		try {
			$this->diente($numeroDiente)->agregarPadecimiento($dientePadecimiento);

		} catch(MasDeDosPadecimientosPorDienteException $e) {
			// log the error onto file
			return false;
		}
	}

	/**
	 * devolver un diente dependiendo el numero
	 * @param $numero
	 * @return Diente|null
	 */
	public function diente($numero)
	{
		foreach ($this->dientes->getValues() as $diente) {

			if($diente->getNumero() === $numero) {
				return $diente;
			}
		}

		return null;
	}

	/**
	 * @return boolean
	 */
	public function revisado()
	{
		return $this->revisado;
	}

	/**
	 * @return IColeccion
	 */
	public function getDientes()
	{
		return $this->dientes;
	}

	/**
	 * borrar los tratamientos asignados a sus dientes
	 */
	public function borrarDientesTratamientos()
	{
		foreach ($this->dientes as $diente) {
			$diente->removerTratamientos();
		}
	}

    /**
     * asignar para expediente especialidad
     * @param ExpedienteJohanna $expedienteJohanna
     */
    public function generarPara(ExpedienteJohanna $expedienteJohanna)
    {
        $this->expedienteEspecialidad = $expedienteJohanna;
    }
}