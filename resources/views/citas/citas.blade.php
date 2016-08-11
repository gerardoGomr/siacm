@extends('app')

@section('contenido')
	<div class="row row-app">
		<div class="col-md-12">
			<div class="col-separator col-separator-first col-unscrollable">
				<div class="col-table">
					<h3 class="innerAll border-bottom margin-none">Agenda del Dr(a). {{ $medico->nombreCompleto() }}</h3>
					<div class="col-separator-h"></div>
					<div class="col-table-row">
						<div class="col-app col-unscrollable">
							<div class="col-app">
								<div class="widget">
									<div class="widget-body innerAll inner-2x">
										<div data-component>
											<a href="javascript:;" class="btn btn-success" id="generarLista" target="_blank" disabled="disabled"><i class="fa fa-print"></i> Generar lista</a>
											<div class="separator bottom"></div>
											<div id="calendario"></div>
											<input type="hidden" id="medicoId" value="{{ base64_encode($medico->getId()) }}" />
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
			</div>
		</div>
	</div>

	@include('citas.citas_agregar');
	@include('citas.citas_detalle')
	@include('modal_loading')
@stop

@section('js')
	<script src="{{ asset('public/js/citas/citas.js') }}"></script>
	<script src="{{ asset('public/js/citas/citas_agregar.js') }}"></script>
	<script src="{{ asset('public/js/citas/citas_detalle.js') }}"></script>
@stop