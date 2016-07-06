@extends('app_no_sidebar')

@section('titulo')
	Capturar receta médica
@stop

@section('contenido')
	<div class="innerAll">
		{!! Form::open(['url' => url('consultas/odontograma/estatus/asignar'), 'id' => 'formReceta']) !!}
			<div class="form-group">
				<label class="control-label">Cuerpo de la receta:</label>
				<textarea name="txtReceta" id="txtReceta" class="form-control" rows="10"></textarea>
			</div>
			<div class="form-group">
				<input type="button" id="btnGuardar" value="Guardar >>" class="btn btn-success">
			</div>
		{!! Form::close() !!}
	</div>
@stop

@section('js')
	<script type="text/javascript" src="{{ asset('public/js/ajax.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/consultas/consultas_odontograma_estatus_diente.js') }}"></script>
@stop