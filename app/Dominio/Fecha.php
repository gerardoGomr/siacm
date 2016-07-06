<?php
namespace Siacme\Dominio;

class Fecha
{
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

    public static function convertir($fecha)
    {
        list($anio, $mes, $dia) = explode('-', $fecha);

        return $dia . ' de ' . self::$meses[$mes] . ' de '. $anio;
    }
}