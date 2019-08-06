<div class="innerAll">
    <div class="media">
        @if(isset($expediente) && $expediente->tieneFoto())
            <img src="{{ url('expedientes/foto/mostrar/' . base64_encode($expediente->getFotografia()->getRuta())) . '?' . rand() }}" id="fotoCapturada" class="pull-left"  width="">
        @endif
        <div class="media-body innerAll half">
            <h4 class="media-heading">{{ $expediente->getPaciente()->nombreCompleto() }}</h4>
            <p>{{ $expediente->getPaciente()->edadCompleta() }} años<br/>Vive en: {{ $expediente->getPaciente()->getLugarNacimiento() }}<br/>Expediente {{ !is_null($expediente->getExpedienteEspecialidad()) ? $expediente->getExpedienteEspecialidad()->numero() : '--' }}</p>
            <a href="{{ url('expedientes/ver/' . base64_encode($expediente->getPaciente()->getId()) . '/' . base64_encode($medico->getId())) }}" class="btn btn-success btn-md" target="_blank"><i class="fa fa-eye"></i> Ver expediente completo</a>
            @if(!is_null($expediente->getExpedienteEspecialidad()) && !$expediente->getExpedienteEspecialidad()->primeraVez())
                @if($expediente->getExpedienteEspecialidad()->tieneOtrosTratamientos())
                    @if($expediente->getExpedienteEspecialidad()->otrosTratamientosAtendidos())
                        <button type="button" class="btn btn-primary btn-md" id="generarOtroTratamiento"> Generar tratamiento ortopedia / ortodoncia</button>
                    @endif
                @else
                    <button type="button" class="btn btn-primary btn-md" id="generarOtroTratamiento" data-id="{{ $expediente->getId() }}"> Generar tratamiento ortopedia / ortodoncia</button>
                @endif
            @endif
        </div>
    </div>
    <div class="separator bottom"></div>

	<div class="widget widget-tabs">
		<div class="widget-head">
			<ul>
				<li class="active"><a href="#consultas" data-toggle="tab"><i class="fa fa-user-md"></i> Consultas</a></li>
				<li class=""><a href="#interconsultas" data-toggle="tab"><i class="fa fa-search"></i> Interconsultas</a></li>
				<li class=""><a href="#plan" data-toggle="tab"><i class="fa fa-list"></i> Plan de tratamiento</a></li>
                <li class=""><a href="#otros" data-toggle="tab"><i class="fa fa-list"></i> Otros tratamientos</a></li>
				<li class=""><a href="#anexos" data-toggle="tab"><i class="fa fa-edit"></i> Anexos</a></li>
			</ul>
		</div>
		<div class="widget-body">
			<div class="tab-content">
				@include('pacientes.pacientes_consultas')
				@include('pacientes.pacientes_interconsultas')
				@include('pacientes.pacientes_plan')
                @include('pacientes.pacientes_otros_tratamientos')
				@include('pacientes.pacientes_anexos')
			</div>
		</div>
	</div>
</div>