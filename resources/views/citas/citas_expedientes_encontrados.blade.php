<!-- cargar resultados de expedientes encontrados -->
<style>
    table.table tr.seleccionarPaciente {
        cursor: pointer;
    }
</style>
<h4 class="innerAll bg-gray border-bottom">Coincidencias</h4>
<table class="table table-hover table-bordered text-small">
    <thead>
        <tr class="bg-primary">
            <th role="columnheader">No</th>
            <th role="columnheader">Paciente</th>
            <th role="columnheader">Telefonos</th>
            <th role="columnheader">E-mail</th>
            <th role="columnheader">Direccion</th>
        </tr>
    </thead>
    <tbody>
    @foreach($pacientes as $paciente)
        <tr class="seleccionarPaciente" data-id="{{ $paciente->getId() }}">
            <td>{{ $paciente->getId() }}</td>
            <td class="nombreCompleto">{{ $paciente->nombreCompleto() }}</td>
            <td>
                <ul>
                    <li><i class="fa fa-phone"></i> {{ $paciente->getTelefono() }}</li>
                    <li><i class="fa fa-mobile"></i> {{ $paciente->getCelular() }}</li>
                </ul>
            </td>
            <td>{{ $paciente->getEmail() }}</td>
            <td>{{ !is_null($paciente->getDomicilio()) ? $paciente->getDomicilio()->getDireccion() : '-' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>