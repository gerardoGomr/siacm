<?php
namespace Siacme\Dominio\Consultas;
use Siacme\Dominio\Fecha;

/**
 * Class Receta
 * @package Siacme\Dominio\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
 */
class Receta
{
	/**
	 * @var int
	 */
	protected $id;

    /**
     * @var string
     */
	protected $receta;

    /**
     * @var string
     */
	protected $nombre;

    /**
     * Receta constructor.
     * @param int $id
     * @param string $receta
     * @param string $nombre
     */
    public function __construct($id = null, $receta = null, $nombre = null)
    {
        $this->id     = $id;
        $this->receta = $receta;
        $this->nombre = $nombre;
    }


    /**
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id the id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getReceta()
    {
        return $this->receta;
    }

    /**
     * @param string $receta
     */
    public function setReceta($receta)
    {
        $this->receta = $receta;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * convertir la fecha
     * @param string $fecha
     * @return string
     */
    public function fechaReceta($fecha)
    {
        return Fecha::convertir($fecha);
    }
}