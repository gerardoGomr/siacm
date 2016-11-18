@extends('app')

@section('contenido')
	<div class="row row-app">
		<div class="col-md-12">
			<div class="col-separator col-unscrollable box col-separator-first">
				<div class="col-table">
					<div class="innerAll">
						<div class="media">
							<img src="{{ $expediente->tieneFoto() ? asset($expediente->getFotografia()->getRuta()) : '' }}" class="thumb pull-left" alt="" width="100">
							<div class="media-body innerAll half">
								<h4 class="media-heading">{{ $expediente->getPaciente()->nombreCompleto() }}</h4>
								<p>{{ $expediente->getPaciente()->getEdadAnios() }} años<br/>Vive en: {{ $expediente->getPaciente()->getLugarNacimiento() }}<br/>Expediente {{ $expediente->getExpedienteEspecialidad()->numero() }}</p>
								<p><a href="{{ url('expedientes/ver/' . base64_encode($paciente->getId()) . '/' . base64_encode($medico->getId())) }}" class="btn btn-success btn-xs" target="_blank"><i class="fa fa-eye"></i> Ver expediente</a></p>
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

												@if($expediente->getExpedienteEspecialidad()->primeraVez())
													<li>
														<a href="#expediente" data-toggle="tab"><i class="fa fa-folder-open"></i> Expediente</a>
													</li>
                                                    <li>
                                                        <a href="#odontograma" data-toggle="tab"><i class="fa fa-search"></i> Odontograma</a>
                                                    </li>
												@else
                                                    @if($expediente->getExpedienteEspecialidad()->dadoDeAlta())
                                                        <li>
                                                            <a href="#odontograma" data-toggle="tab"><i class="fa fa-search"></i> Odontograma</a>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <a href="#plan" data-toggle="tab"><i class="fa fa-search"></i> Plan Tratamiento</a>
                                                        </li>
                                                    @endif
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
													'id'    => 'formConsulta',
													'class' => 'form-horizontal'
												])
											!!}
												<div class="tab-content">
													@include('consultas.consultas_johanna_datos')
													@if($expediente->getExpedienteEspecialidad()->primeraVez())
														@include('consultas.consultas_johanna_expediente_agregar')
                                                        @include('consultas.consultas_johanna_odontograma')
                                                    @else
                                                        @if($expediente->getExpedienteEspecialidad()->dadoDeAlta())
                                                            @include('consultas.consultas_johanna_odontograma')
                                                        @else
                                                            @include('consultas.consultas_odontopediatria_plan_atencion')
                                                        @endif
													@endif

													@include('pacientes.pacientes_consultas')
												</div>
												<input type="hidden" name="medicoId" id="medicoId" value="{{ base64_encode($medico->getId()) }}">
												<input type="hidden" name="pacienteId" id="pacienteId" value="{{ base64_encode($paciente->getId()) }}">

												<input type="hidden" name="generoReceta" id="generoReceta" value="0">
												<input type="hidden" name="primeraVez" id="primeraVez" value="{{ $expediente->getExpedienteEspecialidad()->primeraVez() ? '1' : '0' }}">
												<input type="hidden" name="generoPlan" id="generoPlan" value="0">

												<input type="hidden" name="generoInterconsulta" id="generoInterconsulta" value="0">
												<input type="hidden" id="url" value="{{ url('consultas/' . base64_encode($medico->getId())) }}">
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

@include('modal_loading')
@include('consultas.consultas_plan_tratamiento')
@include('consultas.consultas_johanna_receta')
@include('consultas.consultas_johanna_interconsulta')

@section('js')
	<script src="{{ asset('js/consultas/consultas_plan_tratamiento.js') }}"></script>
	<script src="{{ asset('js/consultas/consultas_johanna_capturar.js') }}"></script>
@stop