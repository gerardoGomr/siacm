<div class="tab-pane" id="otros">
	@if($expediente->getExpedienteEspecialidad()->tieneOtrosTratamientos())
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Tratamiento</th>
					<th>DX</th>
					<th>Costo</th>
                    <th>Duración</th>
                    <th>Atendido</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($expediente->getExpedienteEspecialidad()->getOtrosTratamientos() as $tratamientoOdontologia)
					<tr>
						<td>{{ $tratamientoOdontologia->descripcionTratamientos() }}</td>
						<td>{{ $tratamientoOdontologia->getDX() }}</td>
						<td>{{ $tratamientoOdontologia->costo() }}</td>
                        <td>{{ $tratamientoOdontologia->getDuracion() }} años</td>
						<td>{{ $tratamientoOdontologia->atendido() ? '<i class="fa fa-check"></i>' : '-' }}</td>
                        <td>
                            @if (!$tratamientoOdontologia->pagado())
                                <button type="button" class="btn btn-primary btn-sm pagoOtroTratamiento" data-toggle="tooltip" data-original-title="Pagar/abonar" data-saldo="{{ $tratamientoOdontologia->getSaldo() }}" data-abono="{{ $tratamientoOdontologia->abonoMinimo() }}"><i class="fa fa-dollar"></i></button>
                            @endif
                        </td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@else
		<h4>No se han generado otros tratamientos para el paciente actual</h4>
	@endif
</div>