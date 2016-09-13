<?php
namespace Siacme\Dominio\Expedientes;

/**
 * Class DientePadecimiento
 * @package Siacme\Dominio\Expedientes
 * @author  Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class DientePadecimiento
{
	/**
	 * @var int
	 */
	private $id;

	/**
	 * @var string
	 */
	private $nombre;

	/**
	 * ruta de la imagen que representa el estatus
	 * @var string
	 */
	private $imagen;

    /**
     * DientePadecimiento Constructor
     * @param string $nombre
     * @param string $imagen
     */
	public function __construct($nombre = 'Sin Estatus', $imagen = 'public/img/dientes/x.png')
	{
		$this->nombre = $nombre;
		$this->imagen = $imagen;
	}

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
    }
}