<div class="tab-pane active" id="consultas" data-url="{{ url('pacientes/consulta/recibo') }}">
    @if($expediente->tieneConsultas())
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Padecimiento</th>
                    <th>Nota médica</th>
                    <th>Comentario</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            @foreach($expediente->getConsultas() as $consulta)
                <tr>
                    <td>{{ Siacme\Aplicacion\Fecha::convertir($consulta->getFecha()) }}</td>
                    <td>{{ $consulta->getPadecimientoActual() }}</td>
                    <td>{{ $consulta->getNotaMedica() }}</td>
                    <td>{{ strlen($consulta->getComentario()) > 0 ? $consulta->getComentario() : '----' }}</td>
                    <td>
                        {!! $consulta->tieneReceta() ? '<a href="'. url('pacientes/receta/' . base64_encode($consulta->getReceta()->getId()) . '/' . base64_encode($expediente->getId())) .'" data-toggle="tooltip" data-original-title="Imprimir receta" data-placement="top" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-print"></i></a>' : '-' !!}
                        @if($consulta->pagada())
                            <button class="btn btn-success btn-sm imprimirRecibo" data-toggle="tooltip" data-original-title="Imprimir recibo" data-placement="top" data-id="{{ base64_encode($consulta->getId()) }}" data-expediente="{{ base64_encode($expediente->getId()) }}"><i class="fa fa-check"></i></button>
                        @else
                            <button class="btn btn-danger btn-sm cobrar" data-expediente="{{ base64_encode($expediente->getId()) }}" data-costo="{{ $consulta->getCosto() }}" data-id="{{ base64_encode($consulta->getId()) }}" data-toggle="tooltip" data-original-title="Cobrar consulta" data-placement="top"><i class="fa fa-dollar"></i></button>
                        @endif
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