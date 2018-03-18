@if (count($consultas) > 0)
    @php
    $total = 0;
    @endphp
    <table class="table table-bordered table-responsive table-primary text-small">
        <thead>
            <tr>
                <th>#</th>
                <th>Paciente</th>
                <th>Fecha Consulta</th>
                <th>Costo</th>
                <th>Pagada</th>
                <th>Efectivo</th>
                <th>Tarjeta</th>
                <th>Fecha Pago</th>
            </tr>
        </thead>
        <tbody>
    @foreach ($consultas as $consulta)
        @php
            if ($consulta->Pagada == 'Pagada') {
                $total += $consulta->Costo;
            }
        @endphp
        <tr>
            <td width="20">{{ $loop->index + 1 }}</td>
            <td>{{ $consulta->Paciente }}</td>
            <td>{{ Siacme\Aplicacion\Fecha::convertir($consulta->Fecha) }}</td>
            <td>${{ number_format($consulta->Costo, 2) }}</td>
            <td>{{ $consulta->Pagada }}</td>
            <td>${{ !is_null($consulta->Efectivo) ? number_format($consulta->Efectivo, 2) : number_format(0, 2) }}</td>
            <td>${{ !is_null($consulta->Tarjeta) ? number_format($consulta->Tarjeta, 2) : number_format(0, 2) }}</td>
            <td>{{ $consulta->Pagada == 'Pagada' ? Siacme\Aplicacion\Fecha::convertir($consulta->FechaPago) : '-' }}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th class="text-right" colspan="3">Ingreso del día:</th>
            <th class="text-primary">${{ number_format($total, 2) }}</th>
            <th colspan="4"></th>
        </tr>
    </tfoot>
    </table>
@else
    <h3>No existen resultados para {{ $fecha }}</h3>
@endif