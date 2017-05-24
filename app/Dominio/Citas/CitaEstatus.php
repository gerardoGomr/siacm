<?php
namespace Siacme\Dominio\Citas;

/**
 * Class CitaEstatus
 * @package Siacme\Dominio\Citas
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
abstract class CitaEstatus
{
    const AGENDADA               = 1;
    const CONFIRMADA             = 2;
    const EN_ESPERA_CONSULTA     = 3;
    const ATENDIDA               = 4;
    const CANCELADA              = 5;
    const CANCELADA_INASISTENCIA = 6;
}