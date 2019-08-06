@extends('app')

@section('contenido')
	<div class="row row-app">
		<div class="col-md-12">
			<div class="col-separator col-unscrollable box col-separator-first">
				<div class="col-table">
					@include('consultas.consultas_fotografia')

					<div class="col-separator-h"></div>

					<div class="col-table-row">
						<div class="col-app col-unscrollable">
							<div class="col-app">
								<div class="relativeWrap">
									<div class="widget widget-tabs widget-tabs-responsive">
										<div class="widget-head">
											<ul>
												<li class="active"><a href="#consulta" data-toggle="tab"><i class="fa fa-user"></i> Consulta</a></li>
												<li><a href="#consultas" data-toggle="tab"><i class="fa fa-stethoscope"></i> Historial de consultas</a></li>
												<li><a href="#interconsultas" data-toggle="tab"><i class="fa fa-search"></i> Interconsultas</a></li>
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
													@include('consultas.consultas_rigoberto_datos')
													@include('consultas.pacientes_consultas')
													@include('pacientes.pacientes_interconsultas')
												</div>
												<input type="hidden" name="medicoId" id="medicoId" value="{{ base64_encode($medico->getId()) }}">
												<input type="hidden" name="pacienteId" id="pacienteId" value="{{ base64_encode($paciente->getId()) }}">

												<input type="hidden" name="generoReceta" id="generoReceta" value="0">
												<input type="hidden" name="generoHigieneDental" id="generoHigieneDental" value="0">
												<!-- <input type="hidden" name="generoIndicacion" id="generoIndicacion" value="0"> -->
												<input type="hidden" name="primeraVez" id="primeraVez" value="{{ $expediente->getExpedienteRigoberto()->primeraVez() ? '1' : '0' }}">
												<input type="hidden" name="dadoAlta" id="dadoAlta" value="{{ $expediente->getExpedienteRigoberto()->dadoDeAlta() ? '1' : '0' }}">

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

    @include('modal_loading')
    @include('consultas.consultas_johanna_interconsulta')
@stop

@section('js')
	<script src="{{ asset('js/consultas/consultas_rigoberto_capturar.js') }}"></script>
@stop