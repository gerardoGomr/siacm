@extends('app_no_sidebar')

@section('plugins_dependency')
	'/assets/components/common/forms/validator/assets/lib/jquery-validation/dist/jquery.validate.js'
@stop

@section('plugins')
	'/assets/components/modules/admin/modals/assets/js/bootbox.min.js'
@stop

@section('bundle')
	'/js/forms.js',
	'/js/citas_editar.js'
@stop

@section('titulo')
	<i class="fa fa-edit"></i> Editar cita
@stop

@section('contenido')
	<div id="dvFormCitas">
		<div class="innerAll bg-gray border-bottom">
			<p><strong>Fecha:</strong> <span>{{ $cita->getFecha() }}</span></p>
			<p><strong>Hora:</strong> <span>{{ $cita->getHora() }}</span></p>
		</div>

		<div class="innerAll bg-white border-bottom">
			{!! Form::open([
				'url'   => 'citas/actualizar',
				'id'    => 'formCita'
			]) !!}
				<div class="row">
					<div class="col-xs-6 col-md-4 col-lg-6">
						<div class="form-group">
							{!! Form::label('txtNombre', 'Nombre:', ['class' => 'control-label']) !!}
							{!! Form::text('txtNombre', $cita->getNombre(), ['class' => 'form-control', 'placeholder' => 'Sin espacios ni guiones']) !!}
						</div>
					</div>

					<div class="col-xs-6 col-md-4 col-lg-6">
						<div class="form-group">
							{!! Form::label('txtPaterno', 'Paterno:', ['class' => 'control-label']) !!}
							{!! Form::text('txtPaterno', $cita->getPaterno(), ['class' => 'form-control', 'placeholder' => 'Sin espacios ni guiones']) !!}
						</div>
					</div>

					<div class="col-xs-6 col-md-4 col-lg-6">
						<div class="form-group">
							{!! Form::label('txtMaterno', 'Materno:', ['class' => 'control-label']) !!}
							{!! Form::text('txtMaterno', $cita->getMaterno(), ['class' => 'form-control', 'placeholder' => 'ejemplo@ejemplo.com']) !!}
						</div>
					</div>

					<div class="col-xs-6 col-md-4 col-lg-6">
						<div class="form-group">
							{!! Form::label('txtTelefono', 'Teléfono:', ['class' => 'control-label']) !!}
							{!! Form::text('txtTelefono', $cita->getTelefono(), ['class' => 'form-control', 'placeholder' => 'Sin espacios ni guiones']) !!}
						</div>
					</div>

					<div class="col-xs-6 col-md-4 col-lg-6">
						<div class="form-group">
							{!! Form::label('txtCelular', 'Celular:', ['class' => 'control-label']) !!}
							{!! Form::text('txtCelular', $cita->getCelular(), ['class' => 'form-control', 'placeholder' => 'Sin espacios ni guiones']) !!}
						</div>
					</div>

					<div class="col-xs-6 col-md-4 col-lg-6">
						<div class="form-group">
							{!! Form::label('txtEmail', 'E-mail:', ['class' => 'control-label']) !!}
							{!! Form::text('txtEmail', $cita->getEmail(), ['class' => 'form-control', 'placeholder' => 'ejemplo@ejemplo.com']) !!}
						</div>
					</div>
				</div>

				<div class="innerAll bg-gray">
					<div class="form-group">
						{!! Form::button('Actualizar >>', ['class' => 'btn btn-success', 'id' => 'btnAgendar']) !!}
						{!! Form::hidden('opcion', '2', ['id' => 'opcion']) !!}
						{!! Form::hidden('idCita', $cita->getId(), ['id' => 'idCita']) !!}
						{!! Form::hidden('medico', $cita->getMedico()->getUsername(), ['id' => 'medico']) !!}
						{!! Form::hidden('urlDetalle', url('citas/detalle/'.base64_encode($cita->getId()).'/'.base64_encode($cita->getMedico()->getUsername())), ['id' => 'urlDetalle']) !!}
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
@stop