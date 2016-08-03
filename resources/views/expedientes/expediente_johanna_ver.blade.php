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
									<dl class="dl-horizontal">
										<dt>Paciente:</dt>
										<dd>{{ $expediente->getPaciente()->nombreCompleto() }}</dd>

										<dt>Expediente:</dt>
										<dd>{{ $expediente->getExpedienteEspecialidad()->getId() }}</dd>
									</dl>
								</div>
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
													<button type="button" id="firmar" class="btn btn-primary"><i class="fa fa-check"></i> Los datos del expediente están correctos</button>
													<a href="{{ url('expedientes/registrar/'.base64_encode($expediente->getPaciente()->getId()).'/'.base64_encode($medico->getId())) }}" class="btn btn-danger"><i class="fa fa-edit"></i> Editar expediente</a>
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
@stop

@section('js')
	<script type="text/javascript" src="{{ asset('public/js/expedientes/expediente_ver.js') }}"></script>
@stop