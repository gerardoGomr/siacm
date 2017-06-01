@extends('app')

@section('contenido')
	<div class="row row-app">
		<div class="col-md-12">
			<div class="col-separator">
				<div class="row row-app">
					<div class="col-md-9">
						<div class="col-separator col-separator-first box">
							<div class="col-table">
								<h3 class="innerAll border-bottom margin-none">Agenda del Dr(a). {{ $medico->nombreCompleto() }}</h3>
								<div class="col-separator-h"></div>
								<div class="innerAll">
									<table>
										<tr>
											<td class="strong">Agendada:</td>
											<td style="background: #A0E1FF; width: 10px;"></td>
										</tr>
										<tr>
											<td class="strong">Confirmada:</td>
											<td style="background: #F8F7A1; width: 10px;"></td>
										</tr>
										<tr>
											<td class="strong">En espera de consulta:</td>
											<td style="background: #F8C1A1; width: 10px;"></td>
										</tr>
										<tr>
											<td class="strong">Atendida:</td>
											<td style="background: #AAEAB1; width: 10px;"></td>
										</tr>
										<tr>
											<td class="strong">Inasistencia:</td>
											<td style="background: #CBA7D0; width: 10px;"></td>
										</tr>
									</table>
								</div>
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

					<div class="col-md-3">
						<div class="col-separator col-separator-last box">
							<h4 class="innerAll bg-gray border-bottom">Pacientes citados {{ \Siacme\Aplicacion\Fecha::convertir((new \DateTime())->format('Y-m-d')) }}</h4>
							@if(!is_null($citas))
								<ul class="list-group list-group-1 borders-none margin-none">
									@foreach($citas as $cita)
										<li class="list-group-item">
											<div class="media innerAll">
												<div class="media-body">
													<h5 class="media-heading strong">{{ $cita->getPaciente()->nombreCompleto() }}</h5>
													<ul class="list-unstyled">
														<li><i class="fa fa-phone"></i> {{ $cita->getPaciente()->getTelefono() ?: '--' }}</li>
														<li><i class="fa fa-mobile"></i> {{ $cita->getPaciente()->getCelular() ?: '--' }}</li>
														<li><i class="fa fa-envelope"></i> {{ $cita->getPaciente()->getEmail() ?:  '--' }}</li>
													</ul>
												</div>
											</div>
										</li>
									@endforeach
								</ul>
							@else
								<p class="innerAll strong text-danger">No hay pacientes citados.</p>
							@endif
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
	<script src="{{ asset('js/citas/citas.js') }}"></script>
	<script src="{{ asset('js/citas/citas_agregar.js') }}"></script>
@stop