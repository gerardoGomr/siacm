@extends('app')

@section('contenido')
	<div class="row row-app">
		<div class="col-md-4 col-lg-3">
			<div class="col-separator col-unscrollable col-separator-first box">
				<h3 class="innerAll border-bottom margin-none">Pacientes citados</h3>
				<div class="innerAll bg-gray border-bottom margin-none">
					{!! Form::open(['url' => url('consultas/citas'), 'id' => 'formCitas']) !!}
						<label class="control-label">Fecha de cita:</label>
						<div class="input-group">
							<input type="text" name="txtFecha" id="txtFecha" value="" placeholder="dd/mm/aaaa" class="form-control" maxlength="10">
							<div class="input-group-btn">
								<input type="button" name="" id="btnBuscar" value="Buscar" class="btn btn-danger">
							</div>
						</div>
						<input type="hidden" name="username" value="{{ $username }}">
					{!! Form::close() !!}
				</div>

				<div class="col-table">
					<div class="col-table-row">
						<div class="col-app col-unscrollable">
							<div class="col-app">
								<input type="hidden" id="urlClickCitas" value="{{ url('consultas/cita/detalle') }}">
								<span id="citasLoading" style="display: none;"><i class="fa fa-spinner fa-spin fa-2x"></i></span>
								<ul class="list-group list-group-1 borders-none margin-none" id="listaCitas">
									@include('consultas.consultas_lista_citas')
								</ul>
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
								<span id="detalleLoading" style="display: none;"><i class="fa fa-spinner fa-spin fa-2x"></i></span>
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

@section('js')
	<script src="{{ asset('public/js/consultas/consultas.js') }}"></script>
@stop