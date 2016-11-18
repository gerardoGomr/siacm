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
                                <p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->getMorfologiaCraneofacial()->getMorfologiaCraneofacial() }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="morfologiaFacial" class="control-label col-md-3">Morfología facial</label>
                            <div class="col-md-4">
                                <p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->getMorfologiaFacial()->getMorfologiaFacial() }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="convexividadFacial" class="control-label col-md-3">Convexividad facial</label>
                            <div class="col-md-4">
                                <p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->getConvexividadFacial()->getConvexividadFacial() }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="atm" class="control-label col-md-3">ATM</label>
                            <div class="col-md-4">
                                <p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->getATM()->getATM() }}</p>
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
                                <p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->getExamenIntraoral()->getLabios() }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Carrillos:</label>
                            <div class="col-md-8">
                                <p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->getExamenIntraoral()->getCarrillos() }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Frenillos:</label>
                            <div class="col-md-8">
                                <p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->getExamenIntraoral()->getFrenillos() }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Paladar:</label>
                            <div class="col-md-8">
                                <p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->getExamenIntraoral()->getPaladar() }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Lengua:</label>
                            <div class="col-md-8">
                                <p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->getExamenIntraoral()->getLengua() }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Piso de boca:</label>
                            <div class="col-md-8">
                                <p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->getExamenIntraoral()->getPisoDeBoca() }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Parodonto:</label>
                            <div class="col-md-8">
                                <p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->getExamenIntraoral()->getParodonto() }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Úvula:</label>
                            <div class="col-md-8">
                                <p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->getExamenIntraoral()->getUvula() }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Orofaringe:</label>
                            <div class="col-md-8">
                                <p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->getExamenIntraoral()->getOrofaringe() }}</p>
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
                                <p class="form-control-static">{{ $expediente->getExpedienteEspecialidad()->tipoArco() }}</p>
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
                                        <td>{!! $expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getEscalonMesial()->derecho() ? '<i class="fa fa-check"></i>' : '-' !!}</td>
                                        <td>{!! $expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getEscalonMesial()->izquierdo() ? '<i class="fa fa-check"></i>' : '-' !!}</td>
                                    </tr>

                                    <tr>
                                        <td>Escalón distal</td>
                                        <td>{!! $expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getEscalonDistal()->derecho() ? '<i class="fa fa-check"></i>' : '-' !!}</td>
                                        <td>{!! $expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getEscalonDistal()->izquierdo() ? '<i class="fa fa-check"></i>' : '-' !!}</td>
                                    </tr>

                                    <tr>
                                        <td>Escalón recto</td>
                                        <td>{!! $expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getEscalonRecto()->derecho() ? '<i class="fa fa-check"></i>' : '-' !!}</td>
                                        <td>{!! $expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getEscalonRecto()->izquierdo() ? '<i class="fa fa-check"></i>' : '-' !!}</td>
                                    </tr>

                                    <tr>
                                        <td>Mesial exagerado</td>
                                        <td>{!! $expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getMesialExagerado()->derecho() ? '<i class="fa fa-check"></i>' : '-' !!}</td>
                                        <td>{!! $expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getMesialExagerado()->izquierdo() ? '<i class="fa fa-check"></i>' : '-' !!}</td>
                                    </tr>

                                    <tr>
                                        <td>No determinado</td>
                                        <td>{!! $expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getMesialNoDeterminado()->derecho() ? '<i class="fa fa-check"></i>' : '-' !!}</td>
                                        <td>{!! $expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getMesialNoDeterminado()->izquierdo() ? '<i class="fa fa-check"></i>' : '-' !!}</td>
                                    </tr>

                                    <tr>
                                        <td>Relación canina</td>
                                        <td>{!! $expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getRelacionCanina()->derecho() ? '<i class="fa fa-check"></i>' : '-' !!}</td>
                                        <td>{!! $expediente->getExpedienteEspecialidad()->getDentincionTemporal()->getRelacionCanina()->izquierdo() ? '<i class="fa fa-check"></i>' : '-' !!}</td>
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
                                        <td>{!! $expediente->getExpedienteEspecialidad()->getRelacionMolar()->derechaI() ? '<i class="fa fa-check"></i>' : '-' !!}</td>
                                        <td>{!! $expediente->getExpedienteEspecialidad()->getRelacionMolar()->derechaII() ? '<i class="fa fa-check"></i>' : '-' !!}</td>
                                        <td>{!! $expediente->getExpedienteEspecialidad()->getRelacionMolar()->derechaIII() ? '<i class="fa fa-check"></i>' : '-' !!}</td>
                                        <td>{!! $expediente->getExpedienteEspecialidad()->getRelacionMolar()->izquierdaI() ? '<i class="fa fa-check"></i>' : '-' !!}</td>
                                        <td>{!! $expediente->getExpedienteEspecialidad()->getRelacionMolar()->izquierdaII() ? '<i class="fa fa-check"></i>' : '-' !!}</td>
                                        <td>{!! $expediente->getExpedienteEspecialidad()->getRelacionMolar()->izquierdaIII() ? '<i class="fa fa-check"></i>' : '-' !!}</td>
                                    </tr>

                                    <tr>
                                        <td>Relación canina</td>
                                        <td>{!! $expediente->getExpedienteEspecialidad()->getRelacionCanina()->derechaI() ? '<i class="fa fa-check"></i>' : '-' !!}</td>
                                        <td>{!! $expediente->getExpedienteEspecialidad()->getRelacionCanina()->derechaII() ? '<i class="fa fa-check"></i>' : '-' !!}</td>
                                        <td>{!! $expediente->getExpedienteEspecialidad()->getRelacionCanina()->derechaIII() ? '<i class="fa fa-check"></i>' : '-' !!}</td>
                                        <td>{!! $expediente->getExpedienteEspecialidad()->getRelacionCanina()->izquierdaI() ? '<i class="fa fa-check"></i>' : '-' !!}</td>
                                        <td>{!! $expediente->getExpedienteEspecialidad()->getRelacionCanina()->izquierdaII() ? '<i class="fa fa-check"></i>' : '-' !!}</td>
                                        <td>{!! $expediente->getExpedienteEspecialidad()->getRelacionCanina()->izquierdaIII() ? '<i class="fa fa-check"></i>' : '-' !!}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Mordida borde a borde:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{!! $expediente->getExpedienteEspecialidad()->getMordidaBordeBorde()->activa() ? $expediente->getExpedienteEspecialidad()->getSobremordidaVertical()->medidaMordida() : '-' !!}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Sobremordida vertical (overbite):</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{!! $expediente->getExpedienteEspecialidad()->getSobremordidaVertical()->activa() ? $expediente->getExpedienteEspecialidad()->getSobremordidaVertical()->medidaMordida() : '-' !!}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Sobremordida horizontal (overjet):</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{!! $expediente->getExpedienteEspecialidad()->getSobremordidaHorizontal()->activa() ? $expediente->getExpedienteEspecialidad()->getSobremordidaHorizontal()->medidaMordida() : '-' !!}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Mordida abierta anterior:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{!! $expediente->getExpedienteEspecialidad()->getMordidaAbiertaAnterior()->activa() ? $expediente->getExpedienteEspecialidad()->getMordidaAbiertaAnterior()->medidaMordida() : '-' !!}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Mordida cruzada anterior:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{!! $expediente->getExpedienteEspecialidad()->getMordidaCruzadaAnterior()->activa() ? $expediente->getExpedienteEspecialidad()->getMordidaCruzadaAnterior()->medidaMordida() : '-' !!}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Mordida cruzada posterior:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{!! $expediente->getExpedienteEspecialidad()->getMordidaCruzadaPosterior()->activa() ? $expediente->getExpedienteEspecialidad()->getMordidaCruzadaPosterior()->medidaMordida() : '-' !!}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Línea media dental:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{!! $expediente->getExpedienteEspecialidad()->getLineaMediaDental()->activa() ? $expediente->getExpedienteEspecialidad()->getLineaMediaDental()->medidaMordida() : '-' !!}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Línea media esquelética:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{!! $expediente->getExpedienteEspecialidad()->getLineaMediaEsqueletica()->activa() ? $expediente->getExpedienteEspecialidad()->getLineaMediaEsqueletica()->medidaMordida() : '-' !!}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Alteraciones de tamaño:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{!! $expediente->getExpedienteEspecialidad()->getAlteracionesTamanio()->activa() ? $expediente->getExpedienteEspecialidad()->getAlteracionesTamanio()->medidaMordida() : '-' !!}</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-4">Alteraciones de forma:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{!! $expediente->getExpedienteEspecialidad()->getAlteracionesForma()->activa() ? $expediente->getExpedienteEspecialidad()->getAlteracionesForma()->medidaMordida() : '-' !!}</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-4">Alteraciones de número:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{!! $expediente->getExpedienteEspecialidad()->getAlteracionesNumero()->activa() ? $expediente->getExpedienteEspecialidad()->getAlteracionesNumero()->medidaMordida() : '-' !!}</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-4">Alteraciones de estructura:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{!! $expediente->getExpedienteEspecialidad()->getAlteracionesEstructura()->activa() ? $expediente->getExpedienteEspecialidad()->getAlteracionesEstructura()->medidaMordida() : '-' !!}</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-4">Alteraciones de textura:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{!! $expediente->getExpedienteEspecialidad()->getAlteracionesTextura()->activa()  ? $expediente->getExpedienteEspecialidad()->getAlteracionesTextura()->medidaMordida() : '-' !!}</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-4">Alteraciones de color:</label>
                                    <div class="col-md-6">
                                        <p class="form-control-static">{!! $expediente->getExpedienteEspecialidad()->getAlteracionesColor()->activa() ? $expediente->getExpedienteEspecialidad()->getAlteracionesColor()->medidaMordida() : '-' !!}</p>
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