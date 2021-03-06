<div class="tab-pane active" id="consultas" data-url="{{ url('pacientes/consulta/recibo') }}">
    @if($expediente->tieneConsultas($medico))
        <table class="table table-bordered table-striped text-small">
            <thead>
                <tr>
                    <th class="col-md-2">Fecha</th>
                    <th class="col-md-2">Padecimiento</th>
                    <th class="col-md-3">Nota médica</th>
                    <th class="col-md-3">En próxima cita</th>
                    <th class="col-md-1">Costo</th>
                    <th class="col-md-2">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            @foreach($expediente->getConsultas($medico) as $consulta)
                <tr>
                    <td>{{ Siacme\Aplicacion\Fecha::convertir($consulta->getFecha()) }}</td>
                    <td>{{ $consulta->getPadecimientoActual() }}</td>
                    <td>{{ $consulta->getNotaMedica() }}</td>
                    <td>{{ strlen($consulta->getARealizarEnProximaCita()) > 0 ? $consulta->getARealizarEnProximaCita() : '----' }}</td>
                    <td>${{ number_format($consulta->getCosto(),2) }}</td>
                    <td>
                        <div class="btn-group" role="group">
                        {!! $consulta->tieneReceta() ? '<a href="'. url('pacientes/receta/' . base64_encode($consulta->getReceta()->getId()) . '/' . base64_encode($expediente->getId())) .'" data-toggle="tooltip" data-original-title="Imprimir receta" data-placement="top" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-print"></i></a>' : '-' !!}
                        {!! $consulta->tieneHigieneDental() ? '<a href="'. url('pacientes/higiene/' . base64_encode($consulta->getHigieneDentalConsulta()->getId()) . '/' . base64_encode($expediente->getId())) .'" data-toggle="tooltip" data-original-title="Imprimir indicaciones higiene dental" data-placement="top" target="_blank" class="btn btn-default btn-sm"><i class="fa fa-print"></i></a>' : '-'!!}
                        {!! $consulta->tieneIndicacion() ? '<a href="'. url('pacientes/indicacion/' . base64_encode($consulta->getIndicacionConsulta()->getId()) . '/' . base64_encode($expediente->getId())) .'" data-toggle="tooltip" data-original-title="Imprimir indicaciones" data-placement="top" target="_blank" class="btn btn-default btn-sm"><i class="fa fa-print"></i></a>' : '-'!!}
                        @if($consulta->pagada())
                            @php
                            $cobroId = 0;
                            @endphp
                            @foreach($consulta->getCobrosConsulta() as $cobro)
                            @php $cobroId = $cobro->getId() @endphp
                            @endforeach
                            <button class="btn btn-success btn-sm imprimirRecibo" data-toggle="tooltip" data-original-title="Imprimir recibo" data-placement="top" data-id="{{ base64_encode($cobroId) }}" data-expediente="{{ base64_encode($expediente->getId()) }}"><i class="fa fa-dollar"></i></button>
                        @endif
                        <a href="{{ url('consultas/nota/' . base64_encode($consulta->getId()) . '/' . base64_encode($expediente->getId())) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-original-title="Imprimir nota médica" target="_blank"><i class="fa fa-print"></i></a>
                        </div>
                        <input type="hidden" class="desgloseCosto" value="{{ $consulta->desgloseCosto() }}">
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h4>No se han generado consultas para el paciente actual</h4>
    @endif
</div>