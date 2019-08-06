<div class="tab-pane" id="planesCirugia">
	@if(count($planesCirugia) > 0)
		<table class="table table-bordered text-small">
			<thead class="bg-gray">
				<tr>
					<th>Cirugía</th>
					<th>Honorarios</th>
					<th>Hospital Sugerido</th>
                    <th>Monto Hospitalización</th>
                    <th>Días Hospitalización</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($planesCirugia as $planCirugia)
					<tr>
						<td>{{ $planCirugia->Cirugia->Nombre }}</td>
						<td>${{ $planCirugia->HonorariosMedicos }}</td>
                        <td>{{ $planCirugia->HospitalSugerido }}</td>
                        <td>${{ $planCirugia->MontoHospitalizacion }}</td>
                        <td>{{ $planCirugia->DiasHospitalizacion }} días</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-primary pagoPlanCirugia" data-toggle="tooltip" title="Pagar/abonar" data-saldo="" data-abono="" data-id="{{ $planCirugia->id }}"><i class="fa fa-dollar"></i></button>
    							<button type="button" class="btn btn-warning editarPlanCirugia" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil"></i></button>
    							<a class="btn btn-success" href="{{ url('pacientes/cirugias/pdf/' . base64_encode($planCirugia->id) . '/' . base64_encode($expediente->getId())) }}" data-toggle="tooltip" title="Abrir PDF" target="_blank"><i class="fa fa-file"></i></a>
                            </div>

                            <input type="hidden" class="expedienteId" value="{{ base64_encode($expediente->getId()) }}">
                            <input type="hidden" class="planCirugiaId" value="{{ $planCirugia->id }}">
                            <input type="hidden" class="cirugiaId" value="{{ $planCirugia->CirugiaId }}">
							<input type="hidden" class="honorarios" value="{{ $planCirugia->HonorariosMedicos }}">
							<input type="hidden" class="equipoAdicional" value="{{ $planCirugia->EquipoAdicional }}">
							<input type="hidden" class="hospitalSugerido" value="{{ $planCirugia->HospitalSugerido }}">
							<input type="hidden" class="diasHospitalizacion" value="{{ $planCirugia->DiasHospitalizacion }}">
							<input type="hidden" class="montoHospitalizacion" value="{{ $planCirugia->MontoHospitalizacion }}">
                        </td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@else
		<h4>No se han generado planes de cirugía para el paciente actual</h4>
	@endif
</div>
