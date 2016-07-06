<div class="tab-pane" id="consultas">
    @if($expediente->tieneConsultas())
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Nota médica</th>
                    <th>Receta</th>
                </tr>
            </thead>
            <tbody>
            @foreach($expediente->consultas() as $consulta)
                <tr>
                    <td>{{ $consulta->getFecha() }}</td>
                    <td>{{ $consulta->getNotaMedica() }}</td>
                    <td>{!! !is_null($consulta->getReceta()) ? '<a href="'. url('pacientes/receta/' . base64_encode($consulta->getReceta()->getId()) . '/' . base64_encode($expediente->getPaciente()->getId()) . '/' . base64_encode($expediente->getMedico()->getUsername())) .'" data-toggle="tooltip" data-original-title="generar PDF" data-placement="top" target="_blank"><i class="fa fa-print fa-2x"></i></a>' : '-' !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h4>No se han generado consultas para el paciente actual</h4>
    @endif
</div>