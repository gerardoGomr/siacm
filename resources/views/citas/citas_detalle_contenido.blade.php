<div class="innerAll">
    <div class="row">
        <div class="col-xs-8 col-md-9 col-lg-7">
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
                    <td>{{ $cita->getPaciente()->nombreCompleto() }}</td>
                </tr>
                <tr>
                    <td><strong>Contacto:</strong></td>
                    <td>
                        <p><i class="fa fa-phone"></i> {{ !empty($cita->getPaciente()->getTelefono()) ? $cita->getPaciente()->getTelefono() : '--' }}</p>
                        <p><i class="fa fa-mobile"></i> {{ !empty($cita->getPaciente()->getCelular()) ? $cita->getPaciente()->getCelular() : '--' }}</p>
                        <p><i class="fa fa-envelope"></i> {{ !empty($cita->getPaciente()->getEmail()) ? $cita->getPaciente()->getEmail() : '--' }}</p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="col-xs-4 col-md-3 col-lg-5">

            <div class="separator bottom"></div>
            <div id="dvOpciones">
                @include('citas.citas_detalle_opciones_refrescar')
            </div>

            <input type="hidden" id="citaId" value="{{ base64_encode($cita->getId()) }}" />
            <input type="hidden" id="urlEstatus" value="{{ url('citas/estatus') }}">
            <input type="hidden" id="idPaciente" value="{{ base64_encode($cita->getPaciente()->getId()) }}" />
            <input type="hidden" id="medicoId" value="{{ base64_encode($cita->getMedico()->getId()) }}" />
            <input type="hidden" id="urlVerExpediente" value="{{ url('expedientes/ver/') }}" />
            <input type="hidden" id="urlReprogramar" value="{{ url('citas/reprogramar/asignar') }}" />
            <input type="hidden" id="urlExpediente" value="{{ url('expedientes/agregar/') }}" />
            {{ csrf_field() }}
        </div>
    </div>
</div>