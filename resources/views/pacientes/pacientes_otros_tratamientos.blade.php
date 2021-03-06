<div class="tab-pane" id="otros">
	@if($expediente->getExpedienteEspecialidad()->tieneOtrosTratamientos())
		<table class="table table-bordered text-small">
			<thead class="bg-gray">
				<tr>
					<th>Tratamiento</th>
					<th class="col-md-3">DX</th>
					<th>Costo</th>
                    <th>Saldo</th>
                    <th>Mensualidades</th>
                    <th>Duración</th>
                    <th>Estatus</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($expediente->getExpedienteEspecialidad()->getOtrosTratamientos() as $tratamientoOdontologia)
					<tr>
						<td>{{ $tratamientoOdontologia->descripcionTratamientos() }}</td>
						<td>{{ substr($tratamientoOdontologia->getDX(), 0, 200) . ' ...' }}</td>
						<td>{{ $tratamientoOdontologia->costo() }}</td>
                        <td>{{ $tratamientoOdontologia->saldoFormateado() }}</td>
                        <td>${{ number_format($tratamientoOdontologia->getMensualidades(), 2) }}</td>
                        <td>{{ $tratamientoOdontologia->getFechaInicio()->format('Y-m-d') }} - {{ $tratamientoOdontologia->getFechaTermino()->format('Y-m-d') }}</td>
                        <td>
                            <span class="label {{ $tratamientoOdontologia->atendido() ? 'label-success' : 'label-danger' }}">{{ $tratamientoOdontologia->atendido() ? 'Atendido' : 'Activo' }}</span>
                            <br><br>
                            <span class="label {{ $tratamientoOdontologia->pagado() ? 'label-success' : 'label-danger' }}">{{ $tratamientoOdontologia->pagado() ? 'Pagado' : 'Con adeudo' }}</span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                @if (!$tratamientoOdontologia->pagado())
                                    <button type="button" class="btn btn-primary pagoOtroTratamiento" data-toggle="tooltip" title="Pagar/abonar" data-saldo="{{ $tratamientoOdontologia->obtenerSaldo() }}" data-abono="{{ $tratamientoOdontologia->abonoMinimo() }}" data-id="{{ $tratamientoOdontologia->getId() }}"><i class="fa fa-dollar"></i></button>
                                @endif
    							<button type="button" class="btn btn-warning editar" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil"></i></button>
    							<a class="btn btn-success" href="/pacientes/tratamientos/otros/pdf/{{ base64_encode($tratamientoOdontologia->getId()) }}" data-toggle="tooltip" title="Abrir PDF" target="_blank"><i class="fa fa-file"></i></a>
                                <a class="btn btn-danger" href="/pacientes/tratamientos/otros/{{ base64_encode($tratamientoOdontologia->getId()) }}/pagos" data-toggle="tooltip" title="Ver reporte de pagos" target="_blank"><i class="fa fa-eye"></i></a>
                            </div>
							<input type="hidden" class="expedienteId" value="{{ $expediente->getId() }}">
                            <input type="hidden" class="otroTratamientoId" value="{{ $tratamientoOdontologia->getId() }}">
							<input type="hidden" class="ortopedia" value="{{ $tratamientoOdontologia->ortopedia() ? '1' : '0' }}">
							<input type="hidden" class="ortodoncia" value="{{ $tratamientoOdontologia->ortodoncia() ? '1' : '0' }}">
							<input type="hidden" class="dx" value="{{ $tratamientoOdontologia->getDX() }}">
							<input type="hidden" class="observaciones" value="{{ $tratamientoOdontologia->getObservaciones() }}">
							<input type="hidden" class="tx" value="{{ $tratamientoOdontologia->getTX() }}">
							<input type="hidden" class="costo" value="{{ $tratamientoOdontologia->getCosto() }}">
							<input type="hidden" class="fechaInicio" value="{{ $tratamientoOdontologia->getFechaInicio()->format('Y-m-d') }}">
                            <input type="hidden" class="fechaTermino" value="{{ $tratamientoOdontologia->getFechaTermino()->format('Y-m-d') }}">
							<input type="hidden" class="mensualidades" value="{{ $tratamientoOdontologia->getMensualidades() }}">
                        </td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@else
		<h4>No se han generado otros tratamientos para el paciente actual</h4>
	@endif
</div>