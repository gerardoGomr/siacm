<?php
use Siacme\Dominio\Citas\CitaEstatus;
?>
@if($cita->getEstatus() === CitaEstatus::AGENDADA)
	<button type="button" class="btn btn-success btn-block confirmar" data-accion="{{ CitaEstatus::CONFIRMADA  }}"><i class="fa fa-check"></i> Confirmar Cita</button>
	<button type="button" class="btn btn-danger btn-block cancelar" data-accion="{{ CitaEstatus::CANCELADA  }}"><i class="fa fa-times"></i> Cancelar Cita</button>
	<button type="button" class="btn btn-warning btn-block reprogramar"><i class="fa fa-calendar"></i> Reprogramar Cita</button>
@endif

@if($cita->getEstatus() === CitaEstatus::CONFIRMADA)

		<a href="javascript:;" title="En espera" class="btn btn-success btn-block registrarLlegada"><i class="fa fa-check"></i> Registrar llegada de paciente</a>
		<a href="javascript:;" title="Cancelar" class="btn btn-danger btn-block cancelar"><i class="fa fa-times"></i> Cancelar Cita</a>
		<a href="javascript:;" title="Reprogramar" class="btn btn-warning btn-block reprogramar"><i class="fa fa-warning"></i> Reprogramar</a>

@endif