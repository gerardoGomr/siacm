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

	@include('citas.citas_agregar');
	@include('citas.citas_detalle')
	@include('modal_loading')
@stop

@section('js')
	<script type="text/javascript" src="{{ asset('public/js/citas/citas.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/citas/citas_agregar.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/citas/citas_detalle.js') }}"></script>
@stop