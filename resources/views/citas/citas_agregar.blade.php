<div class="modal fade" id="modalAgendarCita">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal heading -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h2 class="modal-title">Agendar nueva cita</h2>
			</div>

			<div class="modal-body">
				<div class="innerAll bg-gray border-bottom">
					<table>
						<tr>
							<td class="strong">Fecha:</td>
							<td class="fecha"></td>
						</tr>
						<tr>
							<td class="strong">Hora:</td>
							<td class="hora"></td>
						</tr>
					</table>
				</div>
				<div class="separator"></div>
				<form id="formNuevaCita" action="{{ url('citas/agendar') }}" class="form-horizontal">
					{!! csrf_field() !!}
					<button type="button" id="seguirCapturando" class="btn btn-default hide pull-right"><i class="fa fa-arrow-right"></i> Cancelar búsqueda</button>
					<div class="clearfix"></div>
					<div class="separator"></div>
					<div class="form-group" id="buscadorPacientes">
						<label for="nombreBusqueda" class="control-label col-md-2">Paciente:</label>
						<div class="col-md-9">
							<div class="input-group">
								<input type="text" name="nombreBusqueda" id="nombreBusqueda" class="form-control" placeholder="Ingrese nombre y/o apellidos">
									<span class="input-group-btn">
										<button class="btn btn-primary" id="btnComprueba" type="button" data-url="{{ url('citas/pacientes/buscar') }}"><i class="fa fa-search"></i></button>
									</span>
							</div>
						</div>
					</div>
					<div id="dvResultados"></div>
					<div id="datos" class="hide">
						<button type="button" id="buscarDeNuevo" class="btn btn-default pull-right"><i class="fa fa-arrow-left"></i> Buscar de nuevo</button>
						<div class="clearfix"></div>
						<div class="separator"></div>
						<p class="text-primary text-small">Los campos marcados con un asterisco son obligatorios</p>
						<div class="form-group">
							<label for="nombre" class="control-label col-md-2">*Nombre:</label>
							<div class="col-md-6">
								<input type="text" name="nombre" id="nombre" class="form-control required">
							</div>
						</div>
						<div class="form-group">
							<label for="paterno" class="control-label col-md-2">*Paterno:</label>
							<div class="col-md-5">
								<input type="text" name="paterno" id="paterno" class="form-control required">
							</div>
						</div>
						<div class="form-group">
							<label for="materno" class="control-label col-md-2">Materno:</label>
							<div class="col-md-5">
								<input type="text" name="materno" id="materno" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label for="telefono" class="control-label col-md-2">Teléfono:</label>
							<div class="col-md-4">
								<input type="text" name="telefono" id="telefono" class="form-control numerosEnteros" placeholder="Sin espacios ni guiones">
							</div>
						</div>
						<div class="form-group">
							<label for="celular" class="control-label col-md-2">*Celular:</label>
							<div class="col-md-4">
								<input type="text" name="celular" id="celular" class="form-control required numerosEnteros" placeholder="Sin espacios ni guiones">
							</div>
						</div>
						<div class="form-group">
							<label for="email" class="control-label col-md-2">Email:</label>
							<div class="col-md-5">
								<input type="text" name="email" id="email" class="form-control email" placeholder="ejemplo@ejemplo.com">
							</div>
						</div>

						<input type="hidden" name="opcion" id="opcion" value="1">
						<input type="hidden" id="busquedaPacienteRealizada" value="0">
						<input type="hidden" name="fecha" id="fecha" class="fecha" value="">
						<input type="hidden" name="hora" id="hora" class="hora" value="">
						<input type="hidden" name="userMedico" id="userMedico" value="{{ $medico->getUsername() }}">
						<input type="hidden" name="pacienteId" id="pacienteId" value="0">
					</div>
				</form>
			</div>

			<div class="modal-footer">
				<button type="button" id="agendarCita" class="btn btn-primary"><i class="fa fa-plus"></i> Agendar cita</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>