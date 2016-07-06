@extends('app_')

@section('contenido')
	<div class="row row-app">
		<div class="col-sm-12">
			<div class="col-separator col-separator-first col-unscrollable">
				<div class="col-table">
					<h4 class="innerAll border-bottom margin-none">Administración de usuarios</h4>
					<div class="col-table-row">
						<div class="col-app col-unscrollable">
							<div class="col-app">
								<div class="innerAll">
									<a href="{{ url('usuarios/agregar') }}" class="btn btn-primary"><i class="fa fa-plus-square"></i> Agregar nuevo usuario</a>

									<div class="separator bottom"></div>

									@if(!is_null($usuarios))
										<table class="table table-striped" id="usuarios">
											<thead>
												<tr>
													<th>Username</th>
													<th>Nombre</th>
													<th>Teléfono</th>
													<th>Celular</th>
													<th>Activo</th>
													<th>Fecha creación</th>
													<th>&nbsp;</th>
												</tr>
											</thead>
											<tbody>
												@foreach($usuarios as $usuario)
													<tr>
														<td class="usuario" data-id="{{ $usuario->getUsername() }}">{{ $usuario->getUsername() }}</td>
														<td>{{ $usuario->getNombreCompleto() }}</td>
														<td>{{ $usuario->getTelefono() }}</td>
														<td>{{ $usuario->getCelular() }}</td>
														<td>{{ $usuario->getActivo() ? 'Activo' : 'Inactivo' }}</td>
														<td>{{ $usuario->getFechaCreacion() }}</td>
														<td>
															<a href="{{ url('usuarios/editar/' . base64_encode($usuario->getUsername())) }}" class="editar"><i class="fa fa-edit" data-toggle='tooltip' data-original-title="Editar usuario" data-placement="top"></i></a>
															&nbsp;
															<a href="#" class="eliminar"><i class="fa fa-times" data-toggle='tooltip' data-original-title="Eliminar usuario" data-placement="top"></i></a>
														</td>
													</tr>
												@endforeach
											</tbody>
										</table>
									@else
										<h4 class="text-primary">Sin usuarios agregados. Agregue uno nuevo dando click en el botón "Agregar"</h4>
									@endif
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
	<script src="{{ asset('public/js/usuarios/usuarios.js') }}"></script>
@stop