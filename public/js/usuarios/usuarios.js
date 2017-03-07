$(function() {
	// espacios para variables
    var $listaUsuarios          = $('#listaUsuarios'),
        $existenUsuarios        = $('#existenUsuarios'),
        $formCambiarContrasenia = $('#formCambiarContrasenia');

    init();
    $formCambiarContrasenia.validate();
    agregaValidacionesElementos($formCambiarContrasenia);

	if ($existenUsuarios.val() === '1') {
		// eliminar usuario
		$('#usuarios').on('click', 'button.eliminar', function () {
			var usuarioId = $(this).data('id');
            bootbox.confirm('¿Realmente desea eliminar a este usuario?', function (eleccion) {
                if (eleccion) {
                    $.ajax({
                        url:      '/usuarios/eliminar',
                        type:     'POST',
                        data: 	  {
                            usuarioId: usuarioId
						},
                        dataType: 'json',
                        beforeSend: function () {
                        	$('#modalLoading').modal('show');
                        }

                    }).done(function(resultado) {
                        $('#modalLoading').modal('hide');

                        if (resultado.respuesta === 'fail') {
                            bootbox.alert('Ocurrió un error al eliminar al usuario. Intente de nuevo.');
                            return false;
                        }

                        bootbox.alert('Usuario eliminado con éxito.', function() {
                            window.location.href = '/usuarios';
                        });

                    }).fail(function (jqHXR, textStatus, errorThrown) {
                        $('#modalLoading').modal('hide');

                        console.log(textStatus + ': ' + errorThrown);
                        bootbox.alert('Ocurrió un error al eliminar al usuario. Intente de nuevo.');
                    });
                }
            });
        });

        // activar usuario
        $('#usuarios').on('click', 'button.activar', function () {
            var usuarioId = $(this).data('id');
            bootbox.confirm('¿Realmente desea activar a este usuario?', function (eleccion) {
                if (eleccion) {
                    $.ajax({
                        url:      '/usuarios/activar',
                        type:     'POST',
                        data: 	  {
                            usuarioId: usuarioId
                        },
                        dataType: 'json',
                        beforeSend: function () {
                            $('#modalLoading').modal('show');
                        }

                    }).done(function(resultado) {
                        $('#modalLoading').modal('hide');

                        if (resultado.respuesta === 'fail') {
                            bootbox.alert('Ocurrió un error al activar al usuario. Intente de nuevo.');
                            return false;
                        }

                        bootbox.alert('Usuario activado con éxito.', function() {
                            window.location.href = '/usuarios';
                        });

                    }).fail(function (jqHXR, textStatus, errorThrown) {
                        $('#modalLoading').modal('hide');

                        console.log(textStatus + ': ' + errorThrown);
                        bootbox.alert('Ocurrió un error al activar al usuario. Intente de nuevo.');
                    });
                }
            });
        });

        // cambiar contraseña
        $('#usuarios').on('click', 'button.cambiarContrasenia', function() {
            $('#usuarioId').val($(this).data('id'));
            $('#modalCambiarContrasenia').modal('show');
        });
	}

    $('#cambiarContrasenia').on('click', function(event) {
        if ($formCambiarContrasenia.valid()) {
            $.ajax({
                url: $formCambiarContrasenia.attr('action'),
                type: 'POST',
                dataType: 'json',
                data: $formCambiarContrasenia.serialize(),
                beforeSend: function () {
                    $('#modalLoading').modal('show');
                }
            }).done(function(resultado) {
                $('#modalLoading').modal('hide');

                if (resultado.respuesta === 'fail') {
                    bootbox.alert('Ocurrió un cambiar la contraseña del usuario. Intente de nuevo.');
                    return false;
                }

                bootbox.alert('Contraseña cambiada con éxito. La siguiente vez que el usuario inicie sesión, deberá ingresar la nueva contraseña.', function () {
                    $('#usuarioId').val('');
                    $('#contrasenia').val('');
                    $('#modalCambiarContrasenia').modal('hide');
                });

            }).fail(function (jqHXR, textStatus, errorThrown) {
                $('#modalLoading').modal('hide');

                console.log(textStatus + ': ' + errorThrown);
                bootbox.alert('Ocurrió un cambiar la contraseña del usuario. Intente de nuevo.');
            });
        }
    });
});