<!-- antecedentes personales patologicos -->
<div class="tab-pane" id="trastornos">
	<div class="row">
		<div class="col-md-12">
			<div class="box-generic">
				@if(!is_null($listaTrastornos))
					<div class="row">
						@foreach($listaTrastornos as $trastorno)
							<div class="col-xs-6">
								<div class="form-group">
									<div class="radio">
										<label>
											@if($expediente->getPaciente()->compruebaTrastorno($trastorno))
												{!! Form::radio('trastorno', $trastorno->getId(), true, []) !!} {{ $trastorno->getTrastornoLenguaje() }}
											@else
												{!! Form::radio('trastorno', $trastorno->getId(), null, []) !!} {{ $trastorno->getTrastornoLenguaje() }}
											@endif
										</label>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				@endif
				<div class="form-group">
					<a href="javascript:;" title="Guardar>>" class="guardar btn btn-primary"><i class="fa fa-save"></i> Guardar</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- fin -->