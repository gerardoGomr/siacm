<div class="innerAll">
	<div class="row">
		<div class="col-xs-8 col-md-9 col-lg-8">
            <div class="box-generic padding-none">
                <table class="table table-striped">
                    <tr>
                        <td><strong>Fecha:</strong></td>
                        <td>{{ Siacme\Aplicacion\Fecha::convertir($cita->getFecha()) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Hora:</strong></td>
                        <td>{{ $cita->getHora() }}</td>
                    </tr>
                    <tr>
                        <td><strong>Estatus:</strong></td>
                        <td>{{ $cita->estatus() }}</td>
                    </tr>
                    <tr>
                        <td><strong>Paciente:</strong></td>
                        <td>
                            {{ $cita->getPaciente()->nombreCompleto() }}<br>

                        </td>
                    </tr>
                    <tr>
                        <td><strong>Contacto:</strong></td>
                        <td>
                            <p><i class="fa fa-phone"></i> {{ !empty($cita->getPaciente()->getTelefono()) ? $cita->getPaciente()->getTelefono() : '---' }}</p>
                            <p><i class="fa fa-mobile"></i> {{ !empty($cita->getPaciente()->getCelular()) ? $cita->getPaciente()->getCelular() : '---' }}</p>
                            <p><i class="fa fa-envelope"></i> {{ !empty($cita->getPaciente()->getEmail()) ? $cita->getPaciente()->getEmail() : '---' }}</p>
                        </td>
                    </tr>
                </table>
            </div>
		</div>

		<div class="col-xs-4 col-md-3 col-lg-4">
			<div class="box-generic">
				@if (!$cita->atendida())
					<a href="{{ url('consultas/capturar/'.base64_encode($cita->getPaciente()->getId()).'/'.base64_encode($cita->getMedico()->getId()) . '/' . base64_encode($cita->getId())) }}" class="generarConsulta btn btn-danger btn-block"><i class="fa fa-plus"></i> Generar consulta</a>
				@endif
			</div>
		</div>
	</div>
</div>