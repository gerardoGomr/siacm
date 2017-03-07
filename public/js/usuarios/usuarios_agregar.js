$(function() {
	// espacios para variables
	var $formUsuario = $('#formUsuario'),
	    $crearUsuario = $('#crearUsuario');
	
	setTimeout(function () {
		$('#clave').focus();
	}, 500);

	// inicializar form
	init();
	$formUsuario.validate();
	agregaValidacionesElementos($formUsuario);

	// guardar form
	$crearUsuario.on('click', function () {
		if ($formUsuario.valid()) {
			$.ajax({
                url:      $formUsuario.attr('action'),
				type:     'POST',
				data: 	  $formUsuario.serialize(),
				dataType: 'json',
				beforeSend: function () {
                	$('#loadingAgregarUsuario').removeClass('hide');
                	$crearUsuario.addClass('hide');
				}

			}).done(function(resultado) {
                $('#loadingAgregarUsuario').addClass('hide');
                $crearUsuario.removeClass('hide');

				if (resultado.respuesta === 'fail') {
					bootbox.alert('Ocurrió un error al generar al usuario. Intente de nuevo.');
					return false;
				}

				bootbox.alert('Usuario generado con éxito.', function() {
					window.location.href = '/usuarios';
				});

			}).fail(function (jqHXR, textStatus, errorThrown) {
                $('#loadingAgregarUsuario').addClass('hide');
                $crearUsuario.removeClass('hide');

				console.log(textStatus + ': ' + errorThrown);
				bootbox.alert('Ocurrió un error al generar al usuario. Intente de nuevo.');
			});
		}
	});
});