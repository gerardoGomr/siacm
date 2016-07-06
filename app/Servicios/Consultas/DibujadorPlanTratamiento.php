<?php
namespace Siacme\Servicios\Consultas;

use Illuminate\Support\Collection;
use Siacme\Dominio\Consultas\DientePlan;
use Siacme\Dominio\Consultas\PlanTratamiento;
use Siacme\Servicios\DibujadorInterface;

/**
 * Class DibujadorPlanTratamiento
 * @package Siacme\Servicios\Consultas
 * @author  Gerardo Adrián Gomez Ruiz
 */
class DibujadorPlanTratamiento implements DibujadorInterface
{
    /**
     * @var PlanTratamiento
     */
    protected $planTratamiento;

    /**
     * @var Collection
     */
    protected $listaDienteTratamientos;

    /**
     * DibujadorPlanTratamiento constructor.
     * @param PlanTratamiento $planTratamiento
     * @param Collection $listaDienteTratamientos
     */
    public function __construct(PlanTratamiento $planTratamiento, Collection $listaDienteTratamientos)
    {
        $this->planTratamiento         = $planTratamiento;
        $this->listaDienteTratamientos = $listaDienteTratamientos;
    }

    /**
     * dibujar la representación del plan
     * @return string
     */
    public function dibujar()
    {
        // TODO: Implement dibujar() method.
        $otrosTratamientos = '';
        foreach ($this->planTratamiento->getListaOtrosTratamientos() as $otroTratamiento) {
            $otrosTratamientos .= $otroTratamiento->getTratamiento() . ' ($' . (string)number_format($otroTratamiento->getCosto(), 2) . ') - ';
        }
        $html = '
            <p class="text-medium"><span class="strong">Costo total:</span> <span>$ '.(string) number_format($this->planTratamiento->costo(), 2).'</span></p>
            <p><span class="strong">Otros:</span> <em>' . $otrosTratamientos . '</em></p>
            <table class="table table-bordered tablaPlan text-small">
                <thead>
                    <tr>
                        <th>Diente</th>
                        <th>Padecimiento</th>
                        <th>Tratamiento 1</th>
                        <th>Tratamiento 2</th>
                        <th>Costo</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($this->planTratamiento->getListaDientes() as $diente) {
            $dientePlan1 = $dientePlan2 = null;
            if (!is_null($diente->getListaTratamientos())) {
                $dientePlan1 = $diente->getListaTratamientos()->get('1');
                $dientePlan2 = $diente->getListaTratamientos()->get('2');
            }
            $html .= '
                <tr>
                    <td class="diente">' . $diente->getNumero() . '</td>
                    <td>' . $this->dibujarPadecimientos($diente->getListaPadecimientos()) . '</td>
                    <td>' . $this->dibujarComboTratamientos('1', $this->listaDienteTratamientos, $dientePlan1) .'</td>
                    <td>' . $this->dibujarComboTratamientos('2', $this->listaDienteTratamientos, $dientePlan2) .'</td>
                    <td>' . $this->dibujarCostosTratamientos($diente->getListaTratamientos()) . '</td>
                </tr>
            ';
        }

        $html .= '</tbody></table>';

        return $html;
    }

    /**
     * dibujar padecimientos
     * @param Collection $listaPadecimientos
     * @return string
     */
    private function dibujarPadecimientos($listaPadecimientos)
    {
        $html     = '';
        $indice   = 1;
        $longitud = count($listaPadecimientos);
        foreach ($listaPadecimientos as $padecimiento) {
            if ($indice === $longitud) {
                $html .= $padecimiento->getNombre();
            } else {
                $html .= $padecimiento->getNombre() . '||';
            }

            $indice++;
        }

        return $html;
    }

    /**
     * dibuja un combo de tratamientos
     * @param string $nombre
     * @param Collection $listaDienteTratamientos
     * @param DientePlan $dientePlan
     * @return string
     */
    private function dibujarComboTratamientos($nombre, Collection $listaDienteTratamientos, DientePlan $dientePlan = null)
    {
        $html = '
            <select class="tratamientos form-control">
                <option value="">Seleccione</option>
        ';

        foreach ($listaDienteTratamientos as $dienteTratamientos) {
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
     * @param Collection $listaDienteTratamientos
     * @return string
     */
    private function dibujarCostosTratamientos(Collection $listaDienteTratamientos = null)
    {
        $total = count($listaDienteTratamientos);
        if ($total === 0 || is_null($listaDienteTratamientos)) {
            return '';
        }

        $html = '';
        $i = 1;
        foreach ($listaDienteTratamientos as $dienteTratamiento) {
            if ($i < $total) {
                $html .= '$' . (string) number_format($dienteTratamiento->getDienteTratamiento()->getCosto(), 2) . ' + ';
            } else {
                $html .= '$' . (string) number_format($dienteTratamiento->getDienteTratamiento()->getCosto(), 2);
            }

            $i++;
        }

        return $html;
    }
}