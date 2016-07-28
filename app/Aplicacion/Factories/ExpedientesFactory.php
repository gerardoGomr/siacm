<?php
namespace Siacme\Aplicacion\Factories;

use Illuminate\Http\Request;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Expedientes\ExpedienteJohanna;
use Siacme\Dominio\Pacientes\Paciente;
use Siacme\Dominio\Usuarios\Usuario;

/**
 * Class ExpedientesFactory
 *
 * genera un expediente en base al id del médico enviado
 * @package Siacme\Aplicacion\Factories
 * @author Gerardo Adrián Gómez Ruiz
 * @version
 */
class ExpedientesFactory
{
    public static function create(Usuario $medico, Paciente $paciente, Request $request)
    {
        $expediente = self::crearExpediente($request);

        switch ($medico->getId()) {
            case Usuario::JOHANNA:
                $nombrePadre               = $request->get('nombrePadre');
                $nombreMadre               = $request->get('nombreMadre');
                $ocupacionPadre            = $request->get('ocupacionPadre');
                $ocupacionMadre            = $request->get('ocupacionMadre');
                $nombresEdades             = $request->get('nombresEdades');
                $dolorBoca                 = !is_null($request->get('dolorBoca')) ? true : false;
                $sangradoEncias            = !is_null($request->get('sangradoEncias')) ? true : false;
                $malOlor                   = !is_null($request->get('malOlor')) ? true : false;
                $dienteFlojo               = !is_null($request->get('dienteFlojo')) ? true : false;
                $primeraVisita             = $request->has('primeraVisita') && $request->get('primeraVisita') === 'on' ? true : false;
                $fechaUltimoExamen         = $request->get('fechaUltimoExamen');
                $motivoUltimoExamen        = $request->get('motivoUltimoExamen');
                $anestesico                = $request->has('anestesico') && $request->get('anestesico') === 'on' ? true : false;
                $malaReaccion              = $request->has('malaReaccion') && $request->get('malaReaccion') === 'on' ? true : false;
                $queReaccion               = $request->get('queReaccion');
                $traumatismo               = $request->get('traumatismo');
                $tipoCepillo               = $request->get('tipoCepillo');
                $marcaPasta                = $request->get('marcaPasta');
                $vecesCepilla              = $request->get('vecesCepilla');
                $edadErupcionaPrimerDiente = $request->get('edadErupcionaPrimerDiente');
                $ayudaAlCepillarse         = $request->has('ayudaAlCepillarse') && $request->get('ayudaAlCepillarse') === 'on' ? true : false;
                $vecesCome                 = $request->get('vecesCome');
                $especifiqueAuxiliar       = $request->get('especifiqueAuxiliar');

                $hiloDental          = !is_null($request->get('hiloDental')) ? true : false;
                $enjuagueBucal       = !is_null($request->get('enjuagueBucal')) ? true : false;
                $limpiadorLingual    = !is_null($request->get('limpiadorLingual')) ? true : false;
                $tabletasReveladoras = !is_null($request->get('tabletasReveladoras')) ? true : false;
                $otroAuxiliar        = !is_null($request->get('otroAuxiliar')) ? true : false;
                $succionDigital      = !is_null($request->get('succionDigital')) ? true : false;
                $succionLingual      = !is_null($request->get('succionLingual')) ? true : false;
                $biberon             = !is_null($request->get('biberon')) ? true : false;
                $bruxismo            = !is_null($request->get('bruxismo')) ? true : false;
                $succionLabial       = !is_null($request->get('succionLabial')) ? true : false;
                $respiracionBucal    = !is_null($request->get('respiracionBucal')) ? true : false;
                $onicofagia          = !is_null($request->get('onicofagia')) ? true : false;
                $chupon              = !is_null($request->get('chupon')) ? true : false;
                $otroHabito          = !is_null($request->get('otroHabito')) ? true : false;

                $txtEspecifiqueHabito        = $request->get('txtEspecifiqueHabito');
                // crear expediente y detalle
                $expedienteJohanna = new ExpedienteJohanna();

                $expediente = new Expediente();
                $expediente->generarNuevo($expedienteJohanna, $paciente, $medico);
                break;
        }
    }

    private static function crearExpediente(Request $request)
    {
        $fotoCapturada               = $request->get('capturada');
        $nombre                      = $request->get('nombre');
        $paterno                     = $request->get('paterno');
        $materno                     = $request->get('materno');
        $fechaNacimiento             = $request->get('fechaNacimiento');
        $edadAnios                   = (int)$request->get('edadAnios');
        $edadMeses                   = (int)$request->get('edadMeses');
        $lugarNacimiento             = $request->get('lugarNacimiento');
        $pediatra                    = $request->get('pediatra');
        $quienRecomienda             = $request->get('quienRecomienda');
        $motivoConsulta              = $request->get('motivoConsulta');
        $historiaEnfermedad          = $request->get('historiaEnfermedad');
        $direccion                   = $request->get('direccion');
        $cp                          = $request->get('cp');
        $municipio                   = $request->get('municipio');
        $telefono                    = $request->get('telefono');
        $celular                     = $request->get('celular');
        $email                       = $request->get('email');
        $automedicado                = $request->has('automedicado') && $request->get('automedicado') === 'on' ? true : false;
        $conQueHaAutomedicado        = $request->get('conQueHaAutomedicado');
        $alergico                    = $request->has('alergico') && $request->get('alergico') === 'on' ? true : false;
        $aCualEsAlergico             = $request->get('aCualEsAlergico');
        $viveMadre                   = $request->get('viveMadre') === '2' ? false : true;
        $causaMuerteMadre            = $request->get('causaMuerteMadre');
        $enfermedadesMadre           = $request->get('enfermedadesMadre');
        $vivePadre                   = $request->get('vivePadre') === '2' ? true : false;
        $causaMuertePadre            = $request->get('causaMuertePadre');
        $enfermedadesPadre           = $request->get('enfermedadesPadre');
        $enfermedadesAbuelosPaternos = $request->get('enfermedadesAbuelosPaternos');
        $enfermedadesAbuelosMaternos = $request->get('enfermedadesAbuelosMaternos');
        $numHermanos                 = (int)$request->get('numHermanos');
        $numHermanosVivos            = (int)$request->get('numHermanosVivos');
        $numHermanosFinados          = (int)$request->get('numHermanosFinados');
        $enfermedadesHermanos        = $request->get('enfermedadesHermanos');
        $especifiqueFractura         = $request->get('especifiqueFractura');
        $especifiqueCirugia          = $request->get('especifiqueCirugia');
        $especifiqueHospitalizado    = $request->get('especifiqueHospitalizado');
        $especifiqueTratamiento      = $request->get('especifiqueTratamiento');
        $listaPadecimientos          = null;

        /*if(!is_null($request->get('padecimiento'))) {
            foreach ($request->get('padecimiento') as $padecimientos) {
                $listaPadecimientos[] = new Padecimiento($padecimientos);
            }
        }*/

        $moretones     = !is_null($request->get('moretones'))     ? true : false;
        $transfusion   = !is_null($request->get('transfusion'))   ? true : false;
        $fracturas     = !is_null($request->get('fracturas'))     ? true : false;
        $cirugia       = !is_null($request->get('cirugia'))       ? true : false;
        $hospitalizado = !is_null($request->get('hospitalizado')) ? true : false;
        $tratamiento   = !is_null($request->get('tratamiento'))   ? true : false;

        return true;
    }
}