<?php
namespace Siacme\Servicios\Consultas;


use Siacme\Infraestructura\Consultas\AtmsRepositorioLaravelMySQL;
use Siacme\Infraestructura\Consultas\ConvexividadesFacialRepositorioLaravelMySQL;
use Siacme\Infraestructura\Consultas\MorfologiasCraneofacialRepositorioLaravelMySQL;
use Siacme\Infraestructura\Consultas\MorfologiasFacialRepositorioLaravelMySQL;

/**
 * Class CatalogosExamenExtraoralFactory
 * @package Siacme\Servicios\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
 */
class CatalogosExamenExtraoralFactory
{
    /**
     * @param int $tipo
     * @return MorfologiaFacial|AtmsRepositorioLaravelMySQL|ConvexividadesFacialRepositorioLaravelMySQL|MorfologiasCraneofacialRepositorioLaravelMySQL
     */
    public static function crearRepositorio($tipo)
    {
        switch($tipo) {
            case 1:
                return new MorfologiasCraneofacialRepositorioLaravelMySQL();
                break;

            case 2:
                return new MorfologiasFacialRepositorioLaravelMySQL();
                break;

            case 3:
                return new ConvexividadesFacialRepositorioLaravelMySQL();
                break;

            case 4:
                return new AtmsRepositorioLaravelMySQL();
                break;

            default:
                throw new \InvalidArgumentException('Repositorio inválido');
                break;
        }
    }
}