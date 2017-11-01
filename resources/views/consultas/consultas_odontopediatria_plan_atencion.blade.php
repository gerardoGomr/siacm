<div class="tab-pane" id="plan">
    <div class="innerAll" id="dvPlanTratamiento">
    	<button type="button" class="btn btn-danger pull-right marcar-plan" data-id="{{ $expediente->getId() }}"><i class="fa fa-warning"></i> Marcar plan de tratamiento actual como atendido</button>
        <br>
        {!! $dibujadorOdontograma->dibujar() !!}
    </div>
</div>