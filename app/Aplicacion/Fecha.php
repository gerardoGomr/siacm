<?php
namespace Siacme\Aplicacion;

/**
 * Class Fecha
 * @package Siacme\Aplicacion
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class Fecha
{
    /**
     * @var array
     */
    public static $meses = [
        '01' => 'enero',
        '02' => 'feberero',
        '03' => 'marzo',
        '04' => 'abril',
        '05' => 'mayo',
        '06' => 'junio',
        '07' => 'julio',
        '08' => 'agosto',
        '09' => 'septiembre',
        '10' => 'octubre',
        '11' => 'noviembre',
        '12' => 'diciembre'
    ];

    /**
     * devolver una fecha en formato año - mes - dia a dia, mes en español y el año
     * @param string $fecha
     * @return string
     */
    public static function convertir($fecha)
    {
        list($anio, $mes, $dia) = explode('-', $fecha);

        return $dia . ' de ' . self::$meses[$mes] . ' de '. $anio;
    }
}