<?php
namespace Siacme\Dominio\Expedientes;

/**
 * Class FotografiaPaciente
 * @package Siacme\Dominio\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class FotografiaPaciente extends Fotografia
{
	/**
	 * indica si la foto ha sido o no recortada
	 * @var bool
	 */
	private $haSidoRecortada;

	/**
	 * FotografiaPaciente constructor.
	 * @param string $ruta
	 * @throws \Exception
	 */
	public function __construct($ruta)
	{
		$this->rutaTemporal = 'storage/pacientesFotografiasTemp/';
		$this->rutaAGuardar = 'storage/pacientesFotografias/';

		parent::__construct($ruta);

		list($ancho, $alto, $tipo) = getimagesize($this->ruta);

		if($tipo !== IMAGETYPE_JPEG) {
			throw new \Exception("No es imagen JPG");
		}

		// inicializar
		$this->imgOrigen       = imagecreatefromjpeg($this->ruta);
		$this->ancho           = $ancho;
		$this->alto            = $alto;
		$this->tipo            = $tipo;
		$this->haSidoRecortada = false;
	}

	/**
	 * @param string $nombre
	 * @param int    $anchoNuevo
	 * @param int    $altoNuevo
	 * @return bool
	 */
	public function moverATemporal($nombre, $anchoNuevo = 200, $altoNuevo = 250)
	{
		// en pixeles
		try {

			// img destino
			$this->imgDestino = imagecreatetruecolor($anchoNuevo, $altoNuevo);

			// achicar a 300 x 200
			imagecopyresampled($this->imgDestino, $this->imgOrigen, 0, 0, 0, 0, $anchoNuevo, $altoNuevo, $this->ancho, $this->alto);

			// guardar
			imagejpeg($this->imgDestino, $this->rutaTemporal.$nombre.'.jpg', 100);

			$this->ancho = $anchoNuevo;
			$this->alto  = $altoNuevo;
			$this->ruta  = $this->rutaTemporal.$nombre.'.jpg';

			$this->imgOrigen = imagecreatefromjpeg($this->ruta);

			return true;

		} catch(\Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}

	/**
	 * verificar si ha sido recortada
	 * @return boolean
	 */
	public function recortada()
	{
		return $this->haSidoRecortada;
	}

	/**
     * cambiar el tamaño de la imagen
     * @param  int $posX
     * @param  int $posY
     * @param  int $nuevoAncho
     * @param  int $nuevoAlto
     * @return bool
     */
    public function cambiarTamanio($posX, $posY, $nuevoAncho, $nuevoAlto)
    {
    	try {
	    	$this->imgDestino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

	    	imagecopyresampled($this->imgDestino, $this->imgOrigen, 0, 0, $posX, $posY, $nuevoAncho, $nuevoAlto, $nuevoAncho, $nuevoAlto);

	    	$this->ancho = $nuevoAncho;
	    	$this->alto  = $nuevoAlto;

	    	$this->obtenerPesoDeFoto();
			$this->haSidoRecortada = true;

	    	imagejpeg($this->imgDestino, $this->ruta, 100);

	    	return true;

	    } catch(\Exception $e) {
			echo $e->getMessage();
			return false;
		}
    }

    /**
     * guardar en la carpeta real
     * @param  string $nombre
     * @return bool
     */
    public function guardar($nombre)
	{
        $nombre = (string)$nombre;

		if(!rename($this->ruta, $this->rutaAGuardar.$nombre.'.jpg')) {
			return false;
		}

		$this->ruta = $this->rutaAGuardar.$nombre.'.jpg';

		return true;
	}
}