<!-- antecedentes heredofamiliares -->
<div class="tab-pane" id="antOdontopatologicos">
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<div class="box-generic">
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									{!! Form::checkbox('dolorBoca', 1, null, []) !!} ¿Ha presentado dolor en la boca?
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									{!! Form::checkbox('sangradoEncias', 1, null, []) !!} ¿Ha notado sangrado en las encías?
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									{!! Form::checkbox('malOlor', 1, null, []) !!} ¿Presenta mal olor o mal sabor en la boca?
								</label>
							</div>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							<div class="checkbox">
								<label>
									{!! Form::checkbox('dienteFlojo', 1, null, []) !!} ¿Siente que algún diente está flojo?
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- fin -->