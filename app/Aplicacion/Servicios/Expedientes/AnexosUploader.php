<?php
namespace Siacme\Aplicacion\Servicios\Expedientes;

use Siacme\Dominio\Expedientes\Anexo;
use Siacme\Exceptions\GuardarArchivoEnDirectorioException;

/**
 * Class AnexosUploader
 * @package Siacme\Servicios\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 * @version  1.0
 */
class AnexosUploader
{
    /**
     * @var string
     */
    private $rutaBase;

    /**
     * AnexosUploader constructor.
     * @param string $expedienteId
     */
    public function __construct($expedienteId)
    {
        $this->rutaBase = storage_path() . '/app/public/pacientes/' . $expedienteId . '/';
    }

    /**
     * guardar el anexo en el directorio especificado
     * @param string $ubicacionTemporal
     * @param Anexo $anexo
     * @throws GuardarArchivoEnDirectorioException
     */
    public function guardar($ubicacionTemporal, Anexo $anexo)
    {
        $nombre = $anexo->preparar();
        if (!file_exists($this->rutaBase)) {
            mkdir($this->rutaBase, 0777);
        }

        if (!move_uploaded_file($ubicacionTemporal, $this->rutaBase . $nombre . '.pdf')) {
            throw new GuardarArchivoEnDirectorioException('Imposible guardar el anexo en el directorio \"' . $this->rutaBase . '\"');
        }
    }

    /**
     * obtener los anexos guardados en el directorio estipulado
     * @return array
     */
    public function asignar()
    {
        if (!file_exists($this->rutaBase)) {
            return null;
        }

        $archivos = scandir($this->rutaBase);

        if($archivos === false) {
            return null;
        }

        $archivosReales = [];

        foreach ($archivos as $indice => $valor) {
            if ($valor !== '.' && $valor !== '..') {
                $archivosReales[] = $valor;
            }
        }

        return $archivosReales;
    }

    /**
     * eliminar un anexo de directorio
     * @param Anexo $anexo
     * @return bool
     */
    public function eliminar(Anexo $anexo)
    {
        return unlink($this->rutaBase . $anexo->nombre());
    }

    /**
     * @return string
     */
    public function rutaBase()
    {
        return $this->rutaBase;
    }
}