<div class="tab-pane" id="antOdontopatologicos">
	<div class="box-generic">
		<div class="form-group">
			<div class="col-md-8 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('dolorBoca', null, null, []) !!} ¿Ha presentado dolor en la boca?
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-8 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('sangradoEncias', null, null, []) !!} ¿Ha notado sangrado en las encías?
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-8 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('malOlor', null, null, []) !!} ¿Presenta mal olor o mal sabor en la boca?
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-8 col-md-offset-3">
				<div class="checkbox">
					<label>
						{!! Form::checkbox('dienteFlojo', null, null, []) !!} ¿Siente que algún diente está flojo?
					</label>
				</div>
			</div>
		</div>
	</div>
</div>