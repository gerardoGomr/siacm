@extends('app')

@section('contenido')
	<div class="row row-app">
		<div class="col-md-12">
			<div class="col-separator col-unscrollable box col-separator-first">
				<div class="col-table">
					<div class="innerAll">
						<div class="media">
							<img src="{{ $expediente->getPaciente()->tieneFoto() ? asset($expediente->getPaciente()->getFotografia()->getRuta()) : '' }}" class="thumb pull-left" alt="" width="100">
							<div class="media-body innerAll half">
								<h4 class="media-heading">{{ $expediente->getPaciente()->getNombreCompleto() }}</h4>
								<p>{{ $expediente->getPaciente()->getEdadAnios() }} años<br/>Vive en: {{ $expediente->getPaciente()->getLugarNacimiento() }}<br/>Expediente {{ $expediente->numeroExpediente() }}</p>
							</div>
						</div>
					</div>

					<div class="col-separator-h"></div>

					<div class="col-table-row">
						<div class="col-app col-unscrollable">
							<div class="col-app">
								<div class="relativeWrap">
									<div class="widget widget-tabs widget-tabs-responsive">
										<div class="widget-head">
											<ul>
												<li class="active">
													<a href="#consulta" data-toggle="tab"><i class="fa fa-user"></i> Consulta</a>
												</li>

												@if($expediente->primeraVez() === true)
													<li>
														<a href="#expediente" data-toggle="tab"><i class="fa fa-folder-open"></i> Expediente</a>
													</li>
												@endif
												@if($expediente->tienePlanesTratamiento())
													<?php $atendido = true; ?>
													@foreach($expediente->getListaPlanesTratamiento() as $plan)
														<?php
														if (!$plan->atendido()) {
															$atendido = false;
														}
														?>
													@endforeach

													@if ($atendido)
														<li>
															<a href="#odontograma" data-toggle="tab"><i class="fa fa-search"></i> Odontograma</a>
														</li>
													@endif
												@else
													<li>
														<a href="#odontograma" data-toggle="tab"><i class="fa fa-search"></i> Odontograma</a>
													</li>
												@endif
												@if(!$expediente->primeraVez() && $atendido === false)
													<li>
														<a href="#plan" data-toggle="tab"><i class="fa fa-search"></i> Plan Tratamiento</a>
													</li>
												@endif

												<li>
													<a href="#consultas" data-toggle="tab"><i class="fa fa-stethoscope"></i> Historial de consultas</a>
												</li>
											</ul>
										</div>
										<div class="widget-body">
											{!!
												Form::open([
													'url'   => 'consultas/guardar',
													'id'    => 'formConsulta'
												])
											!!}
												<div class="tab-content">
													@include('consultas.consultas_odontopediatria_consulta_agregar')
													@if($expediente->primeraVez())
														@include('consultas.consultas_odontopediatria_expediente_agregar')
													@endif
													@if($expediente->tienePlanesTratamiento())
														<?php $atendido = true; ?>
														@foreach($expediente->getListaPlanesTratamiento() as $plan)
															<?php
																if (!$plan->atendido()) {
																	$atendido = false;
																}
															?>
														@endforeach

														@if ($atendido)
															@include('consultas.consultas_odontopediatria_odontograma')
														@endif
													@else
														@include('consultas.consultas_odontopediatria_odontograma')
													@endif

													@if(!$expediente->primeraVez() && $atendido === false)
														@include('consultas.consultas_odontopediatria_plan_atencion')
													@endif

													@include('pacientes.pacientes_consultas')
												</div>
												<input type="hidden" name="userMedico" id="userMedico" value="{{ base64_encode($expediente->getMedico()->getUsername()) }}">
												<input type="hidden" name="idPaciente" id="idPaciente" value="{{ base64_encode($expediente->getPaciente()->getId()) }}">

												<input type="hidden" name="generoReceta" id="generoReceta" value="0">
												<input type="hidden" name="primeraVez" id="primeraVez" value="{{ $expediente->primeraVez() ? '1' : '0' }}">
												<input type="hidden" name="generoPlan" id="generoPlan" value="0">
												<input type="hidden" name="atendido" id="atendido" value="<?php 
													if($expediente->tienePlanesTratamiento()) {
														$atendido = true;
														foreach($expediente->getListaPlanesTratamiento() as $plan) {
															if (!$plan->atendido()) {
																$atendido = false;
															}
														}

														if ($atendido) {
															echo '1';
														} else {
															echo '0';
														}
													}
												?>">
												<input type="hidden" name="generoInterconsulta" id="generoInterconsulta" value="0">
												<input type="hidden" name="idCita" id="idCita" value="{{ $idCita }}">
												<input type="hidden" id="url" value="{{ url('consultas') }}">
											{!! Form::close() !!}
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
@stop

@section('js')
	<script src="{{ asset('public/js/consultas/consultas_odontopediatria_capturar.js') }}"></script>
@stop