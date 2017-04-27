<div class="tab-pane" id="odontograma">
	<button type="button" id="btnGenerarPlan" class="btn btn-success" disabled data-toggle="modal" data-url="{{ route('dibujar-plan-tratamiento') }}"><i class="fa fa-edit"></i> Generar plan de tratamiento</button>

	<div class="separator"></div>
	<div id="dvOdontograma" class="table-responsive">
		{!! $dibujadorOdontograma->dibujar() !!}
	</div>

    <input type="hidden" name="dirigidoA" id="dirigido" value="">
	@include('consultas.consultas_johanna_seleccion_diente_padecimiento')
</div>
