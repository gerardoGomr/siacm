@extends('app')

@section('contenido')
	<style>
		ul.list-group {
			cursor: pointer;
		}
	</style>
	<div class="row row-app">
		<div class="col-md-4 col-lg-3">
			<div class="col-separator col-unscrollable col-separator-first box">
				<h3 class="innerAll border-bottom margin-none">Pacientes citados</h3>
				<div class="innerAll bg-gray border-bottom margin-none">
					{!! Form::open(['url' => url('consultas/citas'), 'id' => 'formCitas']) !!}
						{!! csrf_field() !!}
						<div class="form-group">
							<div class="input-group">
								<input type="text" name="fecha" id="fecha" value="" placeholder="Elija la fecha de la cita" class="form-control" readonly>
								<span class="input-group-addon"><i class="fa fa-th"></i></span>
							</div>
							<input type="hidden" name="medicoId" value="{{ base64_encode($medico->getId()) }}">
						</div>
					{!! Form::close() !!}
				</div>

				<div class="col-table">
					<div class="col-table-row">
						<div class="col-app col-unscrollable">
							<div class="col-app">
								<div id="resultadoCitas" data-url="{{ url('consultas/cita/detalle') }}">
									@include('consultas.consultas_lista_citas')
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-8 col-lg-9">
			<div class="col-separator col-unscrollable">
				<div class="col-table">
					<h3 class="innerAll border-bottom margin-none">Detalles</h3>
					<div class="col-table-row">
						<div class="col-app col-unscrollable">
							<div class="col-app">
								<div id="dvDetalles">

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@include('modal_loading')

@section('js')
	<script src="{{ asset('public/js/consultas/consultas.js') }}"></script>
@stop