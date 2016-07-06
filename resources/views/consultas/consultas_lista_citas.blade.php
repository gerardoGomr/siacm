@if(!is_null($listaCitas))
	@foreach($listaCitas as $cita)
		<li class="list-group-item animated fadeInUp">
			<div class="media innerAll">
				<div class="media-body innerT half">
					<a href="javascript:;" class="margin-none text-primary strong paciente">{{ $cita->getPaciente()->getNombreCompleto() }}</a>
					<input type="hidden" name="idCita" value="{{ base64_encode($cita->getId()) }}">
					<ul class="list-unstyled margin-none">
						<li><i class="fa fa-phone"></i> {{ $cita->getPaciente()->getTelefono() }}</li>
						<li><i class="fa fa-mobile fa-2x"></i> {{ $cita->getPaciente()->getCelular() }}</li>
						<li><i class="fa fa-envelope"></i> {{ $cita->getPaciente()->getEmail() }}</li>
					</ul>
				</div>
			</div>
		</li>
	@endforeach
@else
	<h4>Sin resultados</h4>
@endif