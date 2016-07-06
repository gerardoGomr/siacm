@extends('app_no_sidebar')

@section('titulo')
	<i class="fa fa-plus"></i> Agendar nueva cita
@stop

@section('contenido')
	<div id="dvFormCitas">
		<div class="innerAll bg-gray border-bottom">
			<p><strong>Fecha:</strong> <span>{{ $fecha }}</span></p>
			<p><strong>Hora:</strong> <span>{{ $hora }}</span></p>
		</div>

		<div class="innerAll bg-white border-bottom">
			<div class="row border-bottom">
				<div class="col-xs-6 col-md-6 col-lg-6">
					<div class="form-group">
						{!! Form::label('txtNombreBusqueda', 'Busque un paciente o seleccione nuevo:', ['class' => 'control-label']) !!}
						<div class="input-group">
							{!! Form::text('txtNombreBusqueda', null, ['class' => 'form-control', 'placeholder' => 'Ingrese nombre y/o apellidos', 'id' => 'txtNombreBusqueda']) !!}

							{!! Form::hidden('urlBusqueda', url('citas/verifica'), ['id' => 'urlBusqueda']) !!}
							<span class="input-group-btn">
								<button class="btn btn-primary" id="btnComprueba" type="button"><i class="fa fa-search"></i></button>
							</span>
						</div>
					</div>
				</div>

				<div class="col-xs-6 col-md-6 col-lg-6">
					<div class="separator"></div>
					<div class="separator"></div>
					<a href="javascript:;" id="btnPacienteNuevo" class="btn btn-primary">Es paciente nuevo</a>
				</div>
			</div>

			<div id="dvResultados" style="display: none;"></div>

			{!! Form::open([
				'url'   => 'citas/agregar',
				'id'    => 'formCita',
				'style' => 'display:none;'
			]) !!}
				<div class="row">
					<div class="col-xs-6 col-md-4 col-lg-6">
						<div class="form-group">
							{!! Form::label('txtNombre', 'Nombre:', ['class' => 'control-label']) !!}
							{!! Form::text('txtNombre', null, ['class' => 'required form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6 col-md-4 col-lg-6">
						<div class="form-group">
							{!! Form::label('txtPaterno', 'Paterno:', ['class' => 'control-label']) !!}
							{!! Form::text('txtPaterno', null, ['class' => 'required form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6 col-md-4 col-lg-6">
						<div class="form-group">
							{!! Form::label('txtMaterno', 'Materno:', ['class' => 'control-label']) !!}
							{!! Form::text('txtMaterno', null, ['class' => 'form-control']) !!}
						</div>
					</div>

					<div class="col-xs-6 col-md-4 col-lg-6">
						<div class="form-group">
							{!! Form::label('', '&nbsp;', ['class' => 'control-label']) !!}

						</div>
					</div>
				</div>
				<div class="separator bottom"></div>
				<div class="row">
					<div class="col-xs-6 col-md-4 col-lg-6">
						<div class="form-group">
							{!! Form::label('txtTelefono', 'Teléfono:', ['class' => 'control-label']) !!}
							{!! Form::text('txtTelefono', null, ['class' => 'numerosEnteros form-control', 'placeholder' => 'Sin espacios ni guiones']) !!}
						</div>
					</div>

					<div class="col-xs-6 col-md-4 col-lg-6">
						<div class="form-group">
							{!! Form::label('txtCelular', 'Celular:', ['class' => 'control-label']) !!}
							{!! Form::text('txtCelular', null, ['class' => 'required numerosEnteros form-control', 'placeholder' => 'Sin espacios ni guiones']) !!}
						</div>
					</div>

					<div class="col-xs-6 col-md-4 col-lg-6">
						<div class="form-group">
							{!! Form::label('txtEmail', 'E-mail:', ['class' => 'control-label']) !!}
							{!! Form::text('txtEmail', null, ['class' => 'email form-control', 'placeholder' => 'ejemplo@ejemplo.com']) !!}
						</div>
					</div>
				</div>

				<div class="innerAll bg-gray">
					<div class="form-group">
						{!! Form::button('Agendar >>', ['class' => 'btn btn-primary', 'id' => 'btnAgendar']) !!}
						{!! Form::hidden('opcion', '1', ['id' => 'opcion']) !!}
						{!! Form::hidden('fecha', $fecha, ['id' => 'fecha']) !!}
						{!! Form::hidden('hora', $hora, ['id' => 'hora']) !!}
						{!! Form::hidden('medico', $medico, ['id' => 'medico']) !!}
						{!! Form::hidden('nuevoPaciente', null, ['id' => 'nuevoPaciente']) !!}
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
@stop

@section('js')
	<script type="text/javascript" src="{{ asset('public/js/citas/citas_agregar.js') }}"></script>
@stop