@extends('app')

@section('contenido')
	<div class="row row-app">
		<div class="col-sm-12">
			<div class="col-separator col-separator-first col-unscrollable">
				<div class="col-table">
					<h3 class="innerAll border-bottom margin-none">Administración de usuarios</h3>
					<div class="col-separator-h"></div>
					<div class="col-table-row">
						<div class="col-app col-unscrollable">
							<div class="col-app">
								<div class="innerAll">
									<a href="/usuarios/agregar" class="btn btn-primary"><i class="fa fa-plus-square"></i> Agregar nuevo usuario</a>

									<div class="separator bottom"></div>
									<div id="listaUsuarios" data-token="{{ csrf_token() }}">
										@include('usuarios.usuarios_listado')
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
	@include('usuarios.usuarios_cambiar_contrasenia')
@stop

@section('js')
	<script src="{{ asset('js/usuarios/usuarios.js') }}"></script>
@stop