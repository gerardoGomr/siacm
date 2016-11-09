<?php
namespace Siacme\Dominio\Expedientes;

/**
 * Class Anexo
 * @package Siacme\Dominio\Expedientes
 * @author  Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class Anexo
{
    /**
     * @var string
     */
    private $nombre;

    /**
     * Anexo Constructor
     * @param string $nombre
     */
    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * convierte cualquier espacio en blanco del nombre del anexo
     * en guión bajo
     * @return string
     */
    public function preparar()
    {
        return str_replace(' ', '_', $this->nombre);
    }

    /**
     * devuelve el nombre del anexo
     * @return string
     */
    public function nombre()
    {
        return $this->nombre;
    }

    /**
     * Nombre real del anexo
     * @return string
     */
    public function nombreFormal()
    {
        return str_replace('_', ' ', $this->nombre);
    }
}