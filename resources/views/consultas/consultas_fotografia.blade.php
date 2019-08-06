<div class="innerAll">
    <div class="media">
        @if(isset($expediente) && $expediente->tieneFoto())
            <img src="{{ url('expedientes/foto/mostrar/' . base64_encode($expediente->getFotografia()->getRuta())) . '?' . rand() }}" id="fotoCapturada" class="pull-left"  width="">
        @endif
        <div class="media-body innerAll half">
            <h4 class="media-heading">{{ $expediente->getPaciente()->nombreCompleto() }}</h4>
            <p>{{ $expediente->getPaciente()->edadCompleta() }} años<br/>Vive en: {{ $expediente->getPaciente()->getLugarNacimiento() }}<br/>Expediente {{ $expediente->getExpedienteEspecialidad() !== null ? $expediente->getExpedienteEspecialidad()->numero() : $expediente->getExpedienteRigoberto()->numero() }}</p>
            <p><a href="{{ url('expedientes/ver/' . base64_encode($paciente->getId()) . '/' . base64_encode($medico->getId())) }}" class="btn btn-success btn-xs" target="_blank"><i class="fa fa-eye"></i> Ver expediente</a></p>
        </div>
    </div>
</div>