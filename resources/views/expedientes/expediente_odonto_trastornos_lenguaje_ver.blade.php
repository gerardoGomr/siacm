<!-- antecedentes personales patologicos -->
<div class="tab-pane" id="trastornos">
	<h4 class="innerAll border-bottom">Trastornos</h4>
	<div class="row">
		<div class="col-md-12">
			<div class="box-generic">
				<p>{{ !is_null($expediente->getPaciente()->getTrastornoLenguaje()) ? $expediente->getPaciente()->getTrastornoLenguaje()->getTrastornoLenguaje() : '--' }}</p>
			</div>
		</div>
	</div>
</div>
<!-- fin -->