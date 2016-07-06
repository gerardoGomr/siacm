<?php
namespace Siacme\Servicios\Expedientes;
use Siacme\Dominio\Pacientes\Anexo;

/**
 * Class AnexosUploader
 * @package Siacme\Servicios\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 */
class AnexosUploader
{
    /**
     * @var string
     */
    private $rutaBase;

    /**
     * AnexosUploader constructor.
     * @param string $medicoUsername
     * @param string $idPaciente
     */
    public function __construct($medicoUsername, $idPaciente)
    {
        $this->rutaBase = 'storage/app/pacientes/' . $medicoUsername . '/'.$idPaciente . '/';
    }

    /**
     * guardar el anexo en el directorio especificado
     * @param string $ubicacionTemporal
     * @param Anexo $anexo
     * @throws \Exception
     */
    public function guardar($ubicacionTemporal, Anexo $anexo)
    {
        $nombre = $anexo->preparar();

        if (!file_exists($this->rutaBase)) {
            mkdir($this->rutaBase, 0777);
        }

        if (!move_uploaded_file($ubicacionTemporal, $this->rutaBase . $nombre . '.pdf')) {
            throw new \Exception('Imposible guardar el anexo en el directorio \"' . $this->rutaBase . '\"');
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

        $archivosReales = array();

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