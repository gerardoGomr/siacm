@if (!is_null($consultas))
    @php
    $total = 0;
    @endphp
    <table class="table table-bordered table-responsive table-primary">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>Costo</th>
                <th>Pagada</th>
                <th>Fecha Pago</th>
                <th>Forma de Pago</th>
            </tr>
        </thead>
        <tbody>
    @foreach ($consultas as $consulta)
        @php
            if ($consulta->pagada()) {
                $total += $consulta->getCosto();
            }
        @endphp
        <tr>
            <td>{{ $consulta->getExpediente()->getPaciente()->nombreCompleto() }}</td>
            <td>${{ number_format($consulta->getCosto(), 2) }}</td>
            <td>{{ $consulta->pagada() ? 'Pagada' : 'Con adeudo' }}</td>
            <td>{{ $consulta->pagada() ? Siacme\Aplicacion\Fecha::convertir($consulta->getCobrosConsulta()->last()->getFechaPago()->format('Y-m-d')) : '-' }}</td>
            <td>
                @if ($consulta->pagada())
                    <ul>
                    @foreach($consulta->getCobrosConsulta() as $cobro)
                        <li>{{ $cobro->formaPago() }}</li>
                    @endforeach
                    </ul>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th class="text-right">Ingreso del día:</th>
            <th class="text-primary">${{ number_format($total, 2) }}</th>
            <th colspan="3"></th>
        </tr>
    </tfoot>
    </table>
@else
    <h3>No existen resultados para {{ $fecha }}</h3>
@endif