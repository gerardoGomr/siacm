@extends('app')

@section('contenido')
	<div class="row row-app">
		<div class="col-md-12">
			<div class="col-separator col-separator-first col-unscrollable">
				<div class="col-table">
					<h3 class="innerAll border-bottom margin-none">Revision de expediente</h3>
					<div class="col-separator-h"></div>
					<div class="col-table-row">
						<div class="col-app col-unscrollable">
							<div class="col-app">
                                <div class="innerAll">
                                    <div class="media">
                                        @if(isset($expediente) && $expediente->tieneFoto())
                                            <img src="{{ url('expedientes/foto/mostrar/' . base64_encode($expediente->getFotografia()->getRuta())) . '?' . rand() }}" id="fotoCapturada" class="pull-left"  width="">
                                        @endif
                                        <div class="media-body innerAll half">
                                            <h4 class="media-heading">{{ $expediente->getPaciente()->nombreCompleto() }}</h4>
                                            <p>{{ $expediente->getPaciente()->edadCompleta() }}<br/>Vive en: {{ $expediente->getPaciente()->getLugarNacimiento() }}<br/>Expediente {{ $expediente->getExpedienteEspecialidad()->numero() }}</p>
                                        </div>
                                    </div>
                                </div>
								<div class="col-separator-h"></div>
								<div class="innerAll">
									<div class="wizard">
										<div class="widget widget-tabs widget-tabs-double widget-tabs-vertical row row-merge" id="widgetForm">
										@include('expedientes.expediente_johanna_pestanias')
										<div class="widget-body col-md-9 col-lg-9">
											{!!
												Form::open([
													'url'   => 'expedientes/registrar',
													'id'    => 'formExpediente',
													'class' => 'form-horizontal'
												])
											!!}
												<div class="innerAll">
													@if(!$expediente->getExpedienteEspecialidad()->revisado())
														<button type="button" id="firmar" class="btn btn-primary"><i class="fa fa-check"></i> Los datos del expediente están correctos</button>
													@endif
													<a href="{{ url('expedientes/registrar/'.base64_encode($expediente->getPaciente()->getId()).'/'.base64_encode($medico->getId())) }}" class="btn btn-danger"><i class="fa fa-edit"></i> Editar expediente</a>
                                                        <a href="{{ url('expedientes/pdf/' . base64_encode($expediente->getId()) . '/' . base64_encode($medico->getId())) }}" class="btn btn-success" target="_blank"><i class="fa fa-print"></i> Imprimir expediente</a>
													{!! csrf_field() !!}
													{!! Form::hidden('pacienteId', base64_encode($expediente->getPaciente()->getId()), ['id' => 'pacienteId']) !!}
													{!! Form::hidden('medicoId', base64_encode($medico->getId()), ['id' => 'medicoId']) !!}
													<input type="hidden" id="urlFirmar" value="{{ url('expedientes/firmar') }}">
												</div>
												<div class="tab-content">
													@include('expedientes.expediente_ver_datos_personales')
													@include('expedientes.expediente_ver_antecedentes_heredofamiliares')
													@include('expedientes.expediente_ver_antecedentes_patologicos')
													@include('expedientes.expediente_johanna_ver_antecedentes_odontopatologicos')
													@include('expedientes.expediente_johanna_ver_antecedentes_odontalgicos')
													@include('expedientes.expediente_johanna_ver_higiene_bucodental')
													@include('expedientes.expediente_johanna_ver_habitos_orales')
                                                    @if($expediente->tieneConsultas($medico))
                                                        @include('consultas.consultas_johanna_expediente_ver')
                                                    @endif
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
	@include('modal_loading')
@stop

@section('js')
	<script src="{{ asset('js/expedientes/expediente_ver.js') }}"></script>
@stop