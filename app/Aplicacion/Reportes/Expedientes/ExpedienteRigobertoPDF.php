<?php
namespace Siacme\Aplicacion\Reportes\Expedientes;

use Siacme\Aplicacion\Fecha;
use Siacme\Aplicacion\Reportes\ReporteJohanna;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Expedientes\MarcaPasta;

/**
 * Class ExpedienteRigobertoPDF
 * @package Siacme\Aplicacion\Reportes\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class ExpedienteRigobertoPDF extends ReporteJohanna
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
            <p>' . $this->expediente->getPaciente()->edadCompleta() . '<br/><b>Vive en:</b> ' . $this->expediente->getPaciente()->getLugarNacimiento() . '<br/><b>Expediente:</b> ' . $this->expediente->getExpedienteRigoberto()->numero() . '</p>';

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

        $html = $this->generarAntecedentesNoPatologicos();
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
        $exFumador              = $this->expediente->exFumador() ? 'Sí' : 'No';
        $exAlcoholico           = $this->expediente->exAlcoholico() ? 'Sí' : 'No';
        $exAdicto               = $this->expediente->exAdicto() ? 'Sí' : 'No';

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
                <tr>
                    <td><b>Ex-fumador:</b></td>
                    <td>' . $exFumador . '</td>
                </tr>
                <tr>
                    <td><b>Ex-alcohólico:</b></td>
                    <td>' . $exAlcoholico . '</td>
                </tr>
                <tr>
                    <td><b>Ex-adicto:</b></td>
                    <td>' . $exAdicto . '</td>
                </tr>
            </table>';

        return $html;
    }

    /**
     * generar sección de antecedentes no patológicos
     * @return string
     */
    private function generarAntecedentesNoPatologicos()
    {
        $regimenAlimenticio = $this->expediente->getExpedienteRigoberto()->getRegimenAlimenticio() ? 'Sí - ' . $this->expediente->getExpedienteRigoberto()->getDescripcionRegimen() : 'No';

        $html = '<h3>Antecedentes Personales No Patológicos</h3>
            <hr>
            <table>
                <tr>
                    <td width="150"><b>Perioricidad Baño:</b></td>
                    <td>' . $this->expediente->getExpedienteRigoberto()->getPerioricidadBanio() . ' veces</td>
                </tr>
                <tr>
                    <td><b>Perioricidad Aseo Bucal:</b></td>
                    <td>' . $this->expediente->getExpedienteRigoberto()->getPerioricidadHigieneBucal() . ' veces</td>
                </tr>
                <tr>
                    <td><b>Perioricidad Lava Manos:</b></td>
                    <td>' . $this->expediente->getExpedienteRigoberto()->getPerioricidadLavaManos() . ' veces</td>
                </tr>
                <tr>
                    <td><b>Frecuencia Cambio Ropa Interior:</b></td>
                    <td>' . $this->expediente->getExpedienteRigoberto()->getFrecuenciaCambioRopa() . ' veces</td>
                </tr>
                <tr>
                    <td><b>Veces Come al Día:</b></td>
                    <td>' . $this->expediente->getExpedienteRigoberto()->getVecesComeDia() . '</td>
                </tr>
                <tr>
                    <td><b>Horas entre Comida y Comida:</b></td>
                    <td>' . $this->expediente->getExpedienteRigoberto()->getTiempoEntreComidas() . ' horas</td>
                </tr>
                <tr>
                    <td><b>Tiene Régimen Alimenticio:</b></td>
                    <td>' . $regimenAlimenticio . '</td>
                </tr>
                <tr>
                    <td><b>Horas Duerme:</b></td>
                    <td>' . $this->expediente->getExpedienteRigoberto()->getHorasDuerme() . ' horas</td>
                </tr>
                <tr>
                    <td><b>Frecuencia Ejercicio:</b></td>
                    <td>' . $this->expediente->getExpedienteRigoberto()->getFrecuenciaEjercicio() . '</td>
                </tr>
            </table>';

        return $html;
    }
}
