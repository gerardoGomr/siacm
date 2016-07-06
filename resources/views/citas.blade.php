@extends('app')

@section('css')
    <link type="text/css" href="/assets/components/modules/admin/modals/assets/css/jquery.fancybox.css" rel="stylesheet" />
@stop

@section('plugins_dependency')
	'/assets/components/library/jquery-ui/js/jquery-ui.min.js?v=v1.9.6&sv=v0.0.1'
@stop

@section('plugins')
	'/assets/components/modules/admin/calendar/assets/lib/js/fullcalendar.min.js?v=v1.9.6&sv=v0.0.1',
	'/assets/components/modules/admin/modals/assets/js/jquery.fancybox.js',
	'/assets/components/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js?v=v1.9.6&sv=v0.0.1'
@stop

@section('bundle')
	'/js/citas.js'
@stop

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
						<div id="calendario"></div>
						<input type="hidden" id="medico" value="{{ $medico->getUsername() }}" />
						<input type="hidden" id="rutaCitas" value="{!! url('citas/citas/') !!}" />
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