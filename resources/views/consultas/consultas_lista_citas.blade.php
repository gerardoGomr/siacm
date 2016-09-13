@if(!is_null($citas))
	<ul class="list-group list-group-1 borders-none margin-none">
		@foreach($citas as $cita)
			<li class="list-group-item animated fadeInUp paciente" data-id="{{ base64_encode($cita->getId()) }}">
				<div class="media innerAll">
					<div class="media-body">
						<h5 class="media-heading strong text-primary">{{ $cita->getPaciente()->nombreCompleto() }}</h5>
						<ul class="list-unstyled">
							<li><i class="fa fa-phone"></i> {{ !empty($cita->getPaciente()->getTelefono()) ? $cita->getPaciente()->getTelefono(): '--' }}</li>
							<li><i class="fa fa-mobile"></i> {{ !empty($cita->getPaciente()->getCelular()) ? $cita->getPaciente()->getCelular() : '--' }}</li>
							<li><i class="fa fa-envelope"></i> {{ !empty($cita->getPaciente()->getEmail()) ? $cita->getPaciente()->getEmail() : '--' }}</li>
						</ul>
					</div>
				</div>
			</li>
		@endforeach
	</ul>
@else
	@if(isset($fecha))
		<p class="strong innerAll">Sin resultados para el día {{ Siacme\Aplicacion\Fecha::convertir((DateTime::createFromFormat('Y-m-d', $fecha))->format('Y-m-d')) }}</p>
	@else
		<p class="strong innerAll">Sin resultados para el día {{ Siacme\Aplicacion\Fecha::convertir((new DateTime())->format('Y-m-d')) }}</p>
	@endif
@endif