@extends('app')

@section('titulo')
	<i class="fa fa-calendar"></i> Agenda del Dr(a). {{ $medico->getNombreCompleto() }}
@stop

@section('contenido')

	<div class="row">
		<!-- col -->
		<div class="col-md-12 col-lg-9">
			<div class="widget">
				<div class="widget-body innerAll inner-2x">
					<div data-component>
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

		<div class="col-md-12 col-lg-3">
			<div class="widget">
				<div class="widget-body innerAll inner-2x">

				</div>
			</div>

		</div>
	</div>
@stop

@section('js')
	<script type="text/javascript" src="{{ asset('public/js/citas/citas.js') }}"></script>
@stop