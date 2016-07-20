<?php
use Siacme\Dominio\Citas\CitaEstatus;
?>
@if($cita->getEstatus() === CitaEstatus::AGENDADA)
	<button type="button" class="btn btn-success btn-block confirmar" data-accion="{{ CitaEstatus::CONFIRMADA  }}"><i class="fa fa-check"></i> Confirmar Cita</button>
	<button type="button" class="btn btn-danger btn-block cancelar" data-accion="{{ CitaEstatus::CANCELADA  }}"><i class="fa fa-times-circle"></i> Cancelar Cita</button>
	<button type="button" class="btn btn-warning btn-block reprogramar"><i class="fa fa-calendar"></i> Reprogramar Cita</button>
@endif

@if($cita->getEstatus() === CitaEstatus::CONFIRMADA)
	@if(!is_null($expediente))
		@if($expediente->primeraVez())
			@if(!$expediente->firmado())
				<a href="" class="btn btn-success btn-block"><i class="fa fa-edit"></i> Registrar expediente</a>
			@else
				<button type="button" class="btn btn-danger btn-block registrarLlegada" data-accion="{{ CitaEstatus::EN_ESPERA_CONSULTA  }}"><i class="fa fa-male"></i> Marcar llegada de paciente</button>
			@endif
		@else
			<button type="button" class="btn btn-danger btn-block registrarLlegada" data-accion="{{ CitaEstatus::EN_ESPERA_CONSULTA  }}"><i class="fa fa-male"></i> Marcar llegada de paciente</button>
		@endif
	@else
		<a href="{{ url('expedientes/nuevo/' . base64_encode($cita->getPaciente()->getId()) . '/' . base64_encode($cita->getMedico()->getId())) }}" class="btn btn-success btn-block"><i class="fa fa-edit"></i> Registrar expediente</a>
	@endif
		<button type="button" class="btn btn-danger btn-block cancelar" data-accion="{{ CitaEstatus::CANCELADA  }}"><i class="fa fa-times-circle"></i> Cancelar Cita</button>
		<button type="button" class="btn btn-warning btn-block reprogramar"><i class="fa fa-calendar"></i> Reprogramar Cita</button>

@endif