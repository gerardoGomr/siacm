<div class="tab-pane active" id="fotografia">
    <div class="innerAll">
        <div class="row">
            <div class="col-md-5 col-lg-4">
                <div class="box-generic">
                    <h4>Acciones</h4>
                    <button type="button" id="btnAbrirCamara" class="btn btn-success btn-block"><i class="fa fa-camera"></i> Abrir cámara</button>
                    <div class="separator"></div>
                    <button type="button" id="subirFoto" class="btn btn-success btn-block"><i class="fa fa-folder"></i> Buscar una foto en los archivos</button>
                </div>
            </div>

            <div class="col-md-7 col-lg-8">
                <div class="box-generic">
                    <h4>Area de edición</h4>
                    <div class="dvFoto">
                        <input type="hidden" id="urlFotoRecortada" value="{{ url('expedientes/foto/recortar') }}">
                        <span id="fotografiaAgregada">
                            @if(isset($expediente) && $expediente->tieneFoto())
                                @include('expedientes.paciente_foto')
                            @else
                                @include('expedientes.paciente_foto_temporal')
                            @endif
                        </span>
                        <div class="separator"></div>
                        {!!
                            Form::open([
                                'url'     => 'expedientes/foto/anexar',
                                'id'      => 'formSubirImagen'
                            ])
                        !!}
                            <input type="file" name="fotoAdjuntada" id="adjuntarFoto" style="display:none;" class="imagenJpg" />
                            <input type="hidden" name="pacienteId" value="{{ base64_encode($paciente->getId()) }}">
                            <input type="hidden" name="medicoId" value="{{ base64_encode($medico->getId()) }}">
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCapturarFoto">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal heading -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h2 class="modal-title">Capturar foto</h2>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div id="camara" style="width: 300px; height: 200px;"></div>
                        </div>

                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary" id="capturar"><i class="fa fa-camera"></i> Capturar</button>
                            <br><br>
                            <button type="button" class="btn btn-default" id="cancelar" style="display: none;"><i class="fa fa-times"></i> Capturar otra</button>
                            <br><br>
                            <button type="button" class="btn btn-success" id="guardar" style="display: none;"><i class="fa fa-save"></i> Guardar captura</button>
                            <br><br>
                            <button type="button" class="btn btn-warning" id="terminar"><i class="fa fa-arrow-left"></i> Cancelar captura</button>
                            <input type="hidden" id="urlCaptura" value="{{ url('expedientes/foto/guardar') }}">
                            <input type="hidden" id="_token" value="{{ csrf_token() }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
