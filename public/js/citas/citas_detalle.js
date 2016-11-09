$(document).ready(function($) {
	// confirmar cita
    $('#citaDetalle').on('click', 'button.confirmar', function(event) {
        var accion = $(this).data('accion'),
            url    = $('#citaDetalle').find('#urlEstatus').val(),
            citaId = $('#citaDetalle').find('#citaId').val(),
            _token = $('#citaDetalle').find('#_token').val();

        bootbox.confirm('Se actualizará la cita a confirmada, ¿desea continuar?', function(eleccion) {
            if(eleccion) {
                // actualizar
                actualizarCitas(url, citaId, _token, accion);
            }
        });
    });

    // cancelar cita
    $('#citaDetalle').on('click', 'button.cancelar', function(event) {
        var accion = $(this).data('accion'),
            url    = $('#citaDetalle').find('#urlEstatus').val(),
            citaId = $('#citaDetalle').find('#citaId').val(),
            _token = $('#citaDetalle').find('#_token').val();

        bootbox.confirm('Se cancelará la cita actual, ¿desea continuar?', function(eleccion) {
            if(eleccion) {
                // actualizar
                actualizarCitas(url, citaId, _token, accion);
            }
        });
    });

    // registrar llegada
    $('#citaDetalle').on('click', 'button.registrarLlegada', function () {
        var accion = $(this).data('accion'),
            url    = $('#citaDetalle').find('#urlEstatus').val(),
            citaId = $('#citaDetalle').find('#citaId').val(),
            _token = $('#citaDetalle').find('#_token').val();

        bootbox.confirm('Se registrará la llegada del paciente, ¿desea continuar?', function(eleccion) {
            if(eleccion) {
                // actualizar
                actualizarCitas(url, citaId, _token, accion);
            }
        });
    });

    // reprogramar cita
    $('#citaDetalle').on('click', 'button.reprogramar', function(event) {
        var url    = $('#citaDetalle').find('#urlReprogramar').val(),
            citaId = $('#citaDetalle').find('#citaId').val(),
            _token = $('#citaDetalle').find('#_token').val();

        bootbox.confirm('¿Desea reprogramar la cita actual?', function(event) {
            if(event === true) {
                $.ajax({
                    url:      url,
                    type:     'post',
                    dataType: 'json',
                    data:	  { citaId: citaId, _token:_token },
                    beforeSend: function () {
                        $('#modalLoading').modal('show');
                    }

                }).done(function(resultado) {
                    $('#modalLoading').modal('hide');
                    console.log(resultado.estatus);

                    if(resultado.estatus === 'fail') {
                        console.log(resultado.mensaje);
                        bootbox.alert('Ocurrió un error al activar la opción de reprogramación.');
                    }

                    if (resultado.estatus === 'OK') {
                        bootbox.alert('Por favor, elija la nueva fecha para reprogramar la cita.', function() {
                            $('#reprogramar').val('1');
                            $('#modalDetalleCita').modal('hide');
                        });
                    }

                }) .fail(function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(textStatus + ': ' + errorThrown);
                    $('#modalLoading').modal('hide');
                    bootbox.alert('Ocurrió un error al activar la opción de reprogramación. Intente de nuevo');
                });
            }
        });
    });

    // registrar llegada a consultorio - enviar a la generación de expedientes
    $('#citaDetalle').on('click', 'a.registrarExpediente', function(event) {
        event.preventDefault();
        var url = $(this).attr('href');

        bootbox.alert('Por favor, registre los datos del paciente para generarle un nuevo expediente.', function() {
            window.location.href = url;
        });
    });

    /**
     * actualizar estatus de cita
     * @param url
     * @param citaId
     * @param _token
     * @param accion
     */
    function actualizarCitas(url, citaId, _token, accion) {
        $.ajax({
            url:      url,
            type:     'post',
            dataType: 'json',
            data:	  { citaId: citaId, accion: accion, _token:_token },
            beforeSend: function () {
                $('#modalLoading').modal('show');
            }

        }).done(function(resultado) {
            $('#modalLoading').modal('hide');
            console.log(resultado.estatus);

            if(resultado.estatus === 'fail') {
                console.log(resultado.mensaje);
                bootbox.alert('Ocurrió un error actualizando el estatus de la cita.');
            }

            if (resultado.estatus === 'OK') {
                $('#citaDetalle').html(resultado.html);
                bootbox.alert('El estatus de la cita se actualizó exitosamente.');
            }

        }) .fail(function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(textStatus + ': ' + errorThrown);
            $('#modalLoading').modal('hide');
            bootbox.alert('Ocurrió un error actualizando el estatus de la cita. Intente de nuevo');
        });
    }
});