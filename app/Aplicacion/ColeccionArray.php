<?php
namespace Siacme\Aplicacion;

use Siacme\Dominio\Listas\IColeccion;
use Doctrine\Common\Collections\ArrayCollection;

class ColeccionArray extends ArrayCollection implements IColeccion
{

}