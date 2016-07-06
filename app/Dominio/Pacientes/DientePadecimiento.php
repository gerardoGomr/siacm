<?php
namespace Siacme\Dominio\Pacientes;

/**
 * Class DienteEstatus
 * @package Siacme\Dominio\Pacientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
class DientePadecimiento
{
	/**
	 * id de estatus
	 * @var int
	 */
	private $id;

	/**
	 * nombre del estatus
	 * @var string
	 */
	private $nombre;

	/**
	 * ruta de la imagen que representa el estatus
	 * @var string
	 */
	private $imagen;

	public function __construct($id = 1, $nombre = 'Sin Estatus', $imagen = 'public/img/dientes/x.png')
	{
		$this->id     = $id;
		$this->nombre = $nombre;
		$this->imagen = $imagen;
	}

    /**
     * Gets the id de estatus.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the id de estatus.
     *
     * @param int $id the id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Gets the nombre del estatus.
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Sets the nombre del estatus.
     *
     * @param string $nombre the nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Gets the ruta de la imagen que representa el estatus.
     *
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Sets the ruta de la imagen que representa el estatus.
     *
     * @param string $imagen the imagen
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }
}