$(function() {
	// espacios para variables
	var $formUsuario = $('#formUsuario'),
	    $guardarForm = $('#guardarForm');
	
	setTimeout(function () {
		$('#clave').focus();
	}, 500);

	// inicializar form
	init();

	// validación básica
	$formUsuario.validate();

	// validar formulario
	agregaValidacionesElementos($formUsuario);

	// guardar form
	$guardarForm.on('click', function () {
		if ($formUsuario.valid()) {
			$.ajax({
				type:     'post',
				url:      $formUsuario.attr('action'),
				data: 	  $formUsuario.serialize(),
				dataType: 'json'
			})
			.done(function(resultado) {
				if (resultado.respuesta === 'fail') {
					bootbox.alert('Ocurrió un error al generar al usuario. Intente de nuevo.');
					return false;
				}

				bootbox.alert('Usuario generado con éxito.', function() {
					window.location.href = '';
				});
			})
			.fail(function (xQr, textStatus, errorThrown) {
				console.log(textStatus + ': ' + errorThrown);
				bootbox.alert('Imposible realizar la operación solicitada.');
			});
		}
	});
});