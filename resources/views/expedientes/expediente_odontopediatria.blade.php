@extends('app_no_sidebar')

@section('titulo')
	<i class="fa fa-plus"></i> Expediente
@stop

@section('contenido')
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
								@include('expedientes.expediente_odontopediatria_pestanias')
								<div class="widget-body col-md-9 col-lg-9">
									{!!
                                        Form::open([
                                            'url'     => 'expedientes/agregarEditar',
                                            'id'      => 'formExpediente'
                                        ])
                                    !!}
									<div class="tab-content">
										<div class="form-group">
											<a href="javascript:;" title="Guardar>>" class="guardar btn btn-primary"><i class="fa fa-save"></i> Guardar datos de expediente</a>
										</div>
										@if(!isset($expediente))
											@include('expedientes.expediente_odonto_datos_personales_agregar')
											@include('expedientes.expediente_odonto_antecedentes_heredofamiliares_agregar')
											@include('expedientes.expediente_odonto_antecedentes_patologicos_agregar')
											@include('expedientes.expediente_odonto_antecedentes_odontopatologicos_agregar')
											@include('expedientes.expediente_odonto_antecedentes_odontalgicos_agregar')
											@include('expedientes.expediente_odonto_higiene_bucodental_agregar')
											@include('expedientes.expediente_odonto_habitos_orales_agregar')
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
											{!! Form::hidden('idEspecialidad', base64_encode('3'), ['id' => 'idEspecialidad']) !!}
											{!! Form::hidden('modo', '1', ['id' => 'modo']) !!}
											{!! Form::hidden('idPaciente', base64_encode($paciente->getId()), ['id' => 'idPaciente']) !!}
											{!! Form::hidden('userMedico', base64_encode($medico->getUsername()), ['id' => 'userMedico']) !!}
											<input type="hidden" name="capturada" id="capturada" value="0">
											<input type="hidden" name="foto" id="foto" value="" />
											@if(isset($expediente) && !is_null($expediente))
												{!! Form::hidden('idExpediente', base64_encode($expediente->getId()), ['id' => 'idExpediente']) !!}
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
@stop

@section('js')
	<script src="{{ asset('public/js/expedientes/expediente.js') }}"></script>
@stop