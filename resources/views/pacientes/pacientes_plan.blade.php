<div class="tab-pane" id="plan">
    @if($expediente->tienePlanesTratamiento())
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Fecha</th>
                <th>Atendido</th>
                <th>Costo</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @foreach($expediente->getListaPlanesTratamiento() as $plan)
                <tr>
                    <td>-</td>
                    <td>{{ $plan->atendido() ? 'Atendido' : 'Activo' }}</td>
                    <td>{{ '$' . number_format($plan->getCosto(), 2) }}</td>
                    <td><a href="{{ url('pacientes/plan/' . base64_encode($plan->getId()) . '/' . base64_encode($expediente->getPaciente()->getId()) . '/' . base64_encode($expediente->getMedico()->getUsername())) }}" data-toggle="tooltip" data-original-title="generar PDF" data-placement="top" target="_blank"><i class="fa fa-print fa-2x"></i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h4>No se han generado planes de tratamiento para el paciente actual</h4>
    @endif
</div>