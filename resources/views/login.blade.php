@extends('app_no_sidebar')

@section('contenido')
	<div class="row row-app">
		<div class="col-md-12">
			<div class="col-separator col-unscrollable box">
				<h4 class="innerAll bg-gray text-center"><i class="fa fa-lock"></i> Sistema Integral de Administración Médica</h4>
				<div class="col-table">
					<div class="col-table-row">
						<div class="col-app col-unscrollable">
							<div class="col-app">
								<div class="login">
									<div class="placeholder text-center"><img src="{{ elixir('img/boka.jpg') }}" width="200">&nbsp;<img src="{{ elixir('img/orl.jpg') }}" width="200"></div>
									<div class="panel panel-default col-sm-6 col-sm-offset-3">

										<div class="panel-body">
											@if(isset($error))
												<div class="alert alert-danger">
													<strong>Error de inicio de sesión</strong>
													{{ $error }}
												</div>
											@endif

											<div class="separator"></div>
											<form role="form" action="{{ url('login') }}" method="post" name="formLogin">
												{{ csrf_field() }}
												<div class="form-group">
													<input type="text" class="form-control" name="username" id="username" placeholder="Usuario" autofocus>
												</div>
												<div class="form-group">
													<input type="password" class="form-control" name="password" id="password" autocomplete="off" placeholder="Contraseña">
												</div>
												<input type="submit" class="btn btn-primary btn-block strong" value="Ingresar a sistema" />
											</form>
										</div>
									</div>
									<div class="clearfix"></div>
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
	<script src="{{ asset('js/login.js') }}"></script>
@stop