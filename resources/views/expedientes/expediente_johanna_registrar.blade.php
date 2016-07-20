@extends('app')

@section('contenido')
	<div class="row row-app">
		<div class="col-md-12">
			<div class="col-separator col-separator-first col-unscrollable">
				<div class="col-table">
					<h3 class="innerAll border-bottom margin-none">Registrar nuevo expediente</h3>
					<div class="col-separator-h"></div>
					<div class="col-table-row">
						<div class="col-app col-unscrollable">
							<div class="col-app">
								<div class="innerAll">
									<dl class="dl-horizontal">
										<dt>Paciente:</dt>
										<dd>{{ $paciente->nombreCompleto() }}</dd>

										<dt>Médico:</dt>
										<dd>{{ $medico->nombreCompleto() }}</dd>
									</dl>
								</div>

								<div class="wizard">
									<div class="widget widget-tabs widget-tabs-double">
										<div class="widget-head">
											<ul>
												<li class="active"><a class="glyphicons camera" href="#fotografia" data-toggle="tab"><i></i> Fotografía</a></li>
												<li><a class="glyphicons list" href="#expediente" data-toggle="tab"><i></i> Expediente</a></li>
											</ul>
										</div>
										<div class="widget-body">
											<div class="tab-content">
												@include('expedientes.expediente_paciente_foto')
												<div class="tab-pane" id="expediente">
													<div class="wizard">
														<div class="widget widget-tabs widget-tabs-double widget-tabs-vertical row row-merge">
															@include('expedientes.expediente_johanna_pestanias')
															<div class="widget-body col-md-9 col-lg-9">
																{!!
                                                                    Form::open([
                                                                        'url'     => 'expedientes/registrar',
                                                                        'id'      => 'formExpediente'
                                                                    ])
                                                                !!}
																<div class="tab-content">
																	<div class="form-group">
																		<button type="button" class="guardar btn btn-primary strong"><i class="fa fa-save"></i> Registrar expediente</button>
																	</div>
																	@if(!isset($expediente))
																		@include('expedientes.expediente_registrar_datos_personales')
																		@include('expedientes.expediente_registrar_antecedentes_heredofamiliares')
																		@include('expedientes.expediente_registrar_antecedentes_patologicos')
																		@include('expedientes.expediente_johanna_registrar_antecedentes_odontopatologicos')
																		@include('expedientes.expediente_johanna_registrar_antecedentes_odontalgicos')
																		@include('expedientes.expediente_johanna_registrar_higiene_bucodental')
																		@include('expedientes.expediente_johanna_registrar_habitos_orales')
																	@else
																		@include('expedientes.expediente_odonto_datos_personales_editar')
																		@include('expedientes.expediente_odonto_antecedentes_heredofamiliares_editar')
																		@include('expedientes.expediente_odonto_antecedentes_patologicos_editar')
																		@include('expedientes.expediente_odonto_antecedentes_odontopatologicos_editar')
																		@include('expedientes.expediente_odonto_antecedentes_odontalgicos_editar')
																		@include('expedientes.expediente_odonto_higiene_bucodental_editar')
																		@include('expedientes.expediente_odonto_habitos_orales_editar')
																	@endif

																	<div class="form-group">
																		{!! Form::hidden('modo', '1', ['id' => 'modo']) !!}
																		{!! Form::hidden('pacienteId', base64_encode($paciente->getId()), ['id' => 'pacienteId']) !!}
																		{!! Form::hidden('medicoId', base64_encode($medico->getId()), ['id' => 'medicoId']) !!}
																		{!! Form::hidden('capturada', '0', ['id' => 'capturada']) !!}
																		{!! Form::hidden('foto', '0', ['id' => 'foto']) !!}

																		@if(isset($expediente) && !is_null($expediente))
																			{!! Form::hidden('expedienteId', base64_encode($expediente->getId()), ['id' => 'expedienteId']) !!}
																		@endif
																	</div>
																</div>
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
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('js')
	<script src="{{ asset('public/js/expedientes/expediente.js') }}"></script>
@stop