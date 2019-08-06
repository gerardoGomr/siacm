<?php
namespace Siacme\Aplicacion\Reportes\Expedientes;

use Siacme\Aplicacion\Fecha;
use Siacme\Aplicacion\Reportes\ReporteJohanna;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Expedientes\MarcaPasta;

/**
 * Class ExpedienteJohannaPDF
 * @package Siacme\Aplicacion\Reportes\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class ExpedienteJohannaPDF extends ReporteJohanna
{
    /**
     * @var Expediente
     */
    private $expediente;

    /**
     * ExpedienteJohannaPDF constructor.
     * @param Expediente $expediente
     */
    public function __construct(Expediente $expediente)
    {
        $this->expediente = $expediente;

        parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    }


    /**
     * generar el reporte
     * @return string
     */
    public function generar()
    {
        $html = '';
        $this->SetTitle('Expediente');
        $this->AddPage();
        $this->SetFont('dejavusans', '', 12);

        // sección superior para la foto y nombre del paciente
        if($this->expediente->tieneFoto()) {
            $this->Image($this->expediente->getFotografia()->getRuta(), 120, 60, 30);
        }

        $html .= '<h2>' . $this->expediente->getPaciente()->nombreCompleto() . '</h2>
            <p>' . $this->expediente->getPaciente()->edadCompleta() . '<br/><b>Vive en:</b> ' . $this->expediente->getPaciente()->getLugarNacimiento() . '<br/><b>Expediente:</b> ' . $this->expediente->getExpedienteEspecialidad()->numero() . '</p>';

        $this->WriteHTML($html, true);
        $this->Ln(20);

        $this->SetFont('dejavusans', '', 10);

        // sección datos personales
        $html = $this->generarDatosPersonales();
        $this->WriteHTML($html, true);
        $this->Ln(5);

        // sección antecedentes heredofamiliares
        $html = $this->generarAntecedentesPersonales();
        $this->WriteHTML($html, true);
        $this->Ln(5);

        // sección antecedentes patológicos
        $html = $this->generarAntecedentesPatologicos();
        $this->WriteHTML($html, true);
        $this->Ln(5);

        $html = $this->generarAntecedentesOdontopatologicos();
        $this->WriteHTML($html, true);
        $this->Ln(5);

        $html = $this->generarAntecedentesOdontalgicos();
        $this->WriteHTML($html, true);
        $this->Ln(5);

        $html = $this->generarHigieneBucodental();
        $this->WriteHTML($html, true);
        $this->Ln(5);

        $html = $this->generarHabitosOrales();
        $this->WriteHTML($html, true);
        $this->Ln(5);

        if ($this->expediente->tieneConsultas()) {
            $html = $this->generarDatosComplementarios();
            $this->WriteHTML($html, true, false, false, false, '');
        }

        $this->Ln(5);
        $this->SetFont('dejavusans', 'B', 12);
        $this->Cell(0, 5, 'Certifico la veracidad de los datos aportados.', false, true);
        $this->Cell(0, 5, 'Nombre y firma del padre o tutor:  ___________________________', false, true);

        $this->Output('Expediente', 'I');
    }

    /**
     * generar sección de datos personales
     * @return string
     */
    private function generarDatosPersonales()
    {
        $seHaAutomedicado = $this->expediente->seHaAutomedicado() ? 'Sí: ' . $this->expediente->getConQueSeHaAutomedicado() : '-';
        $esAlergico       = $this->expediente->esAlergico() ? $this->expediente->getAQueMedicamentoEsAlergico() : '-';
        $domicilio        = !is_null($this->expediente->getPaciente()->getDomicilio()) ? $this->expediente->getPaciente()->getDomicilio()->direccionCompleta() : '';

        $html = '<h3>Datos Personales</h3>
            <hr>
            <table>
                <tr>
                    <td width="150"><b>Nombre:</b></td>
                    <td>' . $this->expediente->getPaciente()->nombreCompleto() . '</td>
                </tr>
                <tr>
                    <td><b>Fecha nacimiento:</b></td>
                    <td>' . Fecha::convertir($this->expediente->getPaciente()->getFechaNacimiento()) . '</td>
                </tr>
                <tr>
                    <td><b>Edad:</b></td>
                    <td>' . $this->expediente->getPaciente()->edadCompleta() . '</td>
                </tr>
                <tr>
                    <td><b>Lugar nacimiento:</b></td>
                    <td>' . $this->expediente->getPaciente()->getLugarNacimiento() . '</td>
                </tr>
                <tr>
                    <td><b>Dirección:</b></td>
                    <td>' . $domicilio . '</td>
                </tr>
                <tr>
                    <td><b>Teléfono:</b></td>
                    <td>' . $this->expediente->getPaciente()->getTelefono() . '</td>
                </tr>
                <tr>
                    <td><b>Celular:</b></td>
                    <td>' . $this->expediente->getPaciente()->getCelular() . '</td>
                </tr>
                <tr>
                    <td><b>E-mail:</b></td>
                    <td>' . $this->expediente->getPaciente()->getEmail() . '</td>
                </tr>
                <tr>
                    <td><b>Se ha automedicado:</b></td>
                    <td>' . $seHaAutomedicado . '</td>
                </tr>
                <tr>
                    <td><b>Es alérgico:</b></td>
                    <td>' . $esAlergico . '</td>
                </tr>
                <tr>
                    <td><b>Padre:</b></td>
                    <td>' . $this->expediente->getExpedienteEspecialidad()->getNombrePadre() . ' -- ' . $this->expediente->getExpedienteEspecialidad()->getOcupacionPadre() . '</td>
                </tr>
                <tr>
                    <td><b>Madre:</b></td>
                    <td>' . $this->expediente->getExpedienteEspecialidad()->getNombreMadre() . ' -- ' . $this->expediente->getExpedienteEspecialidad()->getOcupacionMadre() . '</td>
                </tr>
                <tr>
                    <td><b>Nombre del pediatra:</b></td>
                    <td>' . $this->expediente->getNombrePediatra() . '</td>
                </tr>
                <tr>
                    <td><b>Quién recomienda:</b></td>
                    <td>' . $this->expediente->getNombreRecomienda() . '</td>
                </tr>
            </table>';

        return $html;
    }

    /**
     * generar sección de antecedentes personales
     * @return string
     */
    private function generarAntecedentesPersonales()
    {
        $viveMadre = !$this->expediente->viveMadre() ? 'Falleció por ' . $this->expediente->getCausaMuerteMadre() : 'Sí';
        $vivePadre = !$this->expediente->vivePadre() ? 'Falleció por ' . $this->expediente->getCausaMuertePadre() : 'Sí';

        $html = '<h3>Antecedentes heredofamiliares</h3>
            <hr>
            <table>
                <tr>
                    <td width="150"><b>Vive madre:</b></td>
                    <td>' . $viveMadre . '</td>
                </tr>
                <tr>
                    <td><b>Enfermedades madre:</b></td>
                    <td>' . $this->expediente->getEnfermedadesMadre() . '</td>
                </tr>
                <tr>
                    <td><b>Vive padre:</b></td>
                    <td>' . $vivePadre . '</td>
                </tr>
                <tr>
                    <td><b>Enfermedades padre:</b></td>
                    <td>' . $this->expediente->getEnfermedadesPadre() . '</td>
                </tr>
                <tr>
                    <td><b>Enfermedades abuelos paternos:</b></td>
                    <td>' . $this->expediente->getEnfermedadesAbuelosPaternos() . '</td>
                </tr>
                <tr>
                    <td><b>Enfermedades abuelos maternos:</b></td>
                    <td>' . $this->expediente->getEnfermedadesAbuelosMaternos() . '</td>
                </tr>
                <tr>
                    <td><b>Número de hermanos:</b></td>
                    <td>' . $this->expediente->getNumHermanos() . ', ' . $this->expediente->getNumHermanosVivos() . ' Vivos - ' . $this->expediente->getNumHermanosFinados() . ' Finados</td>
                </tr>
                <tr>
                    <td><b>Nombres y edades de hermanos:</b></td>
                    <td>' . $this->expediente->getNombresEdadesHermanos() . '</td>
                </tr>
                <tr>
                    <td><b>Número de hermanos:</b></td>
                    <td>' . $this->expediente->getEnfermedadesHermanos() . '</td>
                </tr>
            </table>';

        return $html;
    }

    /**
     * generar sección de antecedentes patológicos
     * @return string
     */
    private function generarAntecedentesPatologicos()
    {
        $padecimientosQueTiene  = '';
        $seLeHacenMoretones     = $this->expediente->seLeHacenMoretones() ? 'Sí' : 'No';
        $haRequeridoTransfusion = $this->expediente->haRequeridoTransfusion() ? 'Sí' : 'No';
        $haTenidoFracturas      = $this->expediente->haTenidoFracturas() ? 'Sí - ' . $this->expediente->getEspecifiqueFracturas() : 'No';
        $haSidoIntervenido      = $this->expediente->haSidoIntervenido() ? 'Sí - ' . $this->expediente->getEspecifiqueIntervencion() : 'No';
        $haSidoHospitalizado    = $this->expediente->haSidoHospitalizado() ? 'Sí - ' . $this->expediente->getEspecifiqueHospitalizacion() : 'No';
        $estaBajoTratamiento    = $this->expediente->estaBajoTratamiento() ? 'Sí - ' . $this->expediente->getEspecifiqueTratamiento() : 'No';

        if ($this->expediente->tienePadecimientos()) {
            $padecimientosQueTiene  = '<h4>Padecimientos:</h4><ul>';
            foreach ($this->expediente->getPadecimientos() as $padecimiento) {
                $padecimientosQueTiene .= '<li>' . $padecimiento->getPadecimiento() . '</li>';
            }

            $padecimientosQueTiene .= '</ul>';
        }

        $html = '<h3>Antecedentes personales patológicos</h3>
            <hr>
            ' . $padecimientosQueTiene . '
            <table>
                <tr>
                    <td width="150"><b>Se le hacen moretones:</b></td>
                    <td>' . $seLeHacenMoretones . '</td>
                </tr>
                <tr>
                    <td><b>Ha requerido transfusión sanguínea:</b></td>
                    <td>' . $haRequeridoTransfusion . '</td>
                </tr>
                <tr>
                    <td><b>Ha tenido fracturas:</b></td>
                    <td>' . $haTenidoFracturas . '</td>
                </tr>
                <tr>
                    <td><b>Ha sido intervenido quirúrgicamente:</b></td>
                    <td>' . $haSidoIntervenido . '</td>
                </tr>
                <tr>
                    <td><b>Ha sido hospitalizado:</b></td>
                    <td>' . $haSidoHospitalizado . '</td>
                </tr>
                <tr>
                    <td><b>Está bajo tratamiento:</b></td>
                    <td>' . $estaBajoTratamiento . '</td>
                </tr>
            </table>';

        return $html;
    }

    /**
     * generar sección de antecedentes odontopatológicos
     * @return string
     */
    private function generarAntecedentesOdontopatologicos()
    {
        $haPresentadoDolorBoca  = $this->expediente->getExpedienteEspecialidad()->haPresentadoDolorBoca() ? 'Sí' : 'No';
        $haNotadoSangradoEncias = $this->expediente->getExpedienteEspecialidad()->haNotadoSangradoEncias() ? 'Sí' : 'No';
        $presentaMalOlorBoca    = $this->expediente->getExpedienteEspecialidad()->presentaMalOlorBoca() ? 'Sí' : 'No';
        $sienteDienteFlojo      = $this->expediente->getExpedienteEspecialidad()->sienteDienteFlojo() ? 'Sí' : 'No';

        $html = '<h3>Antecedentes odontopatológicos</h3>
            <hr>
            <table>
                <tr>
                    <td width="150"><b>Ha presentado dolor de boca:</b></td>
                    <td>' . $haPresentadoDolorBoca . '</td>
                </tr>
                <tr>
                    <td><b>Ha notado sangrado de encías:</b></td>
                    <td>' . $haNotadoSangradoEncias . '</td>
                </tr>
                <tr>
                    <td><b>Presenta mal olor o sabor en la boca:</b></td>
                    <td>' . $presentaMalOlorBoca . '</td>
                </tr>
                <tr>
                    <td><b>Siente que algún diente está flojo:</b></td>
                    <td>' . $sienteDienteFlojo . '</td>
                </tr>
            </table>';

        return $html;
    }

    /**
     * generar sección de antecedentes odontálgicos no patológicos
     * @return string
     */
    private function generarAntecedentesOdontalgicos()
    {
        $primeraVisita           = $this->expediente->getExpedienteEspecialidad()->primeraVisitaDentista() ? 'Sí' : 'No';
        $fechaUltimoExamen       = !$this->expediente->getExpedienteEspecialidad()->primeraVisitaDentista() && $this->expediente->getExpedienteEspecialidad()->getFechaUltimoExamenBucal() !== '' ? Fecha::convertir($this->expediente->getExpedienteEspecialidad()->getFechaUltimoExamenBucal()) . ' - ' . $this->expediente->getExpedienteEspecialidad()->getMotivoVisitaDentista() : '-';
        $leHanColocadoAnestesico = $this->expediente->getExpedienteEspecialidad()->leHanColocadoAnestesico() ? 'Sí' : 'No';
        $tuvoMalaReaccion        = $this->expediente->getExpedienteEspecialidad()->leHanColocadoAnestesico() && $this->expediente->getExpedienteEspecialidad()->tuvoMalaReaccionAnestesico() ? 'Sí' : 'No';
        $queReaccionTuvo         = $this->expediente->getExpedienteEspecialidad()->leHanColocadoAnestesico() && $this->expediente->getExpedienteEspecialidad()->tuvoMalaReaccionAnestesico() ? $this->expediente->getExpedienteEspecialidad()->getReaccionAnestesico() : '-';
        $traumatismoBucal        = $this->expediente->getExpedienteEspecialidad()->getTraumatismoBucal() ?? '-';

        $html = '<h3>Antecedentes odontálgicos no patológicos</h3>
            <hr>
            <table>
                <tr>
                    <td width="150"><b>Primera visita al dentista:</b></td>
                    <td>' . $primeraVisita . '</td>
                </tr>
                <tr>
                    <td><b>Fecha del último examen bucal:</b></td>
                    <td>' . $fechaUltimoExamen . '</td>
                </tr>
                <tr>
                    <td><b>Le han colocado algún anestésico:</b></td>
                    <td>' . $leHanColocadoAnestesico . '</td>
                </tr>
                <tr>
                    <td><b>Tuvo mala reacción:</b></td>
                    <td>' . $tuvoMalaReaccion . '</td>
                </tr>
                <tr>
                    <td><b>Qué reacción tuvo:</b></td>
                    <td>' . $queReaccionTuvo . '</td>
                </tr>
                <tr>
                    <td><b>Traumatismo bucal:</b></td>
                    <td>' . $traumatismoBucal . '</td>
                </tr>
            </table>';

        return $html;
    }

    /**
     * generar sección de higiene bucodental
     * @return string
     */
    private function generarHigieneBucodental()
    {
        $tipoCepillo             = $this->expediente->getExpedienteEspecialidad()->getTipoCepillo() === 1 ? 'Adulto' : 'Infantil';
        $marcaPasta              = $this->expediente->getExpedienteEspecialidad()->getTipoCepillo() === MarcaPasta::INFANTIL ? 'Infantil' : 'Adulto';
        $alguienAyudaACepillarse = $this->expediente->getExpedienteEspecialidad()->alguienAyudaACepillarse() ? 'Sí' : 'No';
        $hiloDental              = $this->expediente->getExpedienteEspecialidad()->hiloDental() ? 'Sí' : 'No';
        $enjuagueBucal           = $this->expediente->getExpedienteEspecialidad()->enjuagueBucal() ? 'Sí' : 'No';
        $limpiadorLingual        = $this->expediente->getExpedienteEspecialidad()->limpiadorLingual() ? 'Sí' : 'No';
        $tabletasReveladoras     = $this->expediente->getExpedienteEspecialidad()->tabletasReveladoras() ? 'Sí' : 'No';
        $otroAuxiliar            = $this->expediente->getExpedienteEspecialidad()->otroAuxiliar() ? 'Sí - ' . $this->expediente->getExpedienteEspecialidad()->getEspecifiqueAuxiliar() : 'No';

        $html = '<h3>Higiene bucodental</h3>
            <hr>
            <table>
                <tr>
                    <td width="150"><b>Tipo de cepillo dental:</b></td>
                    <td>' . $tipoCepillo . '</td>
                </tr>
                <tr>
                    <td><b>Marca de pasta dental:</b></td>
                    <td>' . $marcaPasta . '</td>
                </tr>
                <tr>
                    <td><b>Veces que se cepillan los dientes:</b></td>
                    <td>' . $this->expediente->getExpedienteEspecialidad()->getVecesCepillaDiente() . ' veces</td>
                </tr>
                <tr>
                    <td><b>Edad erupcionó el primer diente:</b></td>
                    <td>' . $this->expediente->getExpedienteEspecialidad()->getEdadErupcionoPrimerDiente() . '</td>
                </tr>
                <tr>
                    <td><b>Alguién ayuda a cepillarse:</b></td>
                    <td>' . $alguienAyudaACepillarse . '</td>
                </tr>
                <tr>
                    <td><b>Veces que come al día:</b></td>
                    <td>' . $this->expediente->getExpedienteEspecialidad()->getVecesComeDia() . ' veces</td>
                </tr>
                <tr>
                    <td><b>Usa hilo dental:</b></td>
                    <td>' . $hiloDental . '</td>
                </tr>
                <tr>
                    <td><b>Usa enjuague bucal:</b></td>
                    <td>' . $enjuagueBucal . '</td>
                </tr>
                <tr>
                    <td><b>Usa limpiador lingual:</b></td>
                    <td>' . $limpiadorLingual . '</td>
                </tr>
                <tr>
                    <td><b>Usa tabletas reveladoras:</b></td>
                    <td>' . $tabletasReveladoras . '</td>
                </tr>
                <tr>
                    <td><b>Usa otro auxiliar:</b></td>
                    <td>' . $otroAuxiliar . '</td>
                </tr>
            </table>';

        return $html;
    }

    /**
     * generar sección de hábitos orales
     * @return string
     */
    private function generarHabitosOrales()
    {
        $succionDigital   = $this->expediente->getExpedienteEspecialidad()->succionDigital() ? 'Sí' : 'No';
        $succionLingual   = $this->expediente->getExpedienteEspecialidad()->succionLingual() ? 'Sí' : 'No';
        $biberon          = $this->expediente->getExpedienteEspecialidad()->biberon() ? 'Sí' : 'No';
        $bruxismo         = $this->expediente->getExpedienteEspecialidad()->bruxismo() ? 'Sí' : 'No';
        $succionLabial    = $this->expediente->getExpedienteEspecialidad()->succionLabial() ? 'Sí' : 'No';
        $respiracionBucal = $this->expediente->getExpedienteEspecialidad()->respiracionBucal() ? 'Sí' : 'No';
        $onicofagia       = $this->expediente->getExpedienteEspecialidad()->onicofagia() ? 'Sí' : 'No';
        $chupon           = $this->expediente->getExpedienteEspecialidad()->chupon() ? 'Sí' : 'No';
        $otroHabito       = $this->expediente->getExpedienteEspecialidad()->otroHabito() ? 'Sí - ' . $this->expediente->getExpedienteEspecialidad()->getDescripcionHabito() : 'No';

        $html = '<h3>Hábitos orales</h3>
            <hr>
            <table>
                <tr>
                    <td width="150"><b>Succión digital:</b></td>
                    <td>' . $succionDigital . '</td>
                </tr>
                <tr>
                    <td><b>Succión lingual:</b></td>
                    <td>' . $succionLingual . '</td>
                </tr>
                <tr>
                    <td><b>Usa biberón:</b></td>
                    <td>' . $biberon . '</td>
                </tr>
                <tr>
                    <td><b>Bruxismo:</b></td>
                    <td>' . $bruxismo . '</td>
                </tr>
                <tr>
                    <td><b>Succión labial:</b></td>
                    <td>' . $succionLabial . '</td>
                </tr>
                <tr>
                    <td><b>Respiración bucal:</b></td>
                    <td>' . $respiracionBucal . '</td>
                </tr>
                <tr>
                    <td><b>Onicofagia:</b></td>
                    <td>' . $onicofagia . '</td>
                </tr>
                <tr>
                    <td><b>Usa chupón:</b></td>
                    <td>' . $chupon . '</td>
                </tr>
                <tr>
                    <td><b>Otro hábito:</b></td>
                    <td>' . $otroHabito . '</td>
                </tr>
            </table>';

        return $html;
    }

    private function generarDatosComplementarios()
    {
        $escalonMesialDerecho         = $this->expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getEscalonMesial()->derecho() ? 'Sí' : 'No';
        $escalonMesialIzquierdo       = $this->expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getEscalonMesial()->izquierdo() ? 'Sí' : 'No';
        $escalonDistalDerecho         = $this->expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getEscalonDistal()->derecho() ? 'Sí' : 'No';
        $escalonDistalIzquierdo       = $this->expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getEscalonDistal()->izquierdo() ? 'Sí' : 'No';
        $escalonRectoDerecho          = $this->expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getEscalonRecto()->derecho() ? 'Sí' : 'No';
        $escalonRectoIzquierdo        = $this->expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getEscalonRecto()->izquierdo() ? 'Sí' : 'No';
        $mesialExageradoDerecho       = $this->expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getMesialExagerado()->derecho() ? 'Sí' : 'No';
        $mesialExageradoIzquierdo     = $this->expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getMesialExagerado()->izquierdo() ? 'Sí' : 'No';
        $mesialNoDeterminadoDerecho   = $this->expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getMesialNoDeterminado()->derecho() ? 'Sí' : 'No';
        $mesialNoDeterminadoIzquierdo = $this->expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getMesialNoDeterminado()->izquierdo() ? 'Sí' : 'No';
        $relacionCaninaDerecha        = $this->expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getRelacionCanina()->derecho() ? 'Sí' : 'No';
        $relacionCaninaIzquierda      = $this->expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getRelacionCanina()->izquierdo() ? 'Sí' : 'No';

        $relacionMolarDerechaI      = $this->expediente->getExpedienteEspecialidad()->getRelacionMolar()->derechaI() ? 'Sí' : 'No';
        $relacionMolarDerechaII     = $this->expediente->getExpedienteEspecialidad()->getRelacionMolar()->derechaII() ? 'Sí' : 'No';
        $relacionMolarDerechaIII    = $this->expediente->getExpedienteEspecialidad()->getRelacionMolar()->derechaIII() ? 'Sí' : 'No';
        $relacionMolarIzquierdaI    = $this->expediente->getExpedienteEspecialidad()->getRelacionMolar()->izquierdaI() ? 'Sí' : 'No';
        $relacionMolarIzquierdaII   = $this->expediente->getExpedienteEspecialidad()->getRelacionMolar()->izquierdaII() ? 'Sí' : 'No';
        $relacionMolarIzquierdaIII  = $this->expediente->getExpedienteEspecialidad()->getRelacionMolar()->izquierdaIII() ? 'Sí' : 'No';

        $relacionCaninaDerechaI     = $this->expediente->getExpedienteEspecialidad()->getRelacionCanina()->derechaI() ? 'Sí' : 'No';
        $relacionCaninaDerechaII    = $this->expediente->getExpedienteEspecialidad()->getRelacionCanina()->derechaII() ? 'Sí' : 'No';
        $relacionCaninaDerechaIII   = $this->expediente->getExpedienteEspecialidad()->getRelacionCanina()->derechaIII() ? 'Sí' : 'No';
        $relacionCaninaIzquierdaI   = $this->expediente->getExpedienteEspecialidad()->getRelacionCanina()->izquierdaI() ? 'Sí' : 'No';
        $relacionCaninaIzquierdaII  = $this->expediente->getExpedienteEspecialidad()->getRelacionCanina()->izquierdaII() ? 'Sí' : 'No';
        $relacionCaninaIzquierdaIII = $this->expediente->getExpedienteEspecialidad()->getRelacionCanina()->izquierdaIII() ? 'Sí' : 'No';

        $html = '<h3>Examen extraoral</h3>
            <hr>
            <table>
                <tr>
                    <td width="150"><b>Morfología craneofacial:</b></td>
                    <td>' . $this->expediente->getExpedienteEspecialidad()->getMorfologiaCraneofacial()->getMorfologiaCraneofacial() . '</td>
                </tr>
                <tr>
                    <td><b>Morfología facial:</b></td>
                    <td>' . $this->expediente->getExpedienteEspecialidad()->getMorfologiaFacial()->getMorfologiaFacial() . '</td>
                </tr>
                <tr>
                    <td><b>Convexividad facial:</b></td>
                    <td>' . $this->expediente->getExpedienteEspecialidad()->getConvexividadFacial()->getConvexividadFacial() . '</td>
                </tr>
                <tr>
                    <td><b>ATM:</b></td>
                    <td>' . $this->expediente->getExpedienteEspecialidad()->getATM()->getATM() . '</td>
                </tr>
            </table>
            <br>
            <h3>Examen intraoral</h3>
            <hr>
            <table>
                <tr>
                    <td width="150"><b>Labios:</b></td>
                    <td>' . $this->expediente->getExpedienteEspecialidad()->getExamenIntraoral()->getLabios() . '</td>
                </tr>
                <tr>
                    <td><b>Carrillos:</b></td>
                    <td>' . $this->expediente->getExpedienteEspecialidad()->getExamenIntraoral()->getCarrillos() . '</td>
                </tr>
                <tr>
                    <td><b>Frenillos:</b></td>
                    <td>' . $this->expediente->getExpedienteEspecialidad()->getExamenIntraoral()->getPaladar() . '</td>
                </tr>
                <tr>
                    <td><b>Lengua:</b></td>
                    <td>' . $this->expediente->getExpedienteEspecialidad()->getExamenIntraoral()->getLengua() . '</td>
                </tr>
                <tr>
                    <td><b>Piso de boca:</b></td>
                    <td>' . $this->expediente->getExpedienteEspecialidad()->getExamenIntraoral()->getPisoDeBoca() . '</td>
                </tr>
                <tr>
                    <td><b>Parodonto:</b></td>
                    <td>' . $this->expediente->getExpedienteEspecialidad()->getExamenIntraoral()->getParodonto() . '</td>
                </tr>
                <tr>
                    <td><b>Úvula:</b></td>
                    <td>' . $this->expediente->getExpedienteEspecialidad()->getExamenIntraoral()->getUvula() . '</td>
                </tr>
                <tr>
                    <td><b>Orofaringe:</b></td>
                    <td>' . $this->expediente->getExpedienteEspecialidad()->getExamenIntraoral()->getOrofaringe() . '</td>
                </tr>
            </table>
            <br>
            <h3>Tejidos duros</h3>
            <hr>
            <table>
                <tr>
                    <td width="150"><b>Tipo de arco:</b></td>
                    <td>' . $this->expediente->getExpedienteEspecialidad()->tipoArco() . '</td>
                </tr>
            </table>
            <br>
            <h4>Dentinción temporal</h4>
            <table cellspacing="0" cellpadding="2" border="1">
                <thead>
                    <tr>
                        <th><b>Planos terminales</b></th>
                        <th><b>Derecha</b></th>
                        <th><b>Izquierda</b></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><b>Escalon mesial</b></td>
                        <td>' . $escalonMesialDerecho . '</td>
                        <td>' . $escalonMesialIzquierdo . '</td>
                    </tr>
                    <tr>
                        <td><b>Escalon distal</b></td>
                        <td>' . $escalonMesialDerecho . '</td>
                        <td>' . $escalonMesialIzquierdo . '</td>
                    </tr>
                    <tr>
                        <td><b>Escalon recto</b></td>
                        <td>' . $escalonRectoDerecho . '</td>
                        <td>' . $escalonRectoIzquierdo . '</td>
                    </tr>
                    <tr>
                        <td><b>Mesial exagerado</b></td>
                        <td>' . $mesialExageradoDerecho . '</td>
                        <td>' . $mesialExageradoIzquierdo . '</td>
                    </tr>
                    <tr>
                        <td><b>No determinado</b></td>
                        <td>' . $mesialNoDeterminadoDerecho . '</td>
                        <td>' . $mesialNoDeterminadoIzquierdo . '</td>
                    </tr>
                    <tr>
                        <td><b>Relación canina</b></td>
                        <td>' . $relacionCaninaDerecha . '</td>
                        <td>' . $relacionCaninaIzquierda . '</td>
                    </tr>
                </tbody>
            </table>
            <br>
            <h4>Dentinción mixta o permanente</h4>
            <table cellspacing="0" cellpadding="1" border="1">
                <thead>
                    <tr>
                        <th rowspan="2">&nbsp;</th>
                        <th colspan="3"><b>Derecha</b></th>
                        <th colspan="3"><b>Izquierda</b></th>
                    </tr>
                    <tr>
                        <th><b>I</b></th>
                        <th><b>II</b></th>
                        <th><b>III</b></th>
                        <th><b>I</b></th>
                        <th><b>II</b></th>
                        <th><b>III</b></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><b>Relación molar</b></td>
                        <td>' . $relacionMolarDerechaI . '</td>
                        <td>' . $relacionMolarDerechaII . '</td>
                        <td>' . $relacionMolarDerechaIII . '</td>
                        <td>' . $relacionMolarIzquierdaI . '</td>
                        <td>' . $relacionMolarIzquierdaII . '</td>
                        <td>' . $relacionMolarIzquierdaIII . '</td>
                    </tr>
                    <tr>
                        <td><b>Relación molar</b></td>
                        <td>' . $relacionCaninaDerechaI . '</td>
                        <td>' . $relacionCaninaDerechaII . '</td>
                        <td>' . $relacionCaninaDerechaIII . '</td>
                        <td>' . $relacionCaninaIzquierdaI . '</td>
                        <td>' . $relacionCaninaIzquierdaII . '</td>
                        <td>' . $relacionCaninaIzquierdaIII . '</td>
                    </tr>
                </tbody>
            </table>
            ';

        return $html;
    }
}
