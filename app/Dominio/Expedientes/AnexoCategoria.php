<?php
namespace Siacme\Dominio\Expedientes;

/**
 * Class AnexoCategoria
 * @package Siacme\Dominio\Expedientes
 * @author  Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class AnexoCategoria
{
    private $id;
    private $nombre;

    /**
     * AnexoCategoria constructor
     * @param int $id
     * @param string $nombre;
     */
    public function __construct($id, $nombre)
    {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    /**
     * Devuelve el id
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Devuelve el nombre
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }
}
