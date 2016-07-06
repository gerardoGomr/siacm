<?php
namespace Siacme\Dominio\Expedientes;

/**
 * Class TratamientoOdontologiaTipo
 * @package Siacme\Dominio\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 */
class TratamientoOdontologiaTipo
{
    /**
     * @var string
     */
    private $nombre;

    /**
     * TratamientoOdontologiaTipo constructor.
     * @param string $nombre
     */
    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }
}