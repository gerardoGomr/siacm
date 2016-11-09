<?php
namespace Siacme\Aplicacion\Servicios\Expedientes;

use Siacme\Aplicacion\Servicios\DibujadorInterface;
use Siacme\Dominio\Expedientes\Odontograma;

/**
 * Class DibujadorOdontogramas
 * @package Siacme\Aplicacion\Servicios\Expedientes
 * @author  Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class DibujadorOdontogramas implements DibujadorInterface
{
	/**
	 * odontograma
	 * @var Odontograma
	 */
	protected $odontograma;

	/**
	 * constructor, recibe un odontograma para dibujar
	 * @param Odontograma $odontograma
	 */
	public function __construct(Odontograma $odontograma)
	{
		$this->odontograma = $odontograma;
	}

	/**
	 * dibujar una representación de un odontograma en HTML
	 * usando tablas
	 * @return string
	 */
	public function dibujar()
	{
		$html = '<table class="table table-bordered text-center" id="odontograma"><tr>';

		// primera sección de dientes
		$html .= '</tr><tr>';

		$html .= $this->dibujarImagenDientes(18, 11);
		$html .= $this->dibujarImagenDientes(21, 28);

		$html .= '</tr><tr>';

		$html .= $this->dibujarNumeroDientes(18, 11);
		$html .= $this->dibujarNumeroDientes(21, 28);

		$html .= '</tr><tr><td rowspan="7" colspan="3">&nbsp;</td>';

		$html .= $this->dibujarFilasVacias(10);

		$html .= '<td rowspan="7" colspan="3">&nbsp;</td>';

		$html .= '</tr><tr>';

		$html .= $this->dibujarImagenDientes(55, 51);
		$html .= $this->dibujarImagenDientes(61, 65);
		$html .= '</tr><tr>';

		$html .= $this->dibujarNumeroDientes(55, 51);
		$html .= $this->dibujarNumeroDientes(61, 65);

		$html .= '</tr><tr>';

		$html .= $this->dibujarNumeroDientes(85, 81);
		$html .= $this->dibujarNumeroDientes(71, 75);

		$html .= '</tr><tr>';

		$html .= $this->dibujarImagenDientes(85, 81);
		$html .= $this->dibujarImagenDientes(71, 75);

		$html .= '</tr><tr>';

		$html .= '</tr><tr>';

		$html .= $this->dibujarFilasVacias(10);

		$html .= '</tr><tr>';


		$html .= $this->dibujarNumeroDientes(48, 41);
		$html .= $this->dibujarNumeroDientes(31, 38);

		$html .= '</tr><tr>';

		$html .= $this->dibujarImagenDientes(48, 41);
		$html .= $this->dibujarImagenDientes(31, 38);

		$html .= '</tr></table>';

		return $html;
	}

	/**
	 * dibujar una línea de columnas dependiendo la longitud especificada
	 * @param  int $longitudColumnas
	 * @return string
	 */
	protected function dibujarFilasVacias($longitudColumnas)
	{
		$html = '';
		for ($i = 1; $i <= $longitudColumnas; $i++) {

			$html .= '<td>&nbsp;</td>';
		}

		return $html;
	}

	/**
	 * dibujar la imagen de los dientes dependiendo el inicio y fin de dientes
	 * @param  int $inicio
	 * @param  int $fin
	 * @return string
	 */
	protected function dibujarImagenDientes($inicio, $fin)
	{
		$html = '';

		if($inicio > $fin) {
			for ($i = $inicio; $i >= $fin; $i--) {
                $strImagen = '';
                if ($this->odontograma->getOdontogramaDiente($i)->tienePadecimientos()) {
                    foreach ($this->odontograma->getOdontogramaDiente($i)->getPadecimientos()->getValues() as $dientePadecimiento) {
                        $strImagen .= '<img src="' . asset($dientePadecimiento->getImagen()) . '" />';
                    }
                } else {
                    $strImagen .= '<img src="' . asset('img/dientes/x.png') . '" />';
                }

                $html .= '<td><a href="#dvPadecimientosDentales" class="diente" data-toggle="modal" data-id="' . $this->odontograma->getOdontogramaDiente($i)->getDiente()->getNumero() . '">' . $strImagen . '<input type="hidden" name="valor" value="' . $this->odontograma->getOdontogramaDiente($i)->getDiente()->getNumero() . '"></a></td>';

			}

		} else {

			for ($i = $inicio; $i <= $fin; $i++) {
                $strImagen = '';
                if ($this->odontograma->getOdontogramaDiente($i)->tienePadecimientos()) {
                    foreach ($this->odontograma->getOdontogramaDiente($i)->getPadecimientos()->getValues() as $dientePadecimiento) {
                        $strImagen .= '<img src="' . asset($dientePadecimiento->getImagen()) . '" />';
                    }
                } else {
                    $strImagen .= '<img src="' . asset('img/dientes/x.png') . '" />';
                }

                $html .= '<td><a href="#dvPadecimientosDentales" class="diente" data-toggle="modal" data-id="' . $this->odontograma->getOdontogramaDiente($i)->getDiente()->getNumero() . '">' . $strImagen . '<input type="hidden" name="valor" value="' . $this->odontograma->getOdontogramaDiente($i)->getDiente()->getNumero() . '"></a></td>';

			}
		}

		return $html;
	}

	/**
	 * dibujar el número de los dientes dependiendo el inicio y fin de dientes
	 * @param  int $inicio
	 * @param  int $fin
	 * @return string
	 */
	protected function dibujarNumeroDientes($inicio, $fin)
	{
		$html = '';

		if($inicio > $fin) {
			for ($i = $inicio; $i >= $fin; $i--) {
				$html .= '<td>' . $this->odontograma->getOdontogramaDiente($i)->getDiente()->getNumero() . '</td>';
			}

		} else {
			for ($i = $inicio; $i <= $fin; $i++) {
				$html .= '<td>' . $this->odontograma->getOdontogramaDiente($i)->getDiente()->getNumero() . '</td>';
			}
		}

		return $html;
	}
}