@extends('app_no_sidebar')

@section('titulo')
	Estatus dental
@stop

@section('contenido')
	<div class="innerAll">
		{!! Form::open(['url' => url('consultas/odontograma/estatus/asignar'), 'id' => 'formDienteEstatus']) !!}
			<div class="row">
				@foreach ($listaDientesEstatus as $dienteEstatus)
					<div class="col-xs-6 col-lg-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="estatus[]" class="estatus" value="{{ $dienteEstatus->getId() }}"> {{ $dienteEstatus->getNombre() }}
								</label>
							</div>
						</div>
					</div>
				@endforeach
			</div>

			<div class="form-group">
				<input type="hidden" name="diente" value="{{ base64_encode($numeroDiente) }}">
				<input type="button" id="btnGuardar" value="Aceptar" class="btn btn-success btn-block">
			</div>
		{!! Form::close() !!}
	</div>
@stop

@section('js')
	<script type="text/javascript" src="{{ asset('public/js/ajax.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/consultas/consultas_odontograma_estatus_diente.js') }}"></script>
@stop