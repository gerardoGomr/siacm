<?php
namespace Siacme\Servicios\Consultas;

use Illuminate\Support\Collection;
use Siacme\Dominio\Consultas\PlanTratamiento;
use Siacme\Servicios\DibujadorInterface;

class DibujadorPlanTratamientoAtencion implements DibujadorInterface
{
    /**
     * @var PlanTratamiento
     */
    protected $planTratamiento;

    /**
     * DibujadorPlanTratamiento constructor.
     * @param PlanTratamiento $planTratamiento
     */
    public function __construct(PlanTratamiento $planTratamiento)
    {
        $this->planTratamiento = $planTratamiento;
    }

    /**
     * dibujar una representación
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
                        <th>Marcar atención</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($this->planTratamiento->getListaDientes() as $diente) {
            $dientePlan1 = $dientePlan2 = null;
            $accion      = ' -- ';
            $atendido    = false;

            if (!is_null($diente->getListaTratamientos())) {
                $dientePlan1 = $diente->getListaTratamientos()->get('1')->getDienteTratamiento()->getTratamiento();
                $dientePlan2 = !is_null($diente->getListaTratamientos()->get('2')) ? $diente->getListaTratamientos()->get('2')->getDienteTratamiento()->getTratamiento() : ' -- ';

                $atendido = $diente->getListaTratamientos()->get('1')->atendido();
                if (!is_null($diente->getListaTratamientos()->get('2'))) {
                    $atendido = $diente->getListaTratamientos()->get('2')->atendido();
                }

                $accion = '<label><input type="checkbox" name="dienteAtendido[]" value="'. $diente->getNumero() .'" class="tratamiento" data-costo=""><input type="hidden" value="'. $diente->costoTratamientos() .'"> Dar atención</label>';

                if ($atendido) {
                    $accion = '<span class="strong">Atendido</span>';
                }

            } else {
                $dientePlan1 = $dientePlan2 = ' -- ';
            }
            $html .= '
                <tr>
                    <td class="diente">' . $diente->getNumero() . '</td>
                    <td>' . $this->dibujarPadecimientos($diente->getListaPadecimientos()) . '</td>
                    <td>' . $dientePlan1 .'</td>
                    <td>' . $dientePlan2 .'</td>
                    <td>' . $this->dibujarCostosTratamientos($diente->getListaTratamientos()) . '</td>
                    <td>' . $accion . '</td>
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
     * presenta los costos de los tratamientos
     * @param Collection $listaDienteTratamientos
     * @return string
     */
    private function dibujarCostosTratamientos(Collection $listaDienteTratamientos = null)
    {
        $total = count($listaDienteTratamientos);
        if ($total === 0 || is_null($listaDienteTratamientos)) {
            return ' -- ';
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