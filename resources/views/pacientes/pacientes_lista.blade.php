@if(isset($listaPacientes) && !is_null($listaPacientes))
	@foreach($listaPacientes as $paciente)
		<li class="list-group-item animated fadeInUp">
			<div class="media innerAll">
				<div class="media-body innerT half">
					<a href="{{ url('pacientes/detalle') }}" class="margin-none text-primary strong paciente">{{ $paciente->getNombreCompleto() }}</a>
					<input type="hidden" class="idPaciente" value="{{ base64_encode($paciente->getId()) }}">
					<ul class="list-unstyled margin-none">
						<li><i class="fa fa-phone"></i> {{ $paciente->getTelefono() }}</li>
						<li><i class="fa fa-mobile fa-2x"></i> {{ $paciente->getCelular() }}</li>
						<li><i class="fa fa-envelope"></i> {{ $paciente->getEmail() }}</li>
					</ul>
				</div>
			</div>
		</li>
	@endforeach
@else
	<h4>Sin resultados</h4>
@endif