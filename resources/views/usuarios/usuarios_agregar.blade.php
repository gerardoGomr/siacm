@extends('app_')

@section('contenido')
	<div class="row row-app">
		<div class="col-sm-12">
			<div class="col-separator col-separator-first col-unscrollable">
				<div class="col-table">
					<h4 class="innerAll border-bottom margin-none">Agregar usuario</h4>
					<div class="col-table-row">
						<div class="col-app col-unscrollable">
							<div class="col-app">
								<div class="innerAll">
									{!! Form::open(['url' => route('usuarios-agregar'), 'id' => 'formUsuario', 'class'=> 'form-horizontal']) !!}
									<button type="button" id="guardarForm" class="btn btn-primary"><i class="fa fa-plus"></i> Agregar</button>
									<div class="separator bottom"></div>
									<div class="row">
										<div class="col-sm-12 col-lg-6">
											<div class="box-generic">
												<h5>Datos de usuario</h5>
												<div class="innerAll">
													<div class="form-group">
														<label class="control-label col-sm-4 col-lg-2">Clave de usuario:</label>
														<div class="col-sm-8 col-lg-10">
															<input type="text" name="clave" id="clave" class="form-control required" placeholder="Ejemplo: maria.perez">
														</div>
													</div>

													<div class="form-group">
														<label class="control-label col-sm-4 col-lg-2">Contraseña:</label>
														<div class="col-sm-8 col-lg-10">
															<input type="password" name="passwd" id="passwd" class="form-control required">
														</div>
													</div>

													<div class="form-group">
														<label class="control-label col-sm-4 col-lg-2">Tipo de usuario:</label>
														<div class="col-sm-8 col-lg-10">
															<select name="tipoUsuario" id="tipoUsuario" class="form-control required">
																<option value="">Seleccione</option>
																@foreach($tipoUsuarios as $tipoUsuario)
																	<option value="{{ $tipoUsuario->getId() }}">{{ $tipoUsuario->getUsuarioTipo() }}</option>
																@endforeach
															</select>
														</div>
													</div>

													<div class="form-group">
														<label class="control-label col-sm-4 col-lg-2">Especialidad:</label>
														<div class="col-sm-8 col-lg-10">
															<select name="especialidad" id="especialidad" class="form-control required">
																<option value="">Sin especialidad</option>
																@foreach($especialidades as $especialidad)
																	<option value="{{ $especialidad->getId() }}">{{ $especialidad->getEspecialidad() }}</option>
																@endforeach
															</select>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-12 col-lg-6">
											<div class="box-generic">
												<h5>Datos personales</h5>
												<div class="innerAll">
													<div class="form-group">
														<label class="control-label col-sm-4 col-lg-2">Nombre:</label>
														<div class="col-sm-8 col-lg-10">
															<input type="text" name="nombre" id="nombre" class="form-control required">
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-sm-4 col-lg-2">A. Paterno:</label>
														<div class="col-sm-8 col-lg-10">
															<input type="text" name="paterno" id="paterno" class="form-control required">
														</div>
													</div>

													<div class="form-group">
														<label class="control-label col-sm-4 col-lg-2">A. Materno:</label>
														<div class="col-sm-8 col-lg-10">
															<input type="text" name="materno" id="materno" class="form-control">
														</div>
													</div>

													<div class="form-group">
														<label class="control-label col-sm-4 col-lg-2">Teléfono:</label>
														<div class="col-sm-8 col-lg-10">
															<input type="text" name="telefono" id="telefono" class="form-control">
														</div>
													</div>

													<div class="form-group">
														<label class="control-label col-sm-4 col-lg-2">Celular:</label>
														<div class="col-sm-8 col-lg-10">
															<input type="text" name="celular" id="celular" class="form-control">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
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
	<script type="text/javascript" src="{{ asset('public/assets/components/common/forms/validator/assets/lib/jquery-validation/dist/jquery.validate.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/assets/components/common/forms/validator/assets/lib/jquery-validation/dist/additional-methods.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/assets/components/modules/admin/modals/assets/js/jquery.fancybox.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/validaciones.js') }}"></script>
	<script src="{{ asset('public/js/usuarios/usuarios_agregar.js') }}"></script>
@stop