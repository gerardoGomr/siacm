<div class="innerAll">
	<div class="row">
		<div class="col-xs-8 col-md-9 col-lg-8">
			<table class="table table-striped">
				<tr>
					<td><strong>Fecha:</strong></td>
					<td>{{ $cita->getFecha() }}</td>
				</tr>
				<tr>
					<td><strong>Hora:</strong></td>
					<td>{{ $cita->getHora() }}</td>
				</tr>
				<tr>
					<td><strong>Estatus:</strong></td>
					<td>{{ $cita->getEstatus()->getEstatus() }}</td>
				</tr>
				<tr>
					<td><strong>Paciente:</strong></td>
					<td>
						{{ $cita->getPaciente()->getNombreCompleto() }}<br>

					</td>
				</tr>
				<tr>
					<td><strong>Contacto:</strong></td>
					<td>
						<p><i class="fa fa-phone"></i> {{ $cita->getPaciente()->getTelefono() }}</p>
						<p><i class="fa fa-mobile"></i> {{ $cita->getPaciente()->getCelular() }}</p>
						<p><i class="fa fa-envelope"></i> {{ $cita->getPaciente()->getEmail() }}</p>
					</td>
				</tr>
			</table>
		</div>

		<div class="col-xs-4 col-md-3 col-lg-4">
			<div class="box-generic">
				@if (!$cita->estaAtendida())
					<a href="{{ url('consultas/capturar/'.base64_encode($cita->getPaciente()->getId()).'/'.base64_encode($cita->getMedico()->getUsername()) . '/' . base64_encode($cita->getId())) }}" class="generarConsulta btn btn-primary btn-block"><i class="fa fa-plus"></i> Generar consulta</a>
				@endif
			</div>
		</div>
	</div>
</div>