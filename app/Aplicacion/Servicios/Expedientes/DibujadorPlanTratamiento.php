<?php
namespace Siacme\Aplicacion\Servicios\Expedientes;

use Siacme\Dominio\Expedientes\Odontograma;
use Siacme\Dominio\Expedientes\PlanTratamiento;
use Siacme\Dominio\Expedientes\Diente;
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
     * @var Odontograma
     */
    protected $odontograma;

    /**
     * @var array
     */
    protected $dienteTratamientos;

    /**
     * DibujadorPlanTratamiento constructor.
     * @param Odontograma $odontograma
     * @param array $dienteTratamientos
     */
    public function __construct(Odontograma $odontograma, array $dienteTratamientos)
    {
        $this->planTratamiento    = $odontograma;
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
            $otrosTratamientos .= $otroTratamiento->getTratamiento() . ' ($' . (string)number_format($otroTratamiento->getCosto(), 2) . ') <button type="button" class="btn btn-danger btn-xs eliminarOtroTratamiento" data-id="'.$otroTratamiento->getId().'" data-toggle="tooltip" data-original-title="Quitar de plan" data-placement="top"><i class="fa fa-times"></i></button> ----- ';
        }
        $html = '
            <p class="text-medium"><span class="strong">Costo total:</span> <span>$ '.(string) number_format($this->planTratamiento->costo(), 2).'</span></p>
            <p><span class="strong">Otros:</span> <em>' . $otrosTratamientos . '</em></p>
            <table class="table table-bordered tablaPlan text-small">
                <thead class="bg-primary">
                    <tr>
                        <th>Diente</th>
                        <th>Padecimiento</th>
                        <th>Tratamientos</th>
                        <th>Costo</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($this->planTratamiento->getDientes() as $diente) {

            $html .= '
                <tr>
                    <td class="diente">' . $diente->getNumero() . '</td>
                    <td>' . $this->dibujarPadecimientos($diente->getPadecimientos()) . '</td>
                    <td>' . $this->dibujarComboTratamientos($diente, $this->dienteTratamientos) . '</td>
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
        $indice   = 1;
        $longitud = count($padecimientos);

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
     * dibuja un combo de tratamientos
     * @param Diente $diente
     * @param array $dienteTratamientos
     * @return string
     */
    private function dibujarComboTratamientos(Diente $diente, array $dienteTratamientos)
    {
        if (!$diente->tienePadecimientos()) {
            return '';
        }

        $html = '<div class="form-group">
            <div class="input-group">
            <select class="tratamientos form-control">
                <option value="">Seleccione</option>
        ';

        foreach ($dienteTratamientos as $dienteTratamiento) {
            $html .= '<option value="' . $dienteTratamiento->getId() . '">' . $dienteTratamiento->getTratamiento() . '</option>';
        }

        $html .= '</select>
            <div class="input-group-btn">
                <button type="button" class="btn btn-primary agregarTratamiento"><i class="fa fa-plus-square"></i></button>
            </div>
            </div>
            </div>
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

        $html = '<ul>';
        foreach ($dienteTratamientos as $dienteTratamiento) {
            $html .= '<li><button type="button" class="btn btn-danger btn-xs eliminarTratamiento" data-toggle="tooltip" data-original-title="Quitar de plan" data-placement="top" data-id="' . $dienteTratamiento->getDienteTratamiento()->getId() . '"><i class="fa fa-times"></i></button> ' . $dienteTratamiento->getDienteTratamiento()->getTratamiento() . ' $' . (string) number_format($dienteTratamiento->getDienteTratamiento()->getCosto(), 2) . '</li>';
        }

        $html .= '</ul>';

        return $html;
    }
}