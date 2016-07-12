@extends('app')

@section('titulo')
	<i class="fa fa-calendar"></i>
@stop

@section('contenido')
	<div class="row row-app">
		<div class="col-md-11">
			<div class="col-separator col-unscrollable col-separator-first">
				<div class="col-table">
					<h3 class="innerAll border-bottom margin-none">Agenda del Dr(a). {{ $medico->nombreCompleto() }}</h3>
					<div class="col-separator-h"></div>
					<div class="col-table-row">
						<div class="col-app col-unscrollable">
							<div class="col-app">
								<div class="innerAll" data-component>
									<div><a href="javascript:;" class="btn btn-success" id="generarLista" target="_blank" disabled="disabled"><i class="fa fa-print"></i> Generar lista</a></div>
									<div class="separator bottom"></div>
									<div id="calendario"></div>
									<input type="hidden" id="medico" value="{{ $medico->getUsername() }}" />
									<input type="hidden" id="rutaCitas" value="{!! url('citas/') !!}" />
									<input type="hidden" id="rutaPdf" value="{{ url('citas/lista/pdf') }}" />
									<input type="hidden" id="reprogramar" value="0" />
									<input type="hidden" id="_token" value="{{ csrf_token() }}" />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-1"></div>
	</div>

	<div class="modal fade" id="modalAgendarCita">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal heading -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h2 class="modal-title">Agendar nueva cita</h2>
				</div>

				<div class="modal-body">
					{{--<div class="innerAll bg-gray border-bottom">--}}
						{{--<p><strong>Fecha:</strong> <span></span></p>--}}
						{{--<p><strong>Hora:</strong> <span></span></p>--}}
					{{--</div>--}}

						<div class="form-group">
							<label for="nombreBusqueda" class="control-label col-md-2">Paciente:</label>
							<div class="col-md-9">
								<div class="input-group">
									<input type="text" name="nombreBusqueda" id="nombreBusqueda" class="form-control" placeholder="Ingrese nombre y/o apellidos">
								<span class="input-group-btn">
									<button class="btn btn-primary" id="btnComprueba" type="button"><i class="fa fa-search"></i></button>
								</span>
								</div>
							</div>
							<input type="hidden" id="urlBusqueda" value="{{ url('citas/verifica') }}">
						</div>
						<div id="dvResultados" style="display: none;"></div>
						<div class="datos">
							<div class="form-group">
								<label for="nombre" class="control-label col-md-2">Nombre:</label>
								<div class="col-md-9">
									<input type="text" name="nombre" id="nombre" class="form-control required">
								</div>
							</div>
							<div class="form-group">
								<label for="paterno" class="control-label col-md-2">Paterno:</label>
								<div class="col-md-9">
									<input type="text" name="paterno" id="paterno" class="form-control required">
								</div>
							</div>
							<div class="form-group">
								<label for="materno" class="control-label col-md-2">Materno:</label>
								<div class="col-md-9">
									<input type="text" name="materno" id="materno" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label for="telefono" class="control-label col-md-2">Teléfono:</label>
								<div class="col-md-9">
									<input type="text" name="telefono" id="telefono" class="form-control numerosEnteros" placeholder="Sin espacios ni guiones">
								</div>
							</div>
							<div class="form-group">
								<label for="celular" class="control-label col-md-2">Celular:</label>
								<div class="col-md-9">
									<input type="text" name="celular" id="celular" class="form-control required numerosEnteros" placeholder="Sin espacios ni guiones">
								</div>
							</div>
							<div class="form-group">
								<label for="email" class="control-label col-md-2">Email:</label>
								<div class="col-md-9">
									<input type="text" name="email" id="email" class="form-control email" placeholder="ejemplo@ejemplo.com">
								</div>
							</div>
						</div>
					
				</div>

				<div class="modal-footer">
					<button type="button" id="agendarCita" class="btn btn-primary">Agendar cita</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

					{{--{!! Form::hidden('opcion', '1', ['id' => 'opcion']) !!}--}}
					{{--{!! Form::hidden('fecha', $fecha, ['id' => 'fecha']) !!}--}}
					{{--{!! Form::hidden('hora', $hora, ['id' => 'hora']) !!}--}}
					{{--{!! Form::hidden('medico', $medico, ['id' => 'medico']) !!}--}}
					{{--{!! Form::hidden('nuevoPaciente', null, ['id' => 'nuevoPaciente']) !!}--}}
				</div>
			</div>
		</div>
	</div>
@stop

@section('js')
	<script type="text/javascript" src="{{ asset('public/js/citas/citas.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/citas/citas_agregar.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/citas/citas_detalle.js') }}"></script>
@stop