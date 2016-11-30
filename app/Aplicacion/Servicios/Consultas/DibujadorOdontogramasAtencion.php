<?php
namespace Siacme\Aplicacion\Servicios\Consultas;

use Siacme\Aplicacion\Servicios\DibujadorInterface;
use Siacme\Dominio\Expedientes\Odontograma;
use Siacme\Dominio\Listas\IColeccion;

class DibujadorOdontogramasAtencion implements DibujadorInterface
{
    /**
     * @var Odontograma
     */
    protected $odontograma;

    /**
     * DibujadorPlanTratamiento constructor.
     * @param Odontograma $odontograma
     */
    public function __construct(Odontograma $odontograma)
    {
        $this->odontograma = $odontograma;
    }

    /**
     * dibujar una representación
     * @return string
     */
    public function dibujar()
    {
        // TODO: Implement dibujar() method.
        $otrosTratamientos = '';
        foreach ($this->odontograma->getOtrosTratamientos() as $otroTratamiento) {
            if (!$otroTratamiento->atendido()) {
                $otrosTratamientos .= '<tr><td>' . $otroTratamiento->getOtroTratamiento()->getTratamiento() . '</td><td>' . $otroTratamiento->getOtroTratamiento()->costo() . '</td><td><input type="checkbox" name="otroTratamientoAtendido[]" value="' . $otroTratamiento->getOtroTratamiento()->getId() . '" class="otroTratamiento" data-costo="' . $otroTratamiento->getOtroTratamiento()->getCosto() . '">  Marcar como atendido</td></tr>';
            } else {
                $otrosTratamientos .= '<tr><td>' . $otroTratamiento->getOtroTratamiento()->getTratamiento() . '</td><td>' . $otroTratamiento->getOtroTratamiento()->costo() . '</td><td><i class="fa fa-check"></i> Atendido</td></tr>';
            }
        }
        $html = '
            <p class="text-medium"><span class="strong">Costo total:</span> <span>' . $this->odontograma->costo() . '</span></p>
            <p><span class="strong">Otros tratamientos:</p>
            <div class="row">
                <div class="col-md-7">
                    <table class="table">
                        ' . $otrosTratamientos . '
                    </table>
                </div>
            </div>

            <table class="table table-bordered tablaPlan text-small">
                <thead class="bg-primary">
                    <tr>
                        <th>Diente</th>
                        <th>Padecimiento</th>
                        <th>Costo</th>
                        <th>Marcar atención</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($this->odontograma->getOdontogramaDientes() as $odontogramaDiente) {
            $accion = '-';

            if ($odontogramaDiente->tieneTratamientos()) {
                if (!$odontogramaDiente->tratamientosAtendidos()) {
                    $accion = '<label><input type="checkbox" name="dienteAtendido[]" value="' . $odontogramaDiente->getDiente()->getNumero() . '" class="tratamiento" data-costo="' . $odontogramaDiente->costoTratamientos() . '"> Marcar como atendido</label>';
                } else {
                    $accion = '<i class="fa fa-check"></i> Atendido';
                }
            }

            $html .= '
                <tr>
                    <td class="diente">' . $odontogramaDiente->getDiente()->getNumero() . '</td>
                    <td>' . $this->dibujarPadecimientos($odontogramaDiente->getPadecimientos()) . '</td>
                    <td>' . $this->dibujarCostosTratamientos($odontogramaDiente->getTratamientos()) . '</td>
                    <td>' . $accion . '</td>
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
        $indice   = 1;
        $longitud = $padecimientos->count();

        $html = '<ul>';
        foreach ($padecimientos as $padecimiento) {
            if ($indice === $longitud) {
                $html .= '<li>' . $padecimiento->getNombre() . '</li>';
            } else {
                $html .= '<li>' . $padecimiento->getNombre() . '</li>';
            }

            $indice++;
        }

        $html .= '</ul>';

        return $html;
    }

    /**
     * presenta los costos de los tratamientos
     * @param IColeccion $dienteTratamientos
     * @return string
     */
    private function dibujarCostosTratamientos($dienteTratamientos = null)
    {
        $total = $dienteTratamientos->count();
        if ($total === 0) {
            return '';
        }

        $html = '<ul>';
        foreach ($dienteTratamientos as $dienteTratamiento) {
            $html .= '<li>' . $dienteTratamiento->getDienteTratamiento()->getTratamiento() . $dienteTratamiento->getDienteTratamiento()->costo() . '</li>';
        }

        $html .= '</ul>';

        return $html;
    }
}