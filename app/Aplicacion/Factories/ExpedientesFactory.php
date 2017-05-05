<?php
namespace Siacme\Aplicacion\Factories;

use DateTime;
use Illuminate\Http\Request;
use LaravelDoctrine\ORM\Facades\EntityManager;
use Siacme\Aplicacion\ColeccionArray;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Expedientes\ExpedienteJohanna;
use Siacme\Dominio\Expedientes\Padecimiento;
use Siacme\Dominio\Pacientes\Domicilio;
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
    /**
     * @param Usuario $medico
     * @param Paciente $paciente
     * @param Request $request
     * @return mixed|Expediente
     */
    public static function create(Usuario $medico, Paciente $paciente, Request $request)
    {
        $expediente = self::crearExpediente($request, $paciente);

        switch ($medico->getId()) {
            case Usuario::JOHANNA:
                $nombrePadre               = $request->get('nombrePadre');
                $nombreMadre               = $request->get('nombreMadre');
                $ocupacionPadre            = $request->get('ocupacionPadre');
                $ocupacionMadre            = $request->get('ocupacionMadre');
                $dolorBoca                 = !is_null($request->get('dolorBoca')) ? true : false;
                $sangradoEncias            = !is_null($request->get('sangradoEncias')) ? true : false;
                $malOlor                   = !is_null($request->get('malOlor')) ? true : false;
                $dienteFlojo               = !is_null($request->get('dienteFlojo')) ? true : false;
                $primeraVisita             = $request->has('primeraVisita') && $request->get('primeraVisita') === 'on' ? true : false;
                $fechaUltimoExamen         = $request->has('primeraVisita') && $request->get('primeraVisita') === 'on' ? null : DateTime::createFromFormat('Y-m-d', $request->get('fechaUltimoExamen'));
                $motivoUltimoExamen        = $request->has('primeraVisita') && $request->get('primeraVisita') === 'on' ? '' : $request->get('motivoUltimoExamen');
                $anestesico                = $request->has('anestesico') && $request->get('anestesico') === 'on' ? true : false;
                $malaReaccion              = $request->get('malaReaccion') === '1' ? true : false;
                $queReaccion               = $request->get('queReaccion');
                $traumatismo               = $request->get('traumatismo');
                $tipoCepillo               = $request->has('tipoCepillo') ? $request->get('tipoCepillo') : null;
                $marcaPasta                = $request->has('marcaPasta') ? $request->get('marcaPasta') : null;
                $vecesCepilla              = $request->has('vecesCepilla') ? $request->get('vecesCepilla') : null;
                $edadErupcionaPrimerDiente = $request->get('edadErupcionaPrimerDiente');
                $ayudaAlCepillarse         = $request->has('ayudaAlCepillarse') && $request->get('ayudaAlCepillarse') === 'on' ? true : false;
                $vecesCome                 = $request->has('vecesCome') ? $request->get('vecesCome') : null;
                $especifiqueAuxiliar       = $request->get('especifiqueAuxiliar');
                $hiloDental                = !is_null($request->get('hiloDental')) ? true : false;
                $enjuagueBucal             = !is_null($request->get('enjuagueBucal')) ? true : false;
                $limpiadorLingual          = !is_null($request->get('limpiadorLingual')) ? true : false;
                $tabletasReveladoras       = !is_null($request->get('tabletasReveladoras')) ? true : false;
                $otroAuxiliar              = !is_null($request->get('otroAuxiliar')) ? true : false;
                $succionDigital            = !is_null($request->get('succionDigital')) ? true : false;
                $succionLingual            = !is_null($request->get('succionLingual')) ? true : false;
                $biberon                   = !is_null($request->get('biberon')) ? true : false;
                $bruxismo                  = !is_null($request->get('bruxismo')) ? true : false;
                $succionLabial             = !is_null($request->get('succionLabial')) ? true : false;
                $respiracionBucal          = !is_null($request->get('respiracionBucal')) ? true : false;
                $onicofagia                = !is_null($request->get('onicofagia')) ? true : false;
                $chupon                    = !is_null($request->get('chupon')) ? true : false;
                $otroHabito                = !is_null($request->get('otroHabito')) ? true : false;
                $especifiqueHabito         = $request->get('especifiqueHabito');

                // crear expediente y detalle - odontograma - planes tratamiento
                $expedienteJohanna = new ExpedienteJohanna(new ColeccionArray(), new ColeccionArray());
                $expedienteJohanna->agregarDatosPersonales($nombrePadre, $ocupacionPadre, $nombreMadre, $ocupacionMadre);
                $expedienteJohanna->agregarAntecedentesOdontopatologicos($dolorBoca, $sangradoEncias, $malOlor, $dienteFlojo);
                $expedienteJohanna->agregarAntecedentesNoPatologicos($primeraVisita, $fechaUltimoExamen, $motivoUltimoExamen, $anestesico, $malaReaccion, $queReaccion, $traumatismo);
                $expedienteJohanna->agregarHigieneBucodental($tipoCepillo, $marcaPasta, $vecesCepilla, $edadErupcionaPrimerDiente, $ayudaAlCepillarse, $vecesCome, $hiloDental, $enjuagueBucal, $limpiadorLingual, $tabletasReveladoras, $otroAuxiliar, $especifiqueAuxiliar);
                $expedienteJohanna->agregarHabitosOrales($succionDigital, $succionLingual, $biberon, $bruxismo, $succionLabial, $respiracionBucal, $onicofagia, $chupon, $otroHabito, $especifiqueHabito);
                $expediente->generarPara($expedienteJohanna);
                break;
        }

        return $expediente;
    }

    /**
     * @param Request $request
     * @param Paciente $paciente
     * @return mixed|Expediente
     */
    private static function crearExpediente(Request $request, Paciente $paciente)
    {
        $expediente = $request->session()->has('expediente') ? $request->session()->get('expediente') : new Expediente($paciente, new ColeccionArray(), new ColeccionArray(), new ColeccionArray(), new ColeccionArray());

        $fotoCapturada               = $request->get('capturada');
        $nombre                      = $request->get('nombre');
        $paterno                     = $request->get('paterno');
        $materno                     = $request->get('materno');
        $fechaNacimiento             = strlen($request->get('fechaNacimiento')) ? DateTime::createFromFormat('Y-m-d', $request->get('fechaNacimiento')) : new DateTime();
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
        $vivePadre                   = $request->get('vivePadre') === '2' ? false : true;
        $causaMuertePadre            = $request->get('causaMuertePadre');
        $enfermedadesPadre           = $request->get('enfermedadesPadre');
        $enfermedadesAbuelosPaternos = $request->get('enfermedadesAbuelosPaternos');
        $enfermedadesAbuelosMaternos = $request->get('enfermedadesAbuelosMaternos');
        $numHermanos                 = (int)$request->get('numHermanos');
        $numHermanosVivos            = (int)$request->get('numHermanosVivos');
        $enfermedadesHermanos        = $request->get('enfermedadesHermanos');
        $nombresEdades               = $request->get('nombresEdades');
        $especifiqueFractura         = $request->get('especifiqueFractura');
        $especifiqueCirugia          = $request->get('especifiqueCirugia');
        $especifiqueHospitalizado    = $request->get('especifiqueHospitalizado');
        $especifiqueTratamiento      = $request->get('especifiqueTratamiento');
        $listaPadecimientos          = null;

        if($request->has('padecimiento')) {
            foreach ($request->get('padecimiento') as $padecimientos) {
                $padecimiento = EntityManager::find(Padecimiento::class, (int)$padecimientos);
                $expediente->asignarPadecimientos($padecimiento);
            }
        }

        $moretones     = !is_null($request->get('moretones'))     ? true : false;
        $transfusion   = !is_null($request->get('transfusion'))   ? true : false;
        $fracturas     = !is_null($request->get('fracturas'))     ? true : false;
        $cirugia       = !is_null($request->get('cirugias'))       ? true : false;
        $hospitalizado = !is_null($request->get('hospitalizado')) ? true : false;
        $tratamiento   = !is_null($request->get('tratamiento'))   ? true : false;

        // completando los datos en las entidades correspondientes
        $domicilio = new Domicilio($direccion, $cp, $municipio);
        $expediente->getPaciente()->agregarDatosPersonales($nombre, $paterno, $materno, $fechaNacimiento, $lugarNacimiento, $telefono, $celular, $email, $domicilio);
        $expediente->agregarDatosPersonales($pediatra, $quienRecomienda, $motivoConsulta, $historiaEnfermedad, $automedicado, $conQueHaAutomedicado, $alergico, $aCualEsAlergico);
        $expediente->agregarAntecedentesHeredofamiliares($viveMadre, $causaMuerteMadre, $enfermedadesMadre, $vivePadre, $causaMuertePadre, $enfermedadesPadre, $enfermedadesAbuelosPaternos, $enfermedadesAbuelosMaternos, $numHermanos, $numHermanosVivos, $enfermedadesHermanos, $nombresEdades);
        $expediente->agregarAntecedentesPatologicos($moretones, $transfusion, $fracturas, $cirugia, $hospitalizado, $tratamiento, $especifiqueFractura, $especifiqueCirugia, $especifiqueHospitalizado, $especifiqueTratamiento);

        return $expediente;
    }
}
