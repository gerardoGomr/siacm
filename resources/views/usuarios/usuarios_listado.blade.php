@if(!is_null($usuarios))
    <table class="table table-hover table-primary table-bordered" id="usuarios">
        <thead>
        <tr>
            <th>&nbsp;</th>
            <th>Username</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Celular</th>
            <th>Email</th>
            <th>Fecha creación</th>
            <th>&nbsp</th>
        </tr>
        </thead>
        <tbody>
        @foreach($usuarios as $usuario)
            <tr>
                <td>
                    @if($usuario->getActivo())
                        <i class="fa fa-square text-success" data-toggle="tooltip" title="Activo"></i>
                    @else
                        <i class="fa fa-square text-danger" data-toggle="tooltip" title="Inactivo"></i>
                    @endif
                </td>
                <td class="usuario" data-id="{{ $usuario->getUsername() }}">{{ $usuario->getUsername() }}</td>
                <td>{{ $usuario->nombreCompleto() }}</td>
                <td>{{ $usuario->getTelefono() }}</td>
                <td>{{ $usuario->getCelular() }}</td>
                <td>{{ $usuario->getEmail() }}</td>
                <td>-</td>
                <td>
                    <div class="btn-group btn-group-xs">
                        <a href="/usuarios/editar/{{ base64_encode($usuario->getId()) }}" class="btn btn-info" data-toggle='tooltip' title="Editar usuario"><i class="fa fa-edit"></i></a>
                        @if($usuario->getActivo())
                            <button type="button" class="btn btn-danger eliminar" data-toggle='tooltip' title="Eliminar usuario" data-id="{{ $usuario->getId() }}"><i class="fa fa-times"></i></button>
                        @else
                            <button type="button" class="btn btn-success activar" data-toggle='tooltip' title="Activar usuario" data-id="{{ $usuario->getId() }}"><i class="fa fa-check"></i></button>
                        @endif
                        <button type="button" class="btn btn-warning cambiarContrasenia" data-toggle="tooltip" title="Cambiar contraseña" data-id="{{ $usuario->getId() }}"><i class="fa fa-key"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <input type="hidden" id="existenUsuarios" value="1">
@else
    <h4 class="text-primary">Sin usuarios agregados. Agregue uno nuevo dando click en el botón "Agregar"</h4>
    <input type="hidden" id="existenUsuarios" value="0">
@endif

