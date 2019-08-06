<div class="innerAll">
    <div class="media">
        @if(isset($expediente) && $expediente->tieneFoto())
            <img src="{{ url('expedientes/foto/mostrar/' . base64_encode($expediente->getFotografia()->getRuta())) . '?' . rand() }}" id="fotoCapturada" class="pull-left"  width="">
        @endif
        <div class="media-body innerAll half">
            <h4 class="media-heading">{{ $expediente->getPaciente()->nombreCompleto() }}</h4>
            <p>{{ $expediente->getPaciente()->edadCompleta() }} años<br/>Vive en: {{ $expediente->getPaciente()->getLugarNacimiento() }}<br/>Expediente {{ !is_null($expediente->getExpedienteRigoberto()) ? $expediente->getExpedienteRigoberto()->numero() : '--' }}</p>
            <a href="{{ url('expedientes/ver/' . base64_encode($expediente->getPaciente()->getId()) . '/' . base64_encode($medico->getId())) }}" class="btn btn-success btn-md" target="_blank"><i class="fa fa-eye"></i> Ver expediente completo</a>
            @if(!is_null($expediente->getExpedienteRigoberto()) && !$expediente->getExpedienteRigoberto()->primeraVez())
                <button type="button" class="btn btn-primary btn-md" id="generarCotizacionCirugia" data-id="{{ $expediente->getId() }}"> Generar cotización cirugía</button>
            @endif
        </div>
    </div>
    <div class="separator bottom"></div>

	<div class="widget widget-tabs">
		<div class="widget-head">
			<ul>
				<li class="active"><a href="#consultas" data-toggle="tab"><i class="fa fa-user-md"></i> Consultas</a></li>
				<li class=""><a href="#interconsultas" data-toggle="tab"><i class="fa fa-search"></i> Interconsultas</a></li>
				<li class=""><a href="#anexos" data-toggle="tab"><i class="fa fa-edit"></i> Anexos</a></li>
                <li class=""><a href="#planesCirugia" data-toggle="tab"><i class="fa fa-list"></i> Planes Cirugía</a></li>
			</ul>
		</div>
		<div class="widget-body">
			<div class="tab-content">
				@include('pacientes.pacientes_consultas')
				@include('pacientes.pacientes_interconsultas')
				@include('pacientes.pacientes_anexos')
                @include('pacientes.pacientes_rigoberto_plan_cirugia_list')
			</div>
		</div>
	</div>
</div>
