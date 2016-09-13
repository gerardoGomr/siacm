<div class="tab-pane" id="expediente">
	<div class="row">
		<div class="col-md-6 col-lg-6">
			<div class="widget">
				<div class="widget-head">
					<h4 class="heading">Examen extraoral</h4>
				</div>
				<div class="widget-body">
					<div class="form-group">
						<label for="morfologiaCraneofacial" class="control-label col-md-3">Morfología craneofacial</label>
						<div class="col-md-4">
							<select name="morfologiaCraneofacial" id="morfologiaCraneofacial" class="form-control required">
								<option value="">Seleccione</option>
								@foreach($morfologiasCraneofaciales as $morfologiaCraneofacial)
									<option value="{{ $morfologiaCraneofacial->getId() }}">{{ $morfologiaCraneofacial->getMorfologiaCraneofacial() }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="morfologiaFacial" class="control-label col-md-3">Morfología facial</label>
						<div class="col-md-4">
							<select name="morfologiaFacial" id="morfologiaFacial" class="form-control required">
								<option value="">Seleccione</option>
								@foreach($morfologiasFaciales as $morfologiaFacial)
									<option value="{{ $morfologiaFacial->getId() }}">{{ $morfologiaFacial->getMorfologiaFacial() }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="convexividadFacial" class="control-label col-md-3">Convexividad facial</label>
						<div class="col-md-4">
							<select name="convexividadFacial" id="convexividadFacial" class="form-control required">
								<option value="">Seleccione</option>
								@foreach($convexividadesFaciales as $convexividadFacial)
									<option value="{{ $convexividadFacial->getId() }}">{{ $convexividadFacial->getConvexividadFacial() }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="atm" class="control-label col-md-3">ATM</label>
						<div class="col-md-4">
							<select name="atm" id="atm" class="form-control required">
								<option value="">Seleccione</option>
								@foreach($atms as $atm)
									<option value="{{ $atm->getId() }}">{{ $atm->getATM() }}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
			</div>

			<div class="widget">
				<div class="widget-head">
					<h4 class="heading">Examen intraoral</h4>
				</div>
				<div class="widget-body">
					<div class="form-group">
						<label class="control-label col-md-3">Labios:</label>
						<div class="col-md-8">
							<input type="text" name="labios" id="labios" value="" placeholder="" class="required form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Carrillos:</label>
						<div class="col-md-8">
							<input type="text" name="carrillos" id="carrillos" value="" placeholder="" class="required form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Frenillos:</label>
						<div class="col-md-8">
							<input type="text" name="frenillos" id="frenillos" value="" placeholder="" class="required form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Paladar:</label>
						<div class="col-md-8">
							<input type="text" name="paladar" id="paladar" value="" placeholder="" class="required form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Lengua:</label>
						<div class="col-md-8">
							<input type="text" name="lengua" id="lengua" value="" placeholder="" class="required form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Piso de boca:</label>
						<div class="col-md-8">
							<input type="text" name="pisoBoca" id="pisoBoca" value="" placeholder="" class="required form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Parodonto:</label>
						<div class="col-md-8">
							<input type="text" name="parodonto" id="parodonto" value="" placeholder="" class="required form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Úvula:</label>
						<div class="col-md-8">
							<input type="text" name="uvula" id="uvula" value="" placeholder="" class="required form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Orofaringe:</label>
						<div class="col-md-8">
							<input type="text" name="orofaringe" id="orofaringe" value="" placeholder="" class="required form-control">
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6 col-lg-6">
			<div class="widget">
				<div class="widget-head">
					<h4 class="heading">Tejidos duros</h4>
				</div>

				<div class="widget-body">
					<div class="form-group">
						<label class="control-label col-md-3">Tipo de arco:</label>
						<div class="col-md-3">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="arcoTipoI">Tipo I
								</label>
							</div>

							<div class="checkbox">
								<label>
									<input type="checkbox" name="arcoTipoII">Tipo II
								</label>
							</div>
						</div>
					</div>

					<div class="separator"></div>

					<div class="row">
						<div class="col-xs-12">
							<h4 class="text-small">Dentinción temporal</h4>
							<table class="table table-bordered">
								<thead class="bg-gray">
									<tr>
										<th>Planos terminales</th>
										<th>Der</th>
										<th>Izq</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Escalón mesial</td>
										<td><input type="checkbox" name="mesialDer"></td>
										<td><input type="checkbox" name="mesialIzq"></td>
									</tr>

									<tr>
										<td>Escalón distal</td>
										<td><input type="checkbox" name="distalDer"></td>
										<td><input type="checkbox" name="distalIzq"></td>
									</tr>

									<tr>
										<td>Escalón recto</td>
										<td><input type="checkbox" name="rectoDer"></td>
										<td><input type="checkbox" name="rectoIzq"></td>
									</tr>

									<tr>
										<td>Mesial exagerado</td>
										<td><input type="checkbox" name="exageradoDer"></td>
										<td><input type="checkbox" name="exageradoIzq"></td>
									</tr>

									<tr>
										<td>No determinado</td>
										<td><input type="checkbox" name="noDeterminadoDer"></td>
										<td><input type="checkbox" name="noDeterminadoIzq"></td>
									</tr>

									<tr>
										<td>Relación canina</td>
										<td><input type="checkbox" name="caninaDer"></td>
										<td><input type="checkbox" name="caninaIzq"></td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="col-xs-12">
							<h4 class="text-small">Dentinción mixta o permanente</h4>
							<table class="table table-bordered">
								<thead class="bg-gray">
									<tr>
										<th rowspan="2">&nbsp;</th>
										<th colspan="3">Der</th>
										<th colspan="3">Izq</th>
									</tr>
									<tr>
										<th>I</th>
										<th>II</th>
										<th>III</th>
										<th>I</th>
										<th>II</th>
										<th>III</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Relación molar</td>
										<td><input type="checkbox" name="relacionMolarDerI"></td>
										<td><input type="checkbox" name="relacionMolarDerII"></td>
										<td><input type="checkbox" name="relacionMolarDerIII"></td>
										<td><input type="checkbox" name="relacionMolarIzqI"></td>
										<td><input type="checkbox" name="relacionMolarIzqII"></td>
										<td><input type="checkbox" name="relacionMolarIzqIII"></td>
									</tr>

									<tr>
										<td>Relación canina</td>
										<td><input type="checkbox" name="relacionCaninaDerI"></td>
										<td><input type="checkbox" name="relacionCaninaDerII"></td>
										<td><input type="checkbox" name="relacionCaninaDerIII"></td>
										<td><input type="checkbox" name="relacionCaninaIzqI"></td>
										<td><input type="checkbox" name="relacionCaninaIzqII"></td>
										<td><input type="checkbox" name="relacionCaninaIzqIII"></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<div class="col-md-8 col-md-offset-1">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="mordidaBordeBorde" class="medidas" data-id="medidaMordida"> Mordida borde a borde
										</label>
									</div>
									<div class="input-group">
										<input type="text" name="medidaMordida" id="medidaMordida" class="form-control" readonly="readonly">
										<span class="input-group-addon">mm</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-8 col-md-offset-1">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="sobremordidaVertical" class="medidas" data-id="medidaSobremordidaVertical"> Sobremordida vertical (overbite)
										</label>
									</div>
									<div class="input-group">
										<input type="text" name="medidaSobremordidaVertical" id="medidaSobremordidaVertical" class="form-control" readonly="readonly">
										<span class="input-group-addon">mm</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-8 col-md-offset-1">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="sobremordidaHorizontal" class="medidas" data-id="medidaSobremordidaHorizontal"> Sobremordida horizontal (overjet)
										</label>
									</div>
									<div class="input-group">
										<input type="text" name="medidaSobremordidaHorizontal" id="medidaSobremordidaHorizontal" class="form-control" readonly="readonly">
										<span class="input-group-addon">mm</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-8 col-md-offset-1">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="mordidaAbiertaAnterior" class="medidas" data-id="medidaMordidaAbierta"> Mordida abierta anterior
										</label>
									</div>
									<div class="input-group">
										<input type="text" name="medidaMordidaAbierta" id="medidaMordidaAbierta" class="form-control" readonly="readonly">
										<span class="input-group-addon">mm</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-8 col-md-offset-1">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="mordidaCruzadaAnterior" class="medidas" data-id="medidaMordidaCruzadaAnterior"> Mordida cruzada anterior
										</label>
									</div>
									<div class="input-group">
										<input type="text" name="medidaMordidaCruzadaAnterior" id="medidaMordidaCruzadaAnterior" class="form-control" readonly="readonly">
										<span class="input-group-addon">mm</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-8 col-md-offset-1">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="mordidaCruzadaPosterior" class="medidas" data-id="medidaMordidaCruzadaPosterior"> Mordida cruzada posterior
										</label>
									</div>
									<div class="input-group">
										<input type="text" name="medidaMordidaCruzadaPosterior" id="medidaMordidaCruzadaPosterior" class="form-control" readonly="readonly">
										<span class="input-group-addon">mm</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-8 col-md-offset-1">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="lineaMediaDental" class="medidas" data-id="medidaLineaMediaDental"> Línea media dental
										</label>
									</div>
									<div class="input-group">
										<input type="text" name="medidaLineaMediaDental" id="medidaLineaMediaDental" class="form-control" readonly="readonly">
										<span class="input-group-addon">mm</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-8 col-md-offset-1">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="lineaMediaEsqueletica" class="medidas" data-id="medidaLineaMediaEsqueletica"> Línea media esquelética
										</label>
									</div>
									<div class="input-group">
										<input type="text" name="medidaLineaMediaEsqueletica" id="medidaLineaMediaEsqueletica" class="form-control" readonly="readonly">
										<span class="input-group-addon">mm</span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-12 col-lg-6">
							<div class="form-group">
								<div class="col-md-8 col-md-offset-1">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="alteracionTamanio" class="medidas" data-id="medidaAlteracionTamanio"> Alteraciones de tamaño
										</label>
									</div>
									<div class="input-group">
										<input type="text" name="medidaAlteracionTamanio" id="medidaAlteracionTamanio" class="form-control" readonly="readonly">
										<span class="input-group-addon">mm</span>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-8 col-md-offset-1">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="alteracionForma" class="medidas" data-id="medidaAlteracionForma"> Alteraciones de forma
										</label>
									</div>
									<div class="input-group">
										<input type="text" name="medidaAlteracionForma" id="medidaAlteracionForma" class="form-control" readonly="readonly">
										<span class="input-group-addon">mm</span>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-8 col-md-offset-1">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="alteracionNumero" class="medidas" data-id="medidaAlteracionNumero"> Alteraciones de número
										</label>
									</div>
									<div class="input-group">
										<input type="text" name="medidaAlteracionNumero" id="medidaAlteracionNumero" class="form-control" readonly="readonly">
										<span class="input-group-addon">mm</span>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-8 col-md-offset-1">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="alteracionEstructura" class="medidas" data-id="medidaAlteracionEstructura"> Alteraciones de estructura
										</label>
									</div>
									<div class="input-group">
										<input type="text" name="medidaAlteracionEstructura" id="medidaAlteracionEstructura" class="form-control" readonly="readonly">
										<span class="input-group-addon">mm</span>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-8 col-md-offset-1">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="alteracionTextura" class="medidas" data-id="medidaAlteracionTextura"> Alteraciones de textura
										</label>
									</div>
									<div class="input-group">
										<input type="text" name="medidaAlteracionTextura" id="medidaAlteracionTextura" class="form-control" readonly="readonly">
										<span class="input-group-addon">mm</span>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-8 col-md-offset-1">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="alteracionColor" class="medidas" data-id="medidaAlteracionColor"> Alteraciones de color
										</label>
									</div>
									<div class="input-group">
										<input type="text" name="medidaAlteracionColor" id="medidaAlteracionColor" class="form-control" readonly="readonly">
										<span class="input-group-addon">mm</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>