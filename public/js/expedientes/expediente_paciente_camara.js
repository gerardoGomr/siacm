$(function() {
	// variables
	var $capturar = $('#capturar'),
		$cancelar = $('#cancelar'),
		$guardar  = $('#guardar');

	// inicializar la cámara
	Webcam.set({
		image_format: 'jpeg',
		jpeg_quality: 90,
		fps: 45
	});

	// attach
	Webcam.attach('#camara');

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

	// guardar
	$guardar.on('click', function(event){
		Webcam.snap( function(data_uri) {
			// snap complete, image data is in 'data_uri'
			Webcam.upload( data_uri, $('#urlCaptura').val(), function(code, text) {
				window.opener.$('#fotografiaAgregada').html(text);
				window.opener.$('#capturada').val('1');
				window.opener.$('#foto').val(window.opener.$('#urlFoto').val())
				window.close();
			});
		});
	});
});