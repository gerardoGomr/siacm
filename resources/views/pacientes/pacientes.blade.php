@extends('app')

@section('contenido')
	<div class="row row-app">
		<div class="col-md-4 col-lg-3">
			<div class="col-separator col-unscrollable col-separator-first box">
				<h3 class="innerAll border-bottom margin-none">Búsqueda de pacientes</h3>
				<div class="innerAll bg-gray border-bottom margin-none">
					{!! Form::open(['url' => url('pacientes/buscar'), 'id' => 'formPaciente']) !!}
						<label class="control-label">Nombre de paciente:</label>
						<input type="text" name="txtPaciente" id="txtPaciente" value="" placeholder="Escriba nombre o apellidos" class="form-control">
						<input type="hidden" name="username" id="username" value="{{ $medico->getUsername() }}">
					{!! Form::close() !!}
				</div>

				<div class="col-table">
					<div class="col-table-row">
						<div class="col-app col-unscrollable">
							<div class="col-app">
								<input type="hidden" id="urlClickCitas" value="{{ url('pacientes/detalle') }}">
								<span id="pacientesLoading" style="display: none;"><i class="fa fa-spinner fa-spin fa-2x"></i></span>
								<ul class="list-group list-group-1 borders-none margin-none" id="listaPacientes">
									@include('pacientes.pacientes_lista')
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-8 col-lg-9">
			<div class="col-separator col-unscrollable">
				<div class="col-table">
					<h3 class="innerAll border-bottom margin-none">Detalles</h3>
					<div class="col-table-row">
						<div class="col-app col-unscrollable">
							<div class="col-app">
								<span id="detalleLoading" style="display: none;"><i class="fa fa-spinner fa-spin fa-2x"></i></span>
								<div id="dvDetalles">

								</div>
								<div id="dvOtroTratamiento" class="modal fade">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title">Capturar tratamiento</h4>
												<button class="close" aria-hidden="true" data-dismiss="modal" type="button">x</button>
											</div>
											<div class="modal-body">
												{!! Form::open(['url' => url('pacientes/tratamiento/agregar'), 'id' => 'formOtroTratamiento', 'class' => 'form-horizontal'])  !!}
												<div class="form-group">
													<label class="control-label col-md-3">Tratamiento:</label>
													<div class="col-md-9">
														<div class="checkbox">
															<label>
																<input type="checkbox" name="ortodoncia"> Ortodoncia
															</label>
														</div>

														<div class="checkbox">
															<label>
																<input type="checkbox" name="ortopedia"> Ortopedia
															</label>
														</div>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">DX:</label>
													<div class="col-md-9">
														<input type="text" name="dx" id="dx" class="form-control required">
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Costo:</label>
													<div class="col-md-3">
														<div class="input-group">
															<span class="input-group-addon">$</span>
															<input type="text" name="costo" id="costo" class="form-control required numeros">
														</div>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Duración aproximada:</label>
													<div class="col-md-3">
														<div class="input-group">
															<input type="text" name="duracion" id="duracion" class="form-control required numerosEnteros">
															<span class="input-group-addon">Años</span>
														</div>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Mensualidades:</label>
													<div class="col-md-3">
														<input type="text" name="mensualidades" id="mensualidades" class="form-control required numerosEnteros">
													</div>
												</div>

												<div class="form-group">
													<div class="col-md-9 col-md-offset-3">
														<input type="button" id="guardarFormOtros" class="btn btn-primary" value="Generar tratamiento">
														<input type="hidden" name="username" id="userOtroTratamiento">
														<input type="hidden" name="idPaciente" id="idPacienteOtroTratamiento">
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
@stop

@section('js')
	<script type="text/javascript" src="{{ asset('public/js/pacientes/pacientes.js') }}"></script>
@stop