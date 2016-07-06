@extends('app_no_sidebar')

@section('plugins')
	'/assets/components/modules/admin/modals/assets/js/bootbox.min.js'
@stop

@section('bundle')
	'/js/forms.js',
	'/js/citas_agregar.js'
@stop

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
						<td>{{ $cita->getNombreCompleto() }}</td>
					</tr>
					<tr>
						<td><strong>Contacto:</strong></td>
						<td>
							<p><i class="fa fa-phone"></i> {{ $cita->getTelefono() }}</p>
							<p><i class="fa fa-mobile"></i> {{ $cita->getCelular() }}</p>
							<p><i class="fa fa-envelope"></i> {{ $cita->getEmail() }}</p>
						</td>
					</tr>

				</table>
			</div>

			<div class="col-xs-4 col-md-3 col-lg-4">
				<a href="{!! url('citas/editar/'.base64_encode($cita->getId())) !!}" title="Editar" class="btn btn-primary btn-block"><i class="fa fa-edit"></i> Editar Cita</a>
				<a href="" title="Editar" class="btn btn-success btn-block"><i class="fa fa-edit"></i> Editar</a>
				<a href="" title="Editar" class="btn btn-info btn-block"><i class="fa fa-edit"></i> Editar</a>
				<a href="" title="Editar" class="btn btn-warning btn-block"><i class="fa fa-edit"></i> Editar</a>
			</div>
		</div>
	</div>
@stop