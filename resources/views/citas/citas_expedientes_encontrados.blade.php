<!-- cargar resultados de expedientes encontrados -->
<h4 class="innerAll bg-gray border-bottom"><i class="fa fa-check"></i> Coincidencias</h4>
<table class="table table-striped" style="font-size:8pt;">
    <thead>
        <tr>
            <th>No</th>
            <th>Paciente</th>
            <th>Telefonos</th>
            <th>E-mail</th>
            <th>Direccion</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
    @foreach($listaPacientes as $paciente)
        <tr>
            <td class="id">{{ $paciente->getId() }}</td>
            <td>{{ $paciente->getNombreCompleto() }}</td>
            <td>
                <ul>
                    <li><i class="fa fa-phone"></i> {{ $paciente->getTelefono() }}</li>
                    <li><i class="fa fa-mobile"></i> {{ $paciente->getCelular() }}</li>
                </ul>
            </td>
            <td class="email">{{ $paciente->getEmail() }}</td>

            <td>
                <a href="javascript:;" title="Usar esta paciente" class="seleccionaPersona btn btn-danger btn-sm"><i class="fa fa-check"></i> Seleccionar</a>
                <input type="hidden" name="idPaciente" value="{{ base64_encode($paciente->getId()) }}">
                <input type="hidden" name="nombre" value="{{ $paciente->getNombre() }}" />
                <input type="hidden" name="paterno" value="{{ $paciente->getPaterno() }}" />
                <input type="hidden" name="materno" value="{{ $paciente->getMaterno() }}" />
                <input type="hidden" name="telefono" value="{{ $paciente->getTelefono() }}" />
                <input type="hidden" name="celular" value="{{ $paciente->getCelular() }}" />
            </td>
        </tr>
    @endforeach
    </tbody>
</table>