<div class="tab-pane active" id="fotografia">
    <div class="innerAll">
        <div class="row">
            <div class="col-md-4 col-lg-3 col-xs-5">
                <div class="box-generic">
                    <h4>Acciones</h4>
                    <a href="{{ url('expedientes/foto/camara/'.base64_encode($paciente->getId()).'/'.base64_encode($medico->getUsername())) }}" id="btnAbrirCamara" class="btn btn-success btn-block"><i class="fa fa-camera"></i> Abrir cámara</a>
                    <div class="separator"></div>
                    <a href="javascript:;" id="subirFoto" class="btn btn-success btn-block"><i class="fa fa-folder"></i> Buscar una foto en los archivos</a>
                </div>
            </div>

            <div class="col-md-8 col-lg-9 col-xs-7">
                <div class="box-generic">
                    <h4>Area de edición</h4>
                    <div class="dvFoto">
                        <input type="hidden" id="urlFotoRecortada" value="{{ url('expedientes/recortar/foto') }}">
                        <span id="fotografiaAgregada">
                            @include('expedientes.paciente_foto')
                        </span>
                        <div class="separator"></div>
                        {!!
                            Form::open([
                                'url'     => 'expedientes/subir/foto',
                                'id'      => 'formSubirImagen'
                            ])
                        !!}
                            <input type="file" name="fotoAdjuntada" id="adjuntarFoto" style="display:none;" class="imagenJpg" />
                            {!! Form::hidden('idPaciente', base64_encode($paciente->getId()), ['id' => 'idPaciente']) !!}
                            {!! Form::hidden('userMedico', base64_encode($medico->getUsername()), ['id' => 'userMedico']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>