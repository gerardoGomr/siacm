<?php
namespace Siacme\Aplicacion\Servicios\Expedientes;

use Siacme\Dominio\Expedientes\PlanTratamiento;
use Siacme\Dominio\Listas\IColeccion;
use Siacme\Aplicacion\Servicios\DibujadorInterface;

/**
 * Class DibujadorPlanTratamiento
 * @package Siacme\Servicios\Expedientes
 * @author  Gerardo Adrián Gomez Ruiz
 * @version 1.0
 */
class DibujadorPlanTratamiento implements DibujadorInterface
{
    /**
     * @var PlanTratamiento
     */
    protected $planTratamiento;

    /**
     * @var array
     */
    protected $dienteTratamientos;

    /**
     * DibujadorPlanTratamiento constructor.
     * @param PlanTratamiento $planTratamiento
     * @param array $dienteTratamientos
     */
    public function __construct(PlanTratamiento $planTratamiento, array $dienteTratamientos)
    {
        $this->planTratamiento         = $planTratamiento;
        $this->dienteTratamientos = $dienteTratamientos;
    }

    /**
     * dibujar la representación del plan
     * @return string
     */
    public function dibujar()
    {
        // TODO: Implement dibujar() method.
        $otrosTratamientos = '';
        foreach ($this->planTratamiento->getOtrosTratamientos() as $otroTratamiento) {
            $otrosTratamientos .= $otroTratamiento->getTratamiento() . ' ($' . (string)number_format($otroTratamiento->getCosto(), 2) . ') - ';
        }
        $html = '
            <p class="text-medium"><span class="strong">Costo total:</span> <span>$ '.(string) number_format($this->planTratamiento->costo(), 2).'</span></p>
            <p><span class="strong">Otros:</span> <em>' . $otrosTratamientos . '</em></p>
            <table class="table table-bordered tablaPlan text-small">
                <thead class="bg-primary">
                    <tr>
                        <th>Diente</th>
                        <th>Padecimiento</th>
                        <th>Tratamiento 1</th>
                        <th>Tratamiento 2</th>
                        <th>Costo</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($this->planTratamiento->getDientes() as $diente) {
            $dientePlan1 = $dientePlan2 = null;
            /*if ($diente->tieneTratamientos()) {
                $dientePlan1 = $diente->getTratamientos()->get('1');
                $dientePlan2 = $diente->getTratamientos()->get('2');
            }*/
            $html .= '
                <tr>
                    <td class="diente">' . $diente->getNumero() . '</td>
                    <td>' . $this->dibujarPadecimientos($diente->getPadecimientos()) . '</td>
                    <td>' . $this->dibujarComboTratamientos('1', $this->dienteTratamientos, $dientePlan1) .'</td>
                    <td>' . $this->dibujarComboTratamientos('2', $this->dienteTratamientos, $dientePlan2) .'</td>
                    <td>' . $this->dibujarCostosTratamientos($diente->getTratamientos()) . '</td>
                </tr>
            ';
        }

        $html .= '</tbody></table>';

        return $html;
    }

    /**
     * dibujar padecimientos
     * @param IColeccion $padecimientos
     * @return string
     */
    private function dibujarPadecimientos($padecimientos)
    {
        $html     = '';
        $indice   = 1;
        $longitud = count($padecimientos);
        foreach ($padecimientos as $padecimiento) {
            if ($indice === $longitud) {
                $html .= $padecimiento->getNombre();
            } else {
                $html .= $padecimiento->getNombre() . '---';
            }

            $indice++;
        }

        return $html;
    }

    /**
     * dibuja un combo de tratamientos
     * @param string $nombre
     * @param array $dienteTratamientos
     * @param DientePlan|null $dientePlan
     * @return string
     */
    private function dibujarComboTratamientos($nombre, array $dienteTratamientos, DientePlan $dientePlan = null)
    {
        $html = '
            <select class="tratamientos form-control">
                <option value="">Seleccione</option>
        ';

        foreach ($dienteTratamientos as $dienteTratamientos) {
            $selected = '';

            if (!is_null($dientePlan)) {
                if ($dienteTratamientos->getId() === $dientePlan->getDienteTratamiento()->getId()) {
                    $selected = 'selected="selected"';
                }
            }

            $html .= '<option value="' . $dienteTratamientos->getId() . '" ' . $selected . '>' . $dienteTratamientos->getTratamiento() . '</option>';
        }

        $html .= '</select>
            <input type="hidden" class="numeroTratamiento" value="' . $nombre . '">
        ';

        return $html;
    }

    /**
     * presenta los costos de los tratamientos
     * @param IColeccion $dienteTratamientos
     * @return string
     */
    private function dibujarCostosTratamientos(IColeccion $dienteTratamientos = null)
    {
        $total = count($dienteTratamientos);
        if ($total === 0 || is_null($dienteTratamientos)) {
            return '';
        }

        $html = '';
        $i = 1;
        foreach ($dienteTratamientos as $dienteTratamiento) {
            if ($i < $total) {
                $html .= '$' . (string) number_format($dienteTratamiento->getCosto(), 2) . ' + ';
            } else {
                $html .= '$' . (string) number_format($dienteTratamiento->getCosto(), 2);
            }

            $i++;
        }

        return $html;
    }
}