@extends('app')

@section('contenido')
	<?php use Siacme\Dominio\Usuarios\Rol; ?>
	<div class="row row-app">
		<div class="col-sm-12">
			<div class="col-separator col-separator-first col-unscrollable">
				<div class="col-table">
					<h3 class="innerAll margin-none">Agregar usuario</h3>
					<div class="col-separator-h"></div>
					<div class="col-table-row">
						<div class="col-app col-unscrollable">
							<div class="col-app">
								<div class="innerAll">
									<form action="/usuarios/agregar" id="formUsuario" class="form-horizontal">
										<h5>Datos de usuario</h5>
										<div class="form-group">
											<label for="clave" class="control-label col-md-3 col-lg-2">Clave de usuario:</label>
											<div class="col-md-3 col-lg-2">
												<input type="text" name="clave" id="clave" class="form-control required" placeholder="Ejemplo: maria.perez">
											</div>
										</div>

										<div class="form-group">
											<label for="passwd" class="control-label col-md-3 col-lg-2">Contraseña:</label>
											<div class="col-md-3 col-lg-2">
												<input type="password" name="passwd" id="passwd" class="form-control required">
											</div>
										</div>

										<div class="form-group">
											<label for="rol" class="control-label col-md-3 col-lg-2">Rol de usuario:</label>
											<div class="col-sm-8 col-lg-10">
												<div class="radio">
													<label>
														<input type="radio" name="rol" value="{{ Rol::MEDICO }}"> Médico
													</label>
												</div>
												<div class="radio">
													<label>
														<input type="radio" name="rol" value="{{ Rol::ASISTENTE }}"> Asistente
													</label>
												</div>
												<div class="radio">
													<label>
														<input type="radio" name="rol" value="{{ Rol::RECEPCIONISTA }}"> Recepcionista
													</label>
												</div>
											</div>
										</div>

										<div class="form-group">
											<label for="especialidad" class="control-label col-md-3 col-lg-2">Especialidad:</label>
											<div class="col-md-4 col-lg-3">
												<select name="especialidad" id="especialidad" class="form-control required">
													<option value="">Sin especialidad</option>
													@foreach($especialidades as $especialidad)
														<option value="{{ $especialidad->getId() }}">{{ $especialidad->getEspecialidad() }}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="separator border-bottom"></div>
										<h5>Datos personales</h5>
										<div class="form-group">
											<label for="nombre" class="control-label col-md-3 col-lg-2">Nombre:</label>
											<div class="col-md-3 col-lg-2">
												<input type="text" name="nombre" id="nombre" class="form-control required">
											</div>
										</div>
										<div class="form-group">
											<label for="paterno" class="control-label col-md-3 col-lg-2">A. Paterno:</label>
											<div class="col-md-3 col-lg-2">
												<input type="text" name="paterno" id="paterno" class="form-control required">
											</div>
										</div>

										<div class="form-group">
											<label for="materno" class="control-label col-md-3 col-lg-2">A. Materno:</label>
											<div class="col-md-3 col-lg-2">
												<input type="text" name="materno" id="materno" class="form-control">
											</div>
										</div>

										<div class="form-group">
											<label for="telefono" class="control-label col-md-3 col-lg-2">Teléfono:</label>
											<div class="col-md-3 col-lg-2">
												<input type="text" name="telefono" id="telefono" class="numeros form-control" placeholder="Sin espacios ni guiones">
											</div>
										</div>

										<div class="form-group">
											<label for="celular" class="control-label col-md-3 col-lg-2">Celular:</label>
											<div class="col-md-3 col-lg-2">
												<input type="text" name="celular" id="celular" class="numeros form-control" placeholder="Sin espacios ni guiones">
											</div>
										</div>
										<div class="form-group">
											<label for="email" class="control-label col-md-3 col-lg-2">Email:</label>
											<div class="col-md-3 col-lg-2">
												<input type="text" name="email" id="email" class="email form-control" placeholder="ejemplo@dominio.com.mx">
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-offset-3 col-lg-offset-2">
												<button type="button" id="crearUsuario" class="btn btn-primary"><i class="fa fa-plus-square"></i> Crear Usuario</button>&nbsp;
												<span class="hide text-primary" id="loadingAgregarUsuario"><i class="fa fa-spinner fa-spin fa-3x"></i> Creando usuario ...</span>
												{{ csrf_field() }}
											</div>
										</div>
									</form>
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
	<script src="{{ asset('js/usuarios/usuarios_agregar.js') }}"></script>
@stop