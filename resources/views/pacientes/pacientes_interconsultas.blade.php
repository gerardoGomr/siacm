<div class="tab-pane" id="interconsultas">
	@if($expediente->tieneInterconsultas())
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Fecha</th>
					<th>Medico</th>
					<th>Referencia</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($expediente->getInterconsultas() as $interconsulta)
					<tr>
						<td>Fecha</td>
						<td>{{ $interconsulta->getMedico()->nombreCompleto() }}</td>
						<td>{{ $interconsulta->getReferencia() }}</td>
						<td><a href="{{ url('pacientes/interconsulta/' . base64_encode($interconsulta->getId()) . '/' . base64_encode($expediente->getId())) }}" data-toggle="tooltip" data-original-title="Imprimir orden de interconsulta" data-placement="top" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i></a></td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@else
		<h4>No se han generado interconsultas para el paciente actual</h4>
	@endif
</div>