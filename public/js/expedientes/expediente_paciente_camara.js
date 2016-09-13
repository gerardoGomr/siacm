$(document).ready(function() {
	// variables
	var $capturar = $('#capturar'),
		$cancelar = $('#cancelar'),
		$guardar  = $('#guardar');

	// capturar foto
	$capturar.on('click', function(event) {
		Webcam.freeze();
		$(this).hide();
		$cancelar.show();
		$guardar.show();
	});

	// cancelar y capturar otra
	$cancelar.on('click', function(event) {
		Webcam.unfreeze();
		$(this).hide();
		$guardar.hide();
		$capturar.show();
	});

	// cancelar captura de foto
	$('#terminar').on('click', function () {
		$guardar.hide();
		$capturar.show();
		$cancelar.hide();
		Webcam.reset();
		$('#modalCapturarFoto').modal('hide');
	});

	// guardar
	$guardar.on('click', function(){
		Webcam.snap( function(data_uri) {
			// snap complete, image data is in 'data_uri'
			Webcam.upload( data_uri, $('#urlCaptura').val(), function(code, text) {
				$('#fotografiaAgregada').html(text);
				$('#capturada').val('1');
				$('#foto').val($('#urlFoto').val());
				$('#modalCapturarFoto').modal('hide');

				$guardar.hide();
				$capturar.show();
				$cancelar.hide();
				Webcam.reset();
			});
		});
	});
});