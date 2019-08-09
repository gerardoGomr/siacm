<?php
use Siacme\Dominio\Citas\CitaEstatus;

if ($cita->getMedico()->getId() === \Siacme\Dominio\Usuarios\Usuario::JOHANNA) {
    $expedienteEspecialidad = !is_null($expediente) ? $expediente->getExpedienteEspecialidad() : null;
}
if ($cita->getMedico()->getId() === \Siacme\Dominio\Usuarios\Usuario::RIGOBERTO) {
    $expedienteEspecialidad = !is_null($expediente) ? $expediente->getExpedienteRigoberto() : null;
}
?>
@if($cita->getEstatus() === CitaEstatus::AGENDADA)
	<button type="button" class="btn btn-success btn-block confirmar" data-accion="{{ CitaEstatus::CONFIRMADA  }}"><i class="fa fa-check"></i> Confirmar Cita</button>
	<button type="button" class="btn btn-danger btn-block cancelar" data-accion="{{ CitaEstatus::CANCELADA  }}"><i class="fa fa-times-circle"></i> Cancelar Cita</button>
	<button type="button" class="btn btn-warning btn-block reprogramar"><i class="fa fa-calendar"></i> Reprogramar Cita</button>
@endif

@if($cita->getEstatus() === CitaEstatus::CONFIRMADA)
	@if(!is_null($expediente) && !is_null($expedienteEspecialidad))
		@if($expedienteEspecialidad->primeraVez())
			@if(!$expediente->revisadoPorPaciente())
				<a href="{{ url('expedientes/ver/' . base64_encode($cita->getPaciente()->getId()) . '/' . base64_encode($cita->getMedico()->getId()) . '/' . base64_encode($cita->getId())) }}" class="btn btn-success btn-block"><i class="fa fa-search"></i> Ver el expediente</a>
			@endif
		@else
			<button type="button" class="btn btn-success btn-block registrarLlegada" data-accion="{{ CitaEstatus::EN_ESPERA_CONSULTA  }}"><i class="fa fa-male"></i> Registrar llegada de paciente</button>
		@endif
	@else
		<a href="{{ url('expedientes/registrar/' . base64_encode($cita->getPaciente()->getId()) . '/' . base64_encode($cita->getMedico()->getId()) . '/' . base64_encode($cita->getId())) }}" class="btn btn-success btn-block registrarExpediente"><i class="fa fa-edit"></i> Registrar llegada de paciente</a>
	@endif
	<button type="button" class="btn btn-danger btn-block cancelar" data-accion="{{ CitaEstatus::CANCELADA  }}"><i class="fa fa-times-circle"></i> Cancelar Cita</button>
	<button type="button" class="btn btn-warning btn-block reprogramar"><i class="fa fa-calendar"></i> Reprogramar Cita</button>
@endif

@if ($cita->getEstatus() !== CitaEstatus::CANCELADA_INASISTENCIA && $cita->getEstatus() !== CitaEstatus::CANCELADA)
	<button type="button" class="btn btn-default btn-block inasistencia" data-accion="{{ CitaEstatus::CANCELADA_INASISTENCIA }}"><i class="fa fa-times"></i> Cancelada por inasistencia</button>
@endif