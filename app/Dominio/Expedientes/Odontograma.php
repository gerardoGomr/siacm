<?php
namespace Siacme\Dominio\Pacientes;
use Illuminate\Support\Collection;

/**
 * Class Odontograma
 * @package Siacme\Dominio\Pacientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
class Odontograma
{
	/**
	 * @var int
	 */
	protected $id;

	/**
	 * lista de dientes
	 * @var Collection
	 */
	protected $listaDientes;

	/**
	 * @var boolean
	 */
	protected $revisado;

	/**
	 * construir el odontograma con una lista de dientes
	 * si la lista no se proporciona, se asignan todos los diente
	 * caso contrario, se asigna el que se pasa como parámetro
	 * @param Collection $listaDientes
	 * @param bool  $revisado
	 */
	public function __construct(Collection $listaDientes = null, $revisado = false)
	{
		$this->revisado = $revisado;
		if(!is_null($listaDientes)) {
			$this->listaDientes = $listaDientes;

		} else {
			$this->listaDientes = new Collection();
			$this->agregarDientes(11, 18);
			$this->agregarDientes(21, 28);
			$this->agregarDientes(31, 38);
			$this->agregarDientes(41, 48);
			$this->agregarDientes(51, 55);
			$this->agregarDientes(61, 65);
			$this->agregarDientes(71, 75);
			$this->agregarDientes(81, 85);

		}
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * agregar nuevo diente
	 * @param  Diente $diente
	 * @return void
	 */
	public function agregarDiente(Diente $diente)
	{
		$this->listaDientes->push($diente);
	}

	/**
	 * agregar dientes dependiendo el rango
	 * @param  int $inicio
	 * @param  int $fin
	 * @return void
	 */
	public function agregarDientes($inicio, $fin)
	{
		for ($i = $inicio; $i <= $fin; $i++) {
			// se agrega un nuevo diente con sus características por default
			$this->agregarDiente(new Diente($i, new DientePadecimiento(1)));
		}
	}

	/**
	 * devolver un diente dependiendo el numero
	 * @param $numero
	 * @return Diente|null
	 */
	public function diente($numero)
	{
		foreach ($this->listaDientes as $diente) {

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
	 * @param boolean $revisado
	 */
	public function setRevisado($revisado)
	{
		$this->revisado = $revisado;
	}

	/**
	 * @return Collection
	 */
	public function getListaDientes()
	{
		return $this->listaDientes;
	}

	/**
	 * @param Collection $listaDientes
	 */
	public function setListaDientes(Collection $listaDientes)
	{
		$this->listaDientes = $listaDientes;
	}

	public function borrarDientesTratamientos()
	{
		foreach ($this->listaDientes as $diente) {
			$diente->removerTratamientos();
		}
	}
}