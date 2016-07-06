@extends('app_no_sidebar')

@section('titulo')
	<i class="fa fa-search"></i> Detalle de cita
@stop

@section('contenido')
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
						<td>{{ $cita->getPaciente()->getNombreCompleto() }}</td>
					</tr>
					<tr>
						<td><strong>Contacto:</strong></td>
						<td>
							<p><i class="fa fa-phone"></i> {{ !empty($cita->getPaciente()->getTelefono()) ? $cita->getPaciente()->getTelefono() : '--' }}</p>
							<p><i class="fa fa-mobile"></i> {{ !empty($cita->getPaciente()->getCelular()) ? $cita->getPaciente()->getCelular() : '--' }}</p>
							<p><i class="fa fa-envelope"></i> {{ !empty($cita->getPaciente()->getEmail()) ? $cita->getPaciente()->getEmail() : '--' }}</p>
						</td>
					</tr>
				</table>
			</div>

			<div class="col-xs-4 col-md-3 col-lg-4">

				<div class="separator bottom"></div>
				<div id="dvOpciones">
					@include('citas.citas_detalle_opciones_refrescar')
				</div>

				<input type="hidden" id="idCita" value="{{ base64_encode($cita->getId()) }}" />
				<input type="hidden" id="idPaciente" value="{{ base64_encode($cita->getPaciente()->getId()) }}" />
				<input type="hidden" id="userMedico" value="{{ base64_encode($cita->getMedico()->getUsername()) }}" />
				@if(!is_null($expediente))
					<input type="hidden" id="nuevoPaciente" value="0" />
				@else
					<input type="hidden" id="nuevoPaciente" value="1" />
				@endif
				<input type="hidden" id="urlEstatus" value="{{ url('citas/estatus') }}" />
				<input type="hidden" id="urlVerExpediente" value="{{ url('expedientes/ver/') }}" />
				<input type="hidden" id="urlReprogramar" value="{{ url('citas/guardaEnSesion') }}" />
				<input type="hidden" id="urlExpediente" value="{{ url('expedientes/agregar/') }}" />
				<input type="hidden" id="_token" value="{{ csrf_token() }}" />
				<input type="hidden" id="idConfirmar" value="2" />
				<input type="hidden" id="idCancelar" value="5" />
				<input type="hidden" id="idReprogramar" value="6" />
				<input type="hidden" id="especialidad" value="{{ $cita->getMedico()->getEspecialidad()->getId() }}" />
			</div>
		</div>
	</div>
@stop

@section('js')
	<script type="text/javascript" src="{{ asset('public/js/citas/citas_detalle.js') }}"></script>
@stop