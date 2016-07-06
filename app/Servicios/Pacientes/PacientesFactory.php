<?php
namespace Siacme\Servicios\Pacientes;

use Illuminate\Http\Request;
use Siacme\Dominio\Pacientes\Paciente;
use Siacme\Dominio\Pacientes\ATM;
use Siacme\Dominio\Pacientes\ComportamientoFrankl;
use Siacme\Dominio\Pacientes\ComportamientoInicial;
use Siacme\Dominio\Pacientes\ConvexividadFacial;
use Siacme\Dominio\Pacientes\FotografiaPaciente;
use Siacme\Dominio\Pacientes\MorfologiaCraneofacial;
use Siacme\Dominio\Pacientes\MorfologiaFacial;
use Siacme\Dominio\Pacientes\MarcaPasta;
use Siacme\Dominio\Pacientes\TrastornoLenguaje;
use Siacme\Dominio\Usuarios\Usuario;
use Siacme\Dominio\Pacientes\PacienteJohanna;

class PacientesFactory
{
    /**
     * crear nuevo paciente
     * @param Usuario $medico
     * @return PacienteJohanna|PacienteRigoberto
     */
    public static function crear(Usuario $medico)
    {
        switch($medico->getUsername()) {
            case 'johanna.vazquez':
                return new PacienteJohanna();

            case 'rigoberto.garcia':
                return new PacientesRepositorioRigobertoLaravelMysql();

            default:
                throw new \InvalidArgumentException('Médico inválido');
        }
    }

