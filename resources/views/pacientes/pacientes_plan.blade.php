<div class="tab-pane" id="plan">
    @if($expediente->getExpedienteEspecialidad()->tieneOdontogramas())
        <table class="table table-bordered table-striped text-small">
            <thead class="bg-gray">
                <tr>
                    <th>Dirigido A</th>
                    <th>Atendido</th>
                    <th>Costo</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            @foreach($expediente->getExpedienteEspecialidad()->odontogramas() as $odontograma)
                <tr>
                    <td>{{ $odontograma->dirigidoA() }}</td>
                    <td><span class="label {{ $odontograma->atendido() ? 'label-success' : 'label-danger' }}">{{ $odontograma->atendido() ? 'Atendido' : 'Activo' }}</span></td>
                    <td>{{ $odontograma->costo() }}</td>
                    <td><a href="{{ url('pacientes/plan/' . base64_encode($odontograma->getId()) . '/' . base64_encode($expediente->getId())) }}" data-toggle="tooltip" data-original-title="Imprimir plan" data-placement="top" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h4>No se han generado planes de tratamiento para el paciente actual</h4>
    @endif
</div>
