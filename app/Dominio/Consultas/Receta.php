<?php
namespace Siacme\Dominio\Consultas;

use Siacme\Aplicacion\Fecha;

/**
 * Class Receta
 * @package Siacme\Dominio\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
 * @version 1.0
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
     * @return string
     */
    public function getReceta()
    {
        return $this->receta;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
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