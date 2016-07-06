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
    @foreach($listaExpedientes as $expediente)
        <tr>
            <td class="id">{{ $expediente->getId() }}</td>
            <td>{{ $expediente->getNombreCompleto() }}</td>
            <td>
                <ul>
                    <li><i class="fa fa-phone"></i> {{ $expediente->getTelefono() }}</li>
                    <li><i class="fa fa-mobile"></i> {{ $expediente->getCelular() }}</li>
                </ul>
            </td>
            <td class="email">{{ $expediente->getEmail() }}</td>
            <td>{{ $expediente->getDireccion() }}</td>
            <td>
                <a href="javascript:;" title="Usar esta persona" class="seleccionaPersona btn btn-primary btn-sm"> Seleccionar</a>
                <input type="hidden" name="nombre" value="{{ $expediente->getNombre() }}" />
                <input type="hidden" name="paterno" value="{{ $expediente->getPaterno() }}" />
                <input type="hidden" name="materno" value="{{ $expediente->getMaterno() }}" />
                <input type="hidden" name="telefono" value="{{ $expediente->getTelefono() }}" />
                <input type="hidden" name="celular" value="{{ $expediente->getCelular() }}" />
            </td>
        </tr>
    @endforeach
    </tbody>
</table>