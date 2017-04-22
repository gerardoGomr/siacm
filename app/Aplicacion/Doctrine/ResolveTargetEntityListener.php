<?php
namespace Siacme\Aplicacion\Doctrine;

use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Siacme\Dominio\Expedientes\AbstractExpediente;
use Siacme\Dominio\Expedientes\ExpedienteJohanna;
use Siacme\Dominio\Expedientes\ExpedienteRigoberto;

class ResolveTargetEntityListener
{
    public function loadClassMetadata(LoadClassMetadataEventArgs $meta)
    {
        $rtel = new \Doctrine\ORM\Tools\ResolveTargetEntityListener;

        $rtel->addResolveTargetEntity(AbstractExpediente::class, ExpedienteRigoberto::class, array());

    }
}