    /**
     * alimentar a Paciente con los parámetros enviados mediante Post
     * @param Request  $request
     * @param Paciente $paciente
     * @param Usuario  $medico
     */
    public static function alimentarDeHttp(Request $request, Paciente $paciente, Usuario $medico)
    {
        $fotoCapturada                  = $request->get('capturada');
        $txtNombre                      = $request->get('txtNombre');
        $txtPaterno                     = $request->get('txtPaterno');
        $txtMaterno                     = $request->get('txtMaterno');
        $txtFechaNac                    = $request->get('txtFechaNac');
        $txtEdad                        = $request->get('txtEdad');
        $txtLugarNac                    = $request->get('txtLugarNac');

        $txtPediatra                    = $request->get('txtPediatra');
        $txtRecomienda                  = $request->get('txtRecomienda');
        $txtMotivoConsulta              = $request->get('txtMotivoConsulta');
        $txtHistoriaEnfermedad          = $request->get('txtHistoriaEnfermedad');
        $txtDireccion                   = $request->get('txtDireccion');
        $txtCP                          = $request->get('txtCP');
        $txtMunicipio                   = $request->get('txtMunicipio');
        $txtTelefono                    = $request->get('txtTelefono');
        $txtCelular                     = $request->get('txtCelular');
        $txtEmail                       = $request->get('txtEmail');
        $haAutomedicado                 = $request->get('automedicado') === '2' ? 0 : 1;
        $txtConQueHaAutomedicado        = $request->get('txtConQueHaAutomedicado');
        $esAlergico                     = $request->get('alergico') === '2' ? 0 : 1;
        $aCualEsAlergico                = $request->get('txtACualEsAlergico');

        $viveMadre                      = $request->get('viveMadre') === '2' ? 0 : 1;
        $txtCausaMuerteMadre            = $request->get('txtCausaMuerteMadre');
        $txtEnfermedadesMadre           = $request->get('txtEnfermedadesMadre');
        $vivePadre                      = $request->get('vivePadre') === '2' ? 0 : 1;
        $txtCausaMuertePadre            = $request->get('txtCausaMuertePadre');
        $txtEnfermedadesPadre           = $request->get('txtEnfermedadesPadre');
        $txtEnfermedadesAbuelosPaternos = $request->get('txtEnfermedadesAbuelosPaternos');
        $txtEnfermedadesAbuelosMaternos = $request->get('txtEnfermedadesAbuelosMaternos');
        $txtNumHermanos                 = $request->get('txtNumHermanos');
        $txtNumHermanosVivos            = $request->get('txtNumHermanosVivos');
        $txtNumHermanosFinados          = $request->get('txtNumHermanosFinados');
        $txtEnfermedadesHermanos        = $request->get('txtEnfermedadesHermanos');

        $txtFractura                    = $request->get('txtFractura');
        $txtCirugia                     = $request->get('txtCirugia');
        $txtHospitalizado               = $request->get('txtHospitalizado');
        $txtTratamiento                 = $request->get('txtTratamiento');

        $listaPadecimientos 			= null;

        if(!is_null($request->get('padecimiento'))) {
            foreach ($request->get('padecimiento') as $padecimientos) {
                $listaPadecimientos[] = new Padecimiento($padecimientos);
            }
        }

        !is_null($request->get('moretones'))     ? $moretones     = 1 : $moretones     = 0;
        !is_null($request->get('transfusion'))   ? $transfusion   = 1 : $transfusion   = 0;
        !is_null($request->get('fracturas'))     ? $fracturas     = 1 : $fracturas     = 0;
        !is_null($request->get('cirugia'))       ? $cirugia       = 1 : $cirugia       = 0;
        !is_null($request->get('hospitalizado')) ? $hospitalizado = 1 : $hospitalizado = 0;
        !is_null($request->get('exFumador'))     ? $exFumador     = 1 : $exFumador     = 0;
        !is_null($request->get('exAlcoholico'))  ? $exAlcoholico  = 1 : $exAlcoholico  = 0;
        !is_null($request->get('exAdicto'))      ? $exAdicto      = 1 : $exAdicto      = 0;
        !is_null($request->get('tratamiento'))   ? $tratamiento   = 1 : $tratamiento   = 0;

        // datos básicos
        $paciente->setNombre($txtNombre);
        $paciente->setPaterno($txtPaterno);
        $paciente->setMaterno($txtMaterno);
        $paciente->setFechaNacimiento($txtFechaNac);
        $paciente->setEdadAnios($txtEdad);
        $paciente->setLugarNacimiento($txtLugarNac);
        $paciente->setNombrePediatra($txtPediatra);
        $paciente->setNombreRecomienda($txtRecomienda);
        $paciente->setMotivoConsulta($txtMotivoConsulta);
        $paciente->setHistoriaEnfermedad($txtHistoriaEnfermedad);
        $paciente->setDireccion($txtDireccion);
        $paciente->setCP($txtCP);
        $paciente->setMunicipio($txtMunicipio);
        $paciente->setTelefono($txtTelefono);
        $paciente->setCelular($txtCelular);
        $paciente->setEmail($txtEmail);
        $paciente->setSeHaAutomedicado($haAutomedicado);
        $paciente->setConQueSeHaAutomedicado($txtConQueHaAutomedicado);
        $paciente->setEsAlergico($esAlergico);
        $paciente->setAQueMedicamentoEsAlergico($aCualEsAlergico);

        $paciente->setViveMadre($viveMadre);
        $paciente->setCausaMuerteMadre($txtCausaMuerteMadre);
        $paciente->setEnfermedadesMadre($txtEnfermedadesMadre);
        $paciente->setVivePadre($vivePadre);
        $paciente->setCausaMuertePadre($txtCausaMuertePadre);
        $paciente->setEnfermedadesPadre($txtEnfermedadesPadre);
        $paciente->setNumHermanos($txtNumHermanos);
        $paciente->setNumHermanosVivos($txtNumHermanosVivos);
        $paciente->setNumHermanosFinados($txtNumHermanosFinados);

        $paciente->setEnfermedadesHermanos($txtEnfermedadesHermanos);
        $paciente->setEnfermedadesAbuelosPaternos($txtEnfermedadesAbuelosPaternos);
        $paciente->setEnfermedadesAbuelosMaternos($txtEnfermedadesAbuelosMaternos);

        $paciente->setSeLeHacenMoretones($moretones);
        $paciente->setHaRequeridoTransfusion($transfusion);
        $paciente->setHaTenidoFracturas($fracturas);
        $paciente->setHaSidoIntervenido($cirugia);
        $paciente->setHaSidoHospitalizado($hospitalizado);
        $paciente->setExFumador($exFumador);
        $paciente->setExAlcoholico($exAlcoholico);
        $paciente->setExAdicto($exAdicto);
        $paciente->setEstaBajoTratamiento($tratamiento);

        $paciente->setEspecifiqueFracturas($txtFractura);
        $paciente->setEspecifiqueIntervencion($txtCirugia);
        $paciente->setEspecifiqueHospitalizacion($txtHospitalizado);
        $paciente->setEspecifiqueTratamiento($txtTratamiento);
        $paciente->setListaPadecimientos($listaPadecimientos);

        // campos específicos
        self::alimentarPacienteDetalle($request, $paciente, $medico);

        // guardar foto de paciente
        if($fotoCapturada === '1') {
            // var_dump($fotografia);exit;
            $url   = $request->get('foto');
            // foto temporal
            $fotografia = new FotografiaPaciente($url);

            // renombrar foto y adjuntar a la carpeta de fotos
            $fotografia->guardar($paciente->getId());
        }
    }

    /**
     * @param Request  $request
     * @param Paciente $paciente
     * @param Usuario  $medico
     */
    private static function alimentarPacienteDetalle(Request $request, Paciente $paciente, Usuario $medico)
    {
        switch($medico->getUsername()) {
            case 'johanna.vazquez':
                $marca                     = new MarcaPasta();
                $trastorno 				   = new TrastornoLenguaje();

                $txtNombrePadre            = $request->get('txtNombrePadre');
                $txtNombreMadre            = $request->get('txtNombreMadre');
                $txtOcupacionPadre         = $request->get('txtOcupacionPadre');
                $txtOcupacionMadre         = $request->get('txtOcupacionMadre');
                $txtNombresEdades          = $request->get('txtNombresEdades');

                !is_null($request->get('trastorno')) ? $trastornoLenguaje = $request->get('trastorno') : $trastornoLenguaje = 1;

                !is_null($request->get('dolorBoca'))     ? $dolorBoca     = 1 : $dolorBoca     = 0;
                !is_null($request->get('sangradoEncias'))? $sangradoEncias= 1 : $sangradoEncias= 0;
                !is_null($request->get('malOlor'))       ? $malOlor       = 1 : $malOlor       = 0;
                !is_null($request->get('dienteFlojo'))   ? $dienteFlojo   = 1 : $dienteFlojo   = 0;

                $primeraVisita         	   = $request->get('primeraVisita') === '2' ? 0 : 1;
                $txtFechaUltimoExamen  	   = $request->get('txtFechaUltimoExamen');
                $txtMotivoUltimoExamen     = $request->get('txtMotivoUltimoExamen');
                $anestesico                = $request->get('anestesico') === '2' ? 0 : 1;
                $malaReaccion              = $request->get('malaReaccion') === '2' ? 0 : 1;
                $txtQueReaccion            = $request->get('txtQueReaccion');
                $txtTraumatismo            = $request->get('txtTraumatismo');

                $tipoCepillo                = $request->get('tipoCepillo');
                $marcaPasta                 = $request->get('marcaPasta');
                $vecesCepilla			    = $request->get('txtVecesCepilla');
                $txtEdadErupcionDiente      = $request->get('txtEdadErupcionaPrimerDiente');
                $ayudaAlCepillarse          = $request->get('ayudaAlCepillarse') === '2' ? 1 : 0;
                $txtVecesComeDia            = $request->get('txtVecesCome');
                $txtEspecifiqueAuxiliar     = $request->get('txtEspecifiqueAuxiliar');

                !is_null($request->get('hiloDental'))          ? $hiloDental          = 1 : $hiloDental          = 0;
                !is_null($request->get('enjuagueBucal'))       ? $enjuagueBucal       = 1 : $enjuagueBucal       = 0;
                !is_null($request->get('limpiadorLingual'))    ? $limpiadorLingual    = 1 : $limpiadorLingual    = 0;
                !is_null($request->get('tabletasReveladoras')) ? $tabletasReveladoras = 1 : $tabletasReveladoras = 0;
                !is_null($request->get('otroAuxiliar'))        ? $otroAuxiliar        = 1 : $otroAuxiliar        = 0;

                !is_null($request->get('succionDigital'))   ? $succionDigital   = 1 : $succionDigital   = 0;
                !is_null($request->get('succionLingual'))   ? $succionLingual   = 1 : $succionLingual   = 0;
                !is_null($request->get('biberon'))          ? $biberon          = 1 : $biberon          = 0;
                !is_null($request->get('bruxismo'))         ? $bruxismo         = 1 : $bruxismo         = 0;
                !is_null($request->get('succionLabial'))    ? $succionLabial    = 1 : $succionLabial    = 0;
                !is_null($request->get('respiracionBucal')) ? $respiracionBucal = 1 : $respiracionBucal = 0;
                !is_null($request->get('onicofagia'))       ? $onicofagia       = 1 : $onicofagia       = 0;
                !is_null($request->get('chupon'))           ? $chupon           = 1 : $chupon           = 0;
                !is_null($request->get('otroHabito'))       ? $otroHabito       = 1 : $otroHabito       = 0;

                $txtEspecifiqueHabito        = $request->get('txtEspecifiqueHabito');

                $paciente->setComportamientoInicial(new ComportamientoInicial(1));
                $paciente->setComportamientoFrankl(new ComportamientoFrankl(1));
                $paciente->setMorfologiaCraneofacial(new MorfologiaCraneofacial(1));
                $paciente->setMorfologiaFacial(new MorfologiaFacial(1));
                $paciente->setConvexividadFacial(new ConvexividadFacial(1));
                $paciente->setATM(new ATM(1));
                $paciente->setNombrePadre($txtNombrePadre);
                $paciente->setNombreMadre($txtNombreMadre);
                $paciente->setOcupacionPadre($txtOcupacionPadre);
                $paciente->setOcupacionMadre($txtOcupacionMadre);
                $paciente->setNombreEdadesHermanos($txtNombresEdades);

                $paciente->setHaPresentadoDolorBoca($dolorBoca);
                $paciente->setHaNotadoSangradoEncias($sangradoEncias);
                $paciente->setPresentaMalOlorBoca($malOlor);
                $paciente->setSienteDienteFlojo($dienteFlojo);

                $trastorno->setId($trastornoLenguaje);
                $paciente->setTrastornoLenguaje($trastorno);

                $paciente->setPrimeraVisitaDentista($primeraVisita);
                $paciente->setFechaUltimoExamenBucal($txtFechaUltimoExamen);
                $paciente->setMotivoVisitaDentista($txtMotivoUltimoExamen);
                $paciente->setLeHanColocadoAnestesico($anestesico);
                $paciente->setTuvoMalaReaccionAnestesico($malaReaccion);
                $paciente->setReaccionAnestesico($malaReaccion);
                $paciente->setTraumatismoBucal($txtTraumatismo);

                $paciente->setTipoCepilloAdulto($tipoCepillo);
                $marca->setId($marcaPasta);
                $paciente->setMarcaPasta($marca);
                $paciente->setVecesCepillaDiente($vecesCepilla);
                $paciente->setEdadErupcionoPrimerDiente($txtEdadErupcionDiente);
                $paciente->setAlguienAyudaACepillarse($ayudaAlCepillarse);
                $paciente->setVecesComeDia($txtVecesComeDia);
                $paciente->setHiloDental($hiloDental);
                $paciente->setEnjuagueBucal($enjuagueBucal);
                $paciente->setLimpiadorLingual($limpiadorLingual);
                $paciente->setTabletasReveladoras($tabletasReveladoras);
                $paciente->setOtroAuxiliar($otroAuxiliar);
                $paciente->setEspecifiqueAuxiliar($txtEspecifiqueAuxiliar);

                $paciente->setSuccionDigital($succionDigital);
                $paciente->setSuccionLingual($succionLingual);
                $paciente->setBiberon($biberon);
                $paciente->setBruxismo($bruxismo);
                $paciente->setSuccionLabial($succionLabial);
                $paciente->setRespiracionBucal($respiracionBucal);
                $paciente->setOnicofagia($onicofagia);
                $paciente->setChupon($chupon);
                $paciente->setOtroHabito($otroHabito);
                $paciente->setDescripcionHabito($txtEspecifiqueHabito);
                break;
        }
    }
}