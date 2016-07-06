@if(isset($paciente) && $paciente->tieneFoto())
	<img src="{{ url($paciente->getFotografia()->getRuta()) }}?{{ rand() }}" id="fotoCapturada" class="text-center" />
	<input type="hidden" name="x" id="x" value="" />
	<input type="hidden" name="y" id="y" value="" />
	<input type="hidden" name="w" id="w" value="{{ $paciente->getFotografia()->getAncho() }}" />
	<input type="hidden" name="h" id="h" value="{{ $paciente->getFotografia()->getAlto() }}" />
	<input type="hidden" id="imagenRecortada" value="{{ $paciente->getFotografia()->recortada() }}" />
	<input type="hidden" name="urlFoto" id="urlFoto" value="{{ $paciente->getFotografia()->getRuta() }}">
	<div class="separator"></div>
	<a href="javascript:;" id="btnRecortarImagen" class="btn btn-info recortar"><i class="fa fa-scissors"></i> Recortar Imagen</a>
	<a href="javascript:;" id="btnAceptarRecorte" class="btn btn-info aceptarRecorte" style="display:none"><i class="fa fa-check-square"></i> Aceptar</a>
	<a href="javascript:;" id="btnCancelarRecorte" class="btn btn-info cancelarRecorte" style="display:none"><i class="fa fa-times"></i> Cancelar recorte</a>
@else
	<img src="{{ asset('public/img/avatar5.png') }}" id="fotoCapturada" class="text-center" />
	<input type="hidden" name="x" id="x" value="" />
	<input type="hidden" name="y" id="y" value="" />
	<input type="hidden" name="w" id="w" value="" />
	<input type="hidden" name="h" id="h" value="" />
	<input type="hidden" id="imagenRecortada" value="0" />
	<div class="separator"></div>
	<a href="javascript:;" id="btnRecortarImagen" class="btn btn-info recortar" style="display:none"><i class="fa fa-scissors"></i> Recortar Imagen</a>
	<a href="javascript:;" id="btnAceptarRecorte" class="btn btn-info aceptarRecorte" style="display:none"><i class="fa fa-check-square"></i> Aceptar</a>
	<a href="javascript:;" id="btnCancelarRecorte" class="btn btn-info cancelarRecorte" style="display:none"><i class="fa fa-times"></i> Cancelar recorte</a>
@endif