<div class="tab-pane" id="expedienteConsulta">
	<div class="row">
		<div class="col-md-12 col-lg-6">
			<div class="widget">
				<div class="widget-head">
					<h4 class="heading">Examen extraoral</h4>
				</div>
				<div class="widget-body">
                    <div class="innerAll">
                        <div class="form-group">
                            <label for="morfologiaCraneofacial" class="control-label col-md-3">Morfología craneofacial</label>
                            <div class="col-md-4">
                                <select name="morfologiaCraneofacial" id="morfologiaCraneofacial" class="form-control required">
                                    <option value="">Seleccione</option>
                                    @foreach($morfologiasCraneofaciales as $morfologiaCraneofacial)
                                        <option value="{{ $morfologiaCraneofacial->getId() }}" {!!  $expediente->getExpedienteEspecialidad()->getMorfologiaCraneofacial()->getId() === $morfologiaCraneofacial->getId() ? 'selected="selected"' : '' !!}>{{ $morfologiaCraneofacial->getMorfologiaCraneofacial() }}</option>
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
                                        <option value="{{ $morfologiaFacial->getId() }}" {!!  $expediente->getExpedienteEspecialidad()->getMorfologiaFacial()->getId() === $morfologiaFacial->getId() ? 'selected="selected"' : '' !!}>{{ $morfologiaFacial->getMorfologiaFacial() }}</option>
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
                                        <option value="{{ $convexividadFacial->getId() }}" {!!  $expediente->getExpedienteEspecialidad()->getConvexividadFacial()->getId() === $convexividadFacial->getId() ? 'selected="selected"' : '' !!}>{{ $convexividadFacial->getConvexividadFacial() }}</option>
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
                                        <option value="{{ $atm->getId() }}" {!!  $expediente->getExpedienteEspecialidad()->getATM()->getId() === $atm->getId() ? 'selected="selected"' : '' !!}>{{ $atm->getATM() }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
				</div>
			</div>

			<div class="widget">
				<div class="widget-head">
					<h4 class="heading">Examen intraoral</h4>
				</div>
				<div class="widget-body">
                    <div class="innerAll">
                        <div class="form-group">
                            <label class="control-label col-md-3">Labios:</label>
                            <div class="col-md-8">
                                <input type="text" name="labios" id="labios" value="{{ $expediente->getExpedienteEspecialidad()->getExamenIntraoral()->getLabios() }}" placeholder="" class="required form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Carrillos:</label>
                            <div class="col-md-8">
                                <input type="text" name="carrillos" id="carrillos" value="{{ $expediente->getExpedienteEspecialidad()->getExamenIntraoral()->getCarrillos() }}" placeholder="" class="required form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Frenillos:</label>
                            <div class="col-md-8">
                                <input type="text" name="frenillos" id="frenillos" value="{{ $expediente->getExpedienteEspecialidad()->getExamenIntraoral()->getFrenillos() }}" placeholder="" class="required form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Paladar:</label>
                            <div class="col-md-8">
                                <input type="text" name="paladar" id="paladar" value="{{ $expediente->getExpedienteEspecialidad()->getExamenIntraoral()->getPaladar() }}" placeholder="" class="required form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Lengua:</label>
                            <div class="col-md-8">
                                <input type="text" name="lengua" id="lengua" value="{{ $expediente->getExpedienteEspecialidad()->getExamenIntraoral()->getLengua() }}" placeholder="" class="required form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Piso de boca:</label>
                            <div class="col-md-8">
                                <input type="text" name="pisoBoca" id="pisoBoca" value="{{ $expediente->getExpedienteEspecialidad()->getExamenIntraoral()->getPisoDeBoca() }}" placeholder="" class="required form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Parodonto:</label>
                            <div class="col-md-8">
                                <input type="text" name="parodonto" id="parodonto" value="{{ $expediente->getExpedienteEspecialidad()->getExamenIntraoral()->getParodonto() }}" placeholder="" class="required form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Úvula:</label>
                            <div class="col-md-8">
                                <input type="text" name="uvula" id="uvula" value="{{ $expediente->getExpedienteEspecialidad()->getExamenIntraoral()->getUvula() }}" placeholder="" class="required form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Orofaringe:</label>
                            <div class="col-md-8">
                                <input type="text" name="orofaringe" id="orofaringe" value="{{ $expediente->getExpedienteEspecialidad()->getExamenIntraoral()->getOrofaringe() }}" placeholder="" class="required form-control">
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>

		<div class="col-md-12 col-lg-6">
			<div class="widget">
				<div class="widget-head">
					<h4 class="heading">Tejidos duros</h4>
				</div>

				<div class="widget-body">
                    <div class="innerAll">
                        <div class="form-group">
                            <label class="control-label col-md-3">Tipo de arco:</label>
                            <div class="col-md-3">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="arcoTipoI" {!! $expediente->getExpedienteEspecialidad()->tipoArcoI() ? 'checked' : '' !!}>Tipo I
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="arcoTipoII" {!! $expediente->getExpedienteEspecialidad()->tipoArcoII() ? 'checked' : '' !!}>Tipo II
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
                                        <td><input type="checkbox" name="mesialDer" {!! $expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getEscalonMesial()->derecho() ? 'checked' : '' !!}></td>
                                        <td><input type="checkbox" name="mesialIzq" {!! $expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getEscalonMesial()->izquierdo() ? 'checked' : '' !!}></td>
                                    </tr>

                                    <tr>
                                        <td>Escalón distal</td>
                                        <td><input type="checkbox" name="distalDer" {!! $expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getEscalonDistal()->derecho() ? 'checked' : '' !!}></td>
                                        <td><input type="checkbox" name="distalIzq" {!! $expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getEscalonDistal()->izquierdo() ? 'checked' : '' !!}></td>
                                    </tr>

                                    <tr>
                                        <td>Escalón recto</td>
                                        <td><input type="checkbox" name="rectoDer" {!! $expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getEscalonRecto()->derecho() ? 'checked' : '' !!}></td>
                                        <td><input type="checkbox" name="rectoIzq" {!! $expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getEscalonRecto()->izquierdo() ? 'checked' : '' !!}></td>
                                    </tr>

                                    <tr>
                                        <td>Mesial exagerado</td>
                                        <td><input type="checkbox" name="exageradoDer" {!! $expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getMesialExagerado()->derecho() ? 'checked' : '' !!}></td>
                                        <td><input type="checkbox" name="exageradoIzq" {!! $expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getMesialExagerado()->izquierdo() ? 'checked' : '' !!}></td>
                                    </tr>

                                    <tr>
                                        <td>No determinado</td>
                                        <td><input type="checkbox" name="noDeterminadoDer" {!! $expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getMesialNoDeterminado()->derecho() ? 'checked' : '' !!}></td>
                                        <td><input type="checkbox" name="noDeterminadoIzq" {!! $expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getMesialNoDeterminado()->izquierdo() ? 'checked' : '' !!}></td>
                                    </tr>

                                    <tr>
                                        <td>Relación canina</td>
                                        <td><input type="checkbox" name="caninaDer" {!! $expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getRelacionCanina()->derecho() ? 'checked' : '' !!}></td>
                                        <td><input type="checkbox" name="caninaIzq" {!! $expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getRelacionCanina()->izquierdo() ? 'checked' : '' !!}></td>
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
                                        <td><input type="checkbox" name="relacionMolarDerI" {!! $expediente->getExpedienteEspecialidad()->getRelacionMolar()->derechaI() ? 'checked' : '' !!}></td>
                                        <td><input type="checkbox" name="relacionMolarDerII" {!! $expediente->getExpedienteEspecialidad()->getRelacionMolar()->derechaII() ? 'checked' : '' !!}></td>
                                        <td><input type="checkbox" name="relacionMolarDerIII" {!! $expediente->getExpedienteEspecialidad()->getRelacionMolar()->derechaIII() ? 'checked' : '' !!}></td>
                                        <td><input type="checkbox" name="relacionMolarIzqI" {!! $expediente->getExpedienteEspecialidad()->getRelacionMolar()->izquierdaI() ? 'checked' : '' !!}></td>
                                        <td><input type="checkbox" name="relacionMolarIzqII" {!! $expediente->getExpedienteEspecialidad()->getRelacionMolar()->izquierdaII() ? 'checked' : '' !!}></td>
                                        <td><input type="checkbox" name="relacionMolarIzqIII" {!! $expediente->getExpedienteEspecialidad()->getRelacionMolar()->izquierdaIII() ? 'checked' : '' !!}></td>
                                    </tr>

                                    <tr>
                                        <td>Relación canina</td>
                                        <td><input type="checkbox" name="relacionCaninaDerI" {!! $expediente->getExpedienteEspecialidad()->getRelacionCanina()->derechaI() ? 'checked' : '' !!}></td>
                                        <td><input type="checkbox" name="relacionCaninaDerII" {!! $expediente->getExpedienteEspecialidad()->getRelacionCanina()->derechaII() ? 'checked' : '' !!}></td>
                                        <td><input type="checkbox" name="relacionCaninaDerIII" {!! $expediente->getExpedienteEspecialidad()->getRelacionCanina()->derechaIII() ? 'checked' : '' !!}></td>
                                        <td><input type="checkbox" name="relacionCaninaIzqI" {!! $expediente->getExpedienteEspecialidad()->getRelacionCanina()->izquierdaI() ? 'checked' : '' !!}></td>
                                        <td><input type="checkbox" name="relacionCaninaIzqII" {!! $expediente->getExpedienteEspecialidad()->getRelacionCanina()->izquierdaII() ? 'checked' : '' !!}></td>
                                        <td><input type="checkbox" name="relacionCaninaIzqIII" {!! $expediente->getExpedienteEspecialidad()->getRelacionCanina()->izquierdaIII() ? 'checked' : '' !!}></td>
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
                                                <input type="checkbox" name="mordidaBordeBorde" class="medidas" data-id="medidaMordida" {!! $expediente->getExpedienteEspecialidad()->getMordidaBordeBorde()->activa() ? 'checked' : '' !!}> Mordida borde a borde
                                            </label>
                                        </div>
                                        <div class="input-group">
                                            <input type="text" name="medidaMordida" id="medidaMordida" value="{!! $expediente->getExpedienteEspecialidad()->getMordidaBordeBorde()->activa() ? $expediente->getExpedienteEspecialidad()->getMordidaBordeBorde()->getMedida() : '' !!}" class="form-control" {!! $expediente->getExpedienteEspecialidad()->getMordidaBordeBorde()->activa() ? '' : 'readonly' !!}>
                                            <span class="input-group-addon">mm</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-1">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="sobremordidaVertical" class="medidas" data-id="medidaSobremordidaVertical" {!! $expediente->getExpedienteEspecialidad()->getSobremordidaVertical()->activa() ? 'checked' : '' !!}> Sobremordida vertical (overbite)
                                            </label>
                                        </div>
                                        <div class="input-group">
                                            <input type="text" name="medidaSobremordidaVertical" id="medidaSobremordidaVertical" class="form-control" value="{!! $expediente->getExpedienteEspecialidad()->getSobremordidaVertical()->activa() ? $expediente->getExpedienteEspecialidad()->getSobremordidaVertical()->getMedida() : '' !!}" {!! $expediente->getExpedienteEspecialidad()->getSobremordidaVertical()->activa() ? '' : 'readonly' !!}>
                                            <span class="input-group-addon">mm</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-1">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="sobremordidaHorizontal" class="medidas" data-id="medidaSobremordidaHorizontal" {!! $expediente->getExpedienteEspecialidad()->getSobremordidaHorizontal()->activa() ? 'checked' : '' !!}> Sobremordida horizontal (overjet)
                                            </label>
                                        </div>
                                        <div class="input-group">
                                            <input type="text" name="medidaSobremordidaHorizontal" id="medidaSobremordidaHorizontal" class="form-control" value="{!! $expediente->getExpedienteEspecialidad()->getSobremordidaHorizontal()->activa() ? $expediente->getExpedienteEspecialidad()->getSobremordidaHorizontal()->getMedida() : '' !!}" {!! $expediente->getExpedienteEspecialidad()->getSobremordidaHorizontal()->activa() ? '' : 'readonly' !!}>
                                            <span class="input-group-addon">mm</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-1">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="mordidaAbiertaAnterior" class="medidas" data-id="medidaMordidaAbierta" {!! $expediente->getExpedienteEspecialidad()->getMordidaAbiertaAnterior()->activa() ? 'checked' : '' !!}> Mordida abierta anterior
                                            </label>
                                        </div>
                                        <div class="input-group">
                                            <input type="text" name="medidaMordidaAbierta" id="medidaMordidaAbierta" class="form-control" value="{!! $expediente->getExpedienteEspecialidad()->getMordidaAbiertaAnterior()->activa() ? $expediente->getExpedienteEspecialidad()->getMordidaAbiertaAnterior()->getMedida() : '' !!}" {!! $expediente->getExpedienteEspecialidad()->getMordidaAbiertaAnterior()->activa() ? '' : 'readonly' !!}>
                                            <span class="input-group-addon">mm</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-1">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="mordidaCruzadaAnterior" class="medidas" data-id="medidaMordidaCruzadaAnterior" {!! $expediente->getExpedienteEspecialidad()->getMordidaCruzadaAnterior()->activa() ? 'checked' : '' !!}> Mordida cruzada anterior
                                            </label>
                                        </div>
                                        <div class="input-group">
                                            <input type="text" name="medidaMordidaCruzadaAnterior" id="medidaMordidaCruzadaAnterior" class="form-control" value="{!! $expediente->getExpedienteEspecialidad()->getMordidaCruzadaAnterior()->activa() ? $expediente->getExpedienteEspecialidad()->getMordidaCruzadaAnterior()->getMedida() : '' !!}" {!! $expediente->getExpedienteEspecialidad()->getMordidaCruzadaAnterior()->activa() ? '' : 'readonly' !!}>
                                            <span class="input-group-addon">mm</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-1">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="mordidaCruzadaPosterior" class="medidas" data-id="medidaMordidaCruzadaPosterior" {!! $expediente->getExpedienteEspecialidad()->getMordidaCruzadaPosterior()->activa() ? 'checked' : '' !!}> Mordida cruzada posterior
                                            </label>
                                        </div>
                                        <div class="input-group">
                                            <input type="text" name="medidaMordidaCruzadaPosterior" id="medidaMordidaCruzadaPosterior" class="form-control" value="{!! $expediente->getExpedienteEspecialidad()->getMordidaCruzadaPosterior()->activa() ? $expediente->getExpedienteEspecialidad()->getMordidaCruzadaPosterior()->getMedida() : '' !!}" {!! $expediente->getExpedienteEspecialidad()->getMordidaCruzadaPosterior()->activa() ? '' : 'readonly' !!}>
                                            <span class="input-group-addon">mm</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-1">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="lineaMediaDental" class="medidas" data-id="medidaLineaMediaDental" {!! $expediente->getExpedienteEspecialidad()->getLineaMediaDental()->activa() ? 'checked' : '' !!}> Línea media dental
                                            </label>
                                        </div>
                                        <div class="input-group">
                                            <input type="text" name="medidaLineaMediaDental" id="medidaLineaMediaDental" class="form-control" value="{!! $expediente->getExpedienteEspecialidad()->getLineaMediaDental()->activa() ? $expediente->getExpedienteEspecialidad()->getLineaMediaDental()->getMedida() : '' !!}" {!! $expediente->getExpedienteEspecialidad()->getLineaMediaDental()->activa() ? '' : 'readonly' !!}>
                                            <span class="input-group-addon">mm</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-1">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="lineaMediaEsqueletica" class="medidas" data-id="medidaLineaMediaEsqueletica" {!! $expediente->getExpedienteEspecialidad()->getLineaMediaEsqueletica()->activa() ? 'checked' : '' !!}> Línea media esquelética
                                            </label>
                                        </div>
                                        <div class="input-group">
                                            <input type="text" name="medidaLineaMediaEsqueletica" id="medidaLineaMediaEsqueletica" class="form-control" value="{!! $expediente->getExpedienteEspecialidad()->getLineaMediaEsqueletica()->activa() ? $expediente->getExpedienteEspecialidad()->getLineaMediaEsqueletica()->getMedida() : '' !!}" {!! $expediente->getExpedienteEspecialidad()->getLineaMediaEsqueletica()->activa() ? '' : 'readonly' !!}>
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
                                                <input type="checkbox" name="alteracionTamanio" class="medidas" data-id="medidaAlteracionTamanio" {!! $expediente->getExpedienteEspecialidad()->getAlteracionesTamanio()->activa() ? 'checked' : '' !!}> Alteraciones de tamaño
                                            </label>
                                        </div>
                                        <div class="input-group">
                                            <input type="text" name="medidaAlteracionTamanio" id="medidaAlteracionTamanio" class="form-control" value="{!! $expediente->getExpedienteEspecialidad()->getAlteracionesTamanio()->activa() ? $expediente->getExpedienteEspecialidad()->getAlteracionesTamanio()->getMedida() : '' !!}" {!! $expediente->getExpedienteEspecialidad()->getAlteracionesTamanio()->activa() ? '' : 'readonly' !!}>
                                            <span class="input-group-addon">mm</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-1">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="alteracionForma" class="medidas" data-id="medidaAlteracionForma" {!! $expediente->getExpedienteEspecialidad()->getAlteracionesForma()->activa() ? 'checked' : '' !!}> Alteraciones de forma
                                            </label>
                                        </div>
                                        <div class="input-group">
                                            <input type="text" name="medidaAlteracionForma" id="medidaAlteracionForma" class="form-control" value="{!! $expediente->getExpedienteEspecialidad()->getAlteracionesForma()->activa() ? $expediente->getExpedienteEspecialidad()->getAlteracionesForma()->getMedida() : '' !!}" {!! $expediente->getExpedienteEspecialidad()->getAlteracionesForma()->activa() ? '' : 'readonly' !!}>
                                            <span class="input-group-addon">mm</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-1">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="alteracionNumero" class="medidas" data-id="medidaAlteracionNumero" {!! $expediente->getExpedienteEspecialidad()->getAlteracionesNumero()->activa() ? 'checked' : '' !!}> Alteraciones de número
                                            </label>
                                        </div>
                                        <div class="input-group">
                                            <input type="text" name="medidaAlteracionNumero" id="medidaAlteracionNumero" class="form-control" value="{!! $expediente->getExpedienteEspecialidad()->getAlteracionesNumero()->activa() ? $expediente->getExpedienteEspecialidad()->getAlteracionesNumero()->getMedida() : '' !!}" {!! $expediente->getExpedienteEspecialidad()->getAlteracionesNumero()->activa() ? '' : 'readonly' !!}>
                                            <span class="input-group-addon">mm</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-1">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="alteracionEstructura" class="medidas" data-id="medidaAlteracionEstructura" {!! $expediente->getExpedienteEspecialidad()->getAlteracionesEstructura()->activa() ? 'checked' : '' !!}> Alteraciones de estructura
                                            </label>
                                        </div>
                                        <div class="input-group">
                                            <input type="text" name="medidaAlteracionEstructura" id="medidaAlteracionEstructura" class="form-control" value="{!! $expediente->getExpedienteEspecialidad()->getAlteracionesEstructura()->activa() ? $expediente->getExpedienteEspecialidad()->getAlteracionesEstructura()->getMedida() : '' !!}" {!! $expediente->getExpedienteEspecialidad()->getAlteracionesEstructura()->activa() ? '' : 'readonly' !!}>
                                            <span class="input-group-addon">mm</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-1">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="alteracionTextura" class="medidas" data-id="medidaAlteracionTextura" {!! $expediente->getExpedienteEspecialidad()->getAlteracionesTextura()->activa() ? 'checked' : '' !!}> Alteraciones de textura
                                            </label>
                                        </div>
                                        <div class="input-group">
                                            <input type="text" name="medidaAlteracionTextura" id="medidaAlteracionTextura" class="form-control" value="{!! $expediente->getExpedienteEspecialidad()->getAlteracionesTextura()->activa() ? $expediente->getExpedienteEspecialidad()->getAlteracionesTextura()->getMedida() : '' !!}" {!! $expediente->getExpedienteEspecialidad()->getAlteracionesTextura()->activa() ? '' : 'readonly' !!}>
                                            <span class="input-group-addon">mm</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-1">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="alteracionColor" class="medidas" data-id="medidaAlteracionColor" {!! $expediente->getExpedienteEspecialidad()->getAlteracionesColor()->activa() ? 'checked' : '' !!}> Alteraciones de color
                                            </label>
                                        </div>
                                        <div class="input-group">
                                            <input type="text" name="medidaAlteracionColor" id="medidaAlteracionColor" class="form-control" value="{!! $expediente->getExpedienteEspecialidad()->getAlteracionesColor()->activa() ? $expediente->getExpedienteEspecialidad()->getAlteracionesColor()->getMedida() : '' !!}" {!! $expediente->getExpedienteEspecialidad()->getAlteracionesColor()->activa() ? '' : 'readonly' !!}>
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
</div>