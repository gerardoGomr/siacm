<?php
namespace Siacme\Servicios\Pacientes;

use Illuminate\Http\Request;
use Siacme\Dominio\Pacientes\ATM;
use Siacme\Dominio\Pacientes\ConvexividadFacial;
use Siacme\Dominio\Pacientes\MorfologiaCraneofacial;
use Siacme\Dominio\Pacientes\MorfologiaFacial;
use Siacme\Dominio\Pacientes\Paciente;
use Siacme\Infraestructura\Pacientes\PacientesRepositorioInterface;

/**
 * Class PacientesComplementoServicio
 * @package Siacme\Servicios\Pacientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
class PacientesJohannaComplementoServicio
{
    /**
     * @var PacientesRepositorioInterface
     */
    private $pacientesRepositorio;

    /**
     * PacientesComplementoServicio constructor.
     * @param PacientesRepositorioInterface $pacientesRepositorio
     */
        public function __construct(PacientesRepositorioInterface $pacientesRepositorio)
    {
        $this->pacientesRepositorio = $pacientesRepositorio;
    }

    /**
     * @param Request $request
     * @param Paciente $paciente
     * @return bool
     */
    public function crearDeHttp(Request $request, Paciente $paciente)
    {
        // obtener todos los elementos que posiblemente se hayan enviado en caso de que sea un paciente de primera vez
        $craneofacial                  = $request->get('craneofacial');
        $facial                        = $request->get('facial');
        $convexividad                  = $request->get('convexividad');
        $atm                           = $request->get('atm');
        $labios                        = $request->get('txtLabios');
        $carrillos                     = $request->get('txtCarrillos');
        $frenillos                     = $request->get('txtFrenillos');
        $paladar                       = $request->get('txtPaladar');
        $lengua                        = $request->get('txtLengua');
        $pisoBoca                      = $request->get('txtPisoBoca');
        $parodonto                     = $request->get('txtParodonto');
        $uvula                         = $request->get('txtUvula');
        $orofaringe                    = $request->get('txtOrofaringe');
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
        $medidaMordidaBordeABorde      = $request->get('medidaMordida');
        $sobremordidaVertical          = $request->get('sobremordidaVertical') === 'on' ? true : false;
        $medidaSobremordidaVertical    = $request->get('medidaSobremordidaVertical');
        $sobremordidaHorizontal        = $request->get('sobremordidaHorizontal') === 'on' ? true : false;
        $medidaSobremordidaHorizontal  = $request->get('medidaSobremordidaHorizontal');
        $mordidaAbiertaAnterior        = $request->get('mordidaAbiertaAnterior') === 'on' ? true : false;
        $medidaMordidaAbierta          = $request->get('medidaMordidaAbierta');
        $mordidaCruzadaAnterior        = $request->get('mordidaCruzadaAnterior') === 'on' ? true : false;
        $medidaMordidaCruzadaAnterior  = $request->get('medidaMordidaCruzadaAnterior');
        $mordidaCruzadaPosterior       = $request->get('mordidaCruzadaPosterior') === 'on' ? true : false;
        $medidaMordidaCruzadaPosterior = $request->get('medidaMordidaCruzadaPosterior');
        $lineaMediaDental              = $request->get('lineaMediaDental') === 'on' ? true : false;
        $medidaLineaMediaDental        = $request->get('medidaLineaMediaDental');
        $lineaMediaEsqueletica         = $request->get('lineaMediaEsqueletica') === 'on' ? true : false;
        $medidaLineaMediaEsqueletica   = $request->get('medidaLineaMediaEsqueletica');
        $alteracionTamanio             = $request->get('alteracionTamanio') === 'on' ? true : false;
        $medidaAlteracionTamanio       = $request->get('medidaAlteracionTamanio');
        $alteracionForma               = $request->get('alteracionForma') === 'on' ? true : false;
        $medidaAlteracionForma         = $request->get('medidaAlteracionForma');
        $alteracionNumero              = $request->get('alteracionNumero') === 'on' ? true : false;
        $medidaAlteracionNumero        = $request->get('medidaAlteracionNumero');
        $alteracionEstructura          = $request->get('alteracionEstructura') === 'on' ? true : false;
        $medidaAlteracionEstructura    = $request->get('medidaAlteracionEstructura');
        $alteracionTextura             = $request->get('alteracionTextura') === 'on' ? true : false;
        $medidaAlteracionTextura       = $request->get('medidaAlteracionTextura');
        $alteracionColor               = $request->get('alteracionColor') === 'on' ? true : false;
        $medidaAlteracionColor         = $request->get('medidaAlteracionColor');

        // setear a paciente johanna
        $paciente->setMorfologiaCraneofacial(new MorfologiaCraneofacial($craneofacial));
        $paciente->setMorfologiaFacial(new MorfologiaFacial($facial));
        $paciente->setConvexividadFacial(new ConvexividadFacial($convexividad));
        $paciente->setATM(new ATM($atm));
        $paciente->setLabios($labios);
        $paciente->setCarrillos($carrillos);
        $paciente->setFrenillos($frenillos);
        $paciente->setPaladar($paladar);
        $paciente->setLengua($lengua);
        $paciente->setPisoDeBoca($pisoBoca);
        $paciente->setParodonto($parodonto);
        $paciente->setUvula($uvula);
        $paciente->setOrofaringe($orofaringe);
        $paciente->setTipoArcoI($arcoI);
        $paciente->setEscalonMesialDerecho($mesialDerecho);
        $paciente->setEscalonMesialIzquierdo($mesialIzquierdo);
        $paciente->setEscalonDistalDerecho($distalDerecho);
        $paciente->setEscalonDistalIzquierdo($distalIzquierdo);
        $paciente->setEscalonRectoDerecho($rectoDerecho);
        $paciente->setEscalonRectoIzquierdo($rectoIzquierdo);
        $paciente->setMesialExageradoDerecho($exageradoDerecho);
        $paciente->setMesialExageradoIzquierdo($exageradoIzquierdo);
        $paciente->setNoDeterminadoDerecho($noDeterminadoDerecho);
        $paciente->setNoDeterminadoIzquierdo($noDeterminadoIzquierdo);
        $paciente->setRelacionCaninaDerecha($caninaDerecho);
        $paciente->setRelacionCaninaIzquierda($caninaIzquierdo);
        $paciente->setRelacionMolarDerechaI($relacionMolarDerechoI);
        $paciente->setRelacionMolarDerechaII($relacionMolarDerechoII);
        $paciente->setRelacionMolarDerechaIII($relacionMolarDerechoIII);
        $paciente->setRelacionMolarIzquierdaI($relacionMolarIzquierdoI);
        $paciente->setRelacionMolarIzquierdaII($relacionMolarIzquierdoII);
        $paciente->setRelacionMolarIzquierdaIII($relacionMolarIzquierdoIII);
        $paciente->setRelacionCaninaDerechaI($relacionCaninaDerechoI);
        $paciente->setRelacionCaninaDerechaII($relacionCaninaDerechoII);
        $paciente->setRelacionCaninaDerechaIII($relacionCaninaDerechoIII);
        $paciente->setRelacionCaninaIzquierdaI($relacionCaninaIzquierdoI);
        $paciente->setRelacionCaninaIzquierdaII($relacionCaninaIzquierdoII);
        $paciente->setRelacionCaninaIzquierdaIII($relacionCaninaIzquierdoIII);
        $paciente->setMordidaBordeBorde($mordidaBordeBorde);
        $paciente->setMedidaBordeBorde($medidaMordidaBordeABorde);
        $paciente->setSobremordidaVertical($sobremordidaVertical);
        $paciente->setMedidaSobremordidaVertical($medidaSobremordidaVertical);
        $paciente->setSobremordidaHorizontal($sobremordidaHorizontal);
        $paciente->setMedidaSobremordidaHorizontal($medidaSobremordidaHorizontal);
        $paciente->setMordidaAbiertaAnterior($mordidaAbiertaAnterior);
        $paciente->setMedidaMordidaAbiertaAnterior($medidaMordidaAbierta);
        $paciente->setMordidaCruzadaAnterior($mordidaCruzadaAnterior);
        $paciente->setMedidaMordidaCruzadaAnterior($medidaMordidaCruzadaAnterior);
        $paciente->setMordidaCruzadaPosterior($mordidaCruzadaPosterior);
        $paciente->setMedidaMordidaCruzadaPosterior($medidaMordidaCruzadaPosterior);
        $paciente->setLineaMediaDental($lineaMediaDental);
        $paciente->setMedidaLineaMediaDental($medidaLineaMediaDental);
        $paciente->setLineaMediaEsqueletica($lineaMediaEsqueletica);
        $paciente->setMedidaLineaMediaEsqueletica($medidaLineaMediaEsqueletica);
        $paciente->setAlteracionesTamanio($alteracionTamanio);
        $paciente->setMedidaAlteracionesTamanio($medidaAlteracionTamanio);
        $paciente->setAlteracionesForma($alteracionForma);
        $paciente->setMedidaAlteracionesForma($medidaAlteracionForma);
        $paciente->setAlteracionesNumero($alteracionNumero);
        $paciente->setMedidaAlteracionesNumero($medidaAlteracionNumero);
        $paciente->setAlteracionesEstructura($alteracionEstructura);
        $paciente->setMedidaAlteracionesEstructura($medidaAlteracionEstructura);
        $paciente->setAlteracionesTextura($alteracionTextura);
        $paciente->setMedidaAlteracionesTextura($medidaAlteracionTextura);
        $paciente->setAlteracionesColor($alteracionColor);
        $paciente->setMedidaAlteracionesColor($medidaAlteracionColor);

        // persistir datos de paciente
        return $this->pacientesRepositorio->completarDatos($paciente);
    }
}