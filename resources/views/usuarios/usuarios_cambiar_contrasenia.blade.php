<div class="modal fade" id="modalCambiarContrasenia">
    <div class="modal-dialog">
        <div class="modal-content">
        	<div class="modal-header">
        		<h3 class="modal-title">Cambiar contraseña</h3>
        	</div>
            <div class="modal-body">
                <form action="/usuarios/cambiar-contrasenia" id="formCambiarContrasenia" class="form-horizontal">
                	<div class="form-group">
                		<label class="control-label col-md-3 col-lg-2">Nueva contraseña:</label>
                		<div class="col-md-5 col-lg-4">
                			<input type="password" name="contrasenia" id="contrasenia" class="form-control required">
                		</div>
                		<input type="hidden" name="usuarioId" id="usuarioId" value="">
                		{{ csrf_field() }}
                	</div>
                </form>
            </div>
            <div class="modal-footer">
            	<button type="button" class="btn btn-primary" id="cambiarContrasenia">Cambiar</button>
            	<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>