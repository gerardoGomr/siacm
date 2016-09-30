<?php
namespace Siacme\Aplicacion\Factories;

use App;
use DateTime;
use Illuminate\Http\Request;
use Siacme\Dominio\Expedientes\ExamenExtraoral;
use Siacme\Dominio\Expedientes\ExamenIntraoral;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Expedientes\ExpedienteJohanna;
use Siacme\Dominio\Pacientes\Domicilio;
use Siacme\Dominio\Usuarios\Usuario;
use Siacme\Infraestructura\Expedientes\DoctrineAtmsRepositorio;
use Siacme\Infraestructura\Expedientes\DoctrineConvexividadesFacialesRepositorio;
use Siacme\Infraestructura\Expedientes\DoctrineMorfologiasCraneofacialesRepositorio;
use Siacme\Infraestructura\Expedientes\DoctrineMorfologiasFacialesRepositorio;

/**
 * Class ExpedientesAgregarDatosConsultaFactory
 *
 * actualizar datos de un expediente en base al id del médico enviado
 * @package Siacme\Aplicacion\Factories
 * @author Gerardo Adrián Gómez Ruiz
 * @version
 */
class ExpedientesAgregarDatosConsultaFactory
{
    /**
     * se agrega la información adicional recabada en consulta
     * es llamado en caso que se edite el expediente o que se genere en la primer consulta
     *
     * @param Usuario $medico
     * @param Expediente $expediente
     * @param Request $request
     */
    public static function agregar(Usuario $medico, Expediente $expediente, Request $request)
    {
        switch ($medico->getId()) {
            case Usuario::JOHANNA:
                // crear expediente y detalle
                $craneofacialId                = (int)$request->get('craneofacial');
                $facialId                      = (int)$request->get('facial');
                $convexividadId                = (int)$request->get('convexividad');
                $atmId                         = (int)$request->get('atm');
                $labios                        = $request->get('labios');
                $carrillos                     = $request->get('carrillos');
                $frenillos                     = $request->get('frenillos');
                $paladar                       = $request->get('paladar');
                $lengua                        = $request->get('lengua');
                $pisoBoca                      = $request->get('pisoBoca');
                $parodonto                     = $request->get('parodonto');
                $uvula                         = $request->get('uvula');
                $orofaringe                    = $request->get('orofaringe');
                $arcoI                         = $request->get('arcoTipoI') === 'on' ? true : false;
                $arcoII                        = $request->get('arcoTipoII') === 'on' ? true : false;
                $mesialDerecho                 = $request->get('mesialDer') === 'on' ? true : false;
                $mesialIzquierdo               = $request->get('mesialIzq') === 'on' ? true : false;
                $distalDerecho                 = $request->get('distalDer') === 'on' ? true : false;
                $distalIzquierdo               = $request->get('distalIzq') === 'on' ? true : false;
                $rectoDerecho                  = $request->get('rectoDer') === 'on' ? true : false;
                $rectoIzquierdo                = $request->get('rectoIzq') === 'on' ? true : false;
                $exageradoDerecho              = $request->get('exageradoDer') === 'on' ? true : false;
                $exageradoIzquierdo            = $request->get('exagerardoIzq') === 'on' ? true : false;
                $noDeterminadoDerecho          = $request->get('noDeterminadoDer') === 'on' ? true : false;
                $noDeterminadoIzquierdo        = $request->get('noDeterminadoIzq') === 'on' ? true : false;
                $caninaDerecho                 = $request->get('caninaDer') === 'on' ? true : false;
                $caninaIzquierdo               = $request->get('caninaIzq') === 'on' ? true : false;
                $relacionMolarDerechoI         = $request->get('relacionMolarDerI') === 'on' ? true : false;
                $relacionMolarIzquierdoI       = $request->get('relacionMolarIzqI') === 'on' ? true : false;
                $relacionMolarDerechoII        = $request->get('relacionMolarDerII') === 'on' ? true : false;
                $relacionMolarIzquierdoII      = $request->get('relacionMolarIzqII') === 'on' ? true : false;
                $relacionMolarDerechoIII       = $request->get('relacionMolarDerIII') === 'on' ? true : false;
                $relacionMolarIzquierdoIII     = $request->get('relacionMolarIzqIII') === 'on' ? true : false;
                $relacionCaninaDerechoI        = $request->get('relacionCaninaDerI') === 'on' ? true : false;
                $relacionCaninaIzquierdoI      = $request->get('relacionCaninaIzqI') === 'on' ? true : false;
                $relacionCaninaDerechoII       = $request->get('relacionCaninaDerII') === 'on' ? true : false;
                $relacionCaninaIzquierdoII     = $request->get('relacionCaninaIzqII') === 'on' ? true : false;
                $relacionCaninaDerechoIII      = $request->get('relacionCaninaDerIII') === 'on' ? true : false;
                $relacionCaninaIzquierdoIII    = $request->get('relacionCaninaIzqIII') === 'on' ? true : false;
                $mordidaBordeBorde             = $request->get('mordidaBordeBorde') === 'on' ? true : false;
                $medidaMordidaBordeABorde      = (double)$request->get('medidaMordida');
                $sobremordidaVertical          = $request->get('sobremordidaVertical') === 'on' ? true : false;
                $medidaSobremordidaVertical    = (double)$request->get('medidaSobremordidaVertical');
                $sobremordidaHorizontal        = $request->get('sobremordidaHorizontal') === 'on' ? true : false;
                $medidaSobremordidaHorizontal  = (double)$request->get('medidaSobremordidaHorizontal');
                $mordidaAbiertaAnterior        = $request->get('mordidaAbiertaAnterior') === 'on' ? true : false;
                $medidaMordidaAbierta          = (double)$request->get('medidaMordidaAbierta');
                $mordidaCruzadaAnterior        = $request->get('mordidaCruzadaAnterior') === 'on' ? true : false;
                $medidaMordidaCruzadaAnterior  = (double)$request->get('medidaMordidaCruzadaAnterior');
                $mordidaCruzadaPosterior       = $request->get('mordidaCruzadaPosterior') === 'on' ? true : false;
                $medidaMordidaCruzadaPosterior = (double)$request->get('medidaMordidaCruzadaPosterior');
                $lineaMediaDental              = $request->get('lineaMediaDental') === 'on' ? true : false;
                $medidaLineaMediaDental        = (double)$request->get('medidaLineaMediaDental');
                $lineaMediaEsqueletica         = $request->get('lineaMediaEsqueletica') === 'on' ? true : false;
                $medidaLineaMediaEsqueletica   = (double)$request->get('medidaLineaMediaEsqueletica');
                $alteracionTamanio             = $request->get('alteracionTamanio') === 'on' ? true : false;
                $medidaAlteracionTamanio       = (double)$request->get('medidaAlteracionTamanio');
                $alteracionForma               = $request->get('alteracionForma') === 'on' ? true : false;
                $medidaAlteracionForma         = (double)$request->get('medidaAlteracionForma');
                $alteracionNumero              = $request->get('alteracionNumero') === 'on' ? true : false;
                $medidaAlteracionNumero        = (double)$request->get('medidaAlteracionNumero');
                $alteracionEstructura          = $request->get('alteracionEstructura') === 'on' ? true : false;
                $medidaAlteracionEstructura    = (double)$request->get('medidaAlteracionEstructura');
                $alteracionTextura             = $request->get('alteracionTextura') === 'on' ? true : false;
                $medidaAlteracionTextura       = (double)$request->get('medidaAlteracionTextura');
                $alteracionColor               = $request->get('alteracionColor') === 'on' ? true : false;
                $medidaAlteracionColor         = (double)$request->get('medidaAlteracionColor');

                // repositorios
                $morfologiasCraneofacialesRepositorio = new DoctrineMorfologiasCraneofacialesRepositorio(App::make('Doctrine\ORM\EntityManagerInterface'));
                $morfologiasFacialesRepositorio       = new DoctrineMorfologiasFacialesRepositorio(App::make('Doctrine\ORM\EntityManagerInterface'));
                $convexividadesFacialesRepositorio    = new DoctrineConvexividadesFacialesRepositorio(App::make('Doctrine\ORM\EntityManagerInterface'));
                $atmsRepositorio                      = new DoctrineAtmsRepositorio(App::make('Doctrine\ORM\EntityManagerInterface'));

                // objetos catalogos
                $morfologiaCraneofacial = $morfologiasCraneofacialesRepositorio->obtenerPorId($craneofacialId);
                $morfologiaFacial       = $morfologiasFacialesRepositorio->obtenerPorId($facialId);
                $convexividadFacial     = $convexividadesFacialesRepositorio->obtenerPorId($convexividadId);
                $atm                    = $atmsRepositorio->obtenerPorId($atmId);

                $examenExtraoral = new ExamenExtraoral($morfologiaCraneofacial, $morfologiaFacial, $convexividadFacial, $atm);
                $expediente->getExpedienteEspecialidad()->agregarExamenExtraoral($examenExtraoral);

                $examenIntraoral = new ExamenIntraoral($labios, $carrillos, $frenillos, $paladar, $lengua, $pisoBoca, $parodonto, $uvula, $orofaringe);
                $expediente->getExpedienteEspecialidad()->agregarExamenIntraoral($examenIntraoral);

                $expediente->getExpedienteEspecialidad()->agregarArcos($arcoI, $arcoII);
                break;
        }
    }
}