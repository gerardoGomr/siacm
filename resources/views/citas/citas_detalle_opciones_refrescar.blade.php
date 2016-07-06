@if($cita->getEstatus()->getId() === 1)
	<a href="javascript:;" title="Confirmar" class="btn btn-success btn-block confirmar"><i class="fa fa-check"></i> Confirmar Cita</a>
	<a href="javascript:;" title="Cancelar" class="btn btn-danger btn-block cancelar"><i class="fa fa-times"></i> Cancelar Cita</a>
	<a href="javascript:;" title="Reprogramar" class="btn btn-warning btn-block reprogramar"><i class="fa fa-warning"></i> Reprogramar</a>
@endif

@if($cita->getEstatus()->getId() === 2)
	@if(!is_null($expediente) && $expediente->necesitaFirma() === true)
		<a href="javascript:;" title="Ver expediente" class="btn btn-primary btn-block verExpediente"><i class="fa fa-search"></i> Ver expediente</a>
	@else
		<a href="javascript:;" title="En espera" class="btn btn-success btn-block registrarLlegada"><i class="fa fa-check"></i> Registrar llegada de paciente</a>
		<a href="javascript:;" title="Cancelar" class="btn btn-danger btn-block cancelar"><i class="fa fa-times"></i> Cancelar Cita</a>
		<a href="javascript:;" title="Reprogramar" class="btn btn-warning btn-block reprogramar"><i class="fa fa-warning"></i> Reprogramar</a>
	@endif
@endif