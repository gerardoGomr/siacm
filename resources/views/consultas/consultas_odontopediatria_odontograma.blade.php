<div class="tab-pane" id="odontograma">
	<input type="hidden" id="urlOdontograma" value="{{ url('consultas/odontograma/dibujar') }}">
	<a href="{{ url('consultas/plan/agregar/' . base64_encode($expediente->getMedico()->getUsername()) . '/' . base64_encode($expediente->getPaciente()->getId())) }}" id="btnGenerarPlan" class="btn btn-success btn-small" disabled="disabled"><i class="fa fa-money"></i> Generar plan</a>
	<div class="separator"></div>
	<div id="dvOdontograma" class="table-responsive">
		{!! $dibujadorOdontograma->dibujar() !!}
	</div>

	@include('consultas.consultas_odontopediatria_seleccion_diente_padecimiento')
</div>