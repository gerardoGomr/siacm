'use strict';

$(document).ready(function($) {
    // confirmar cita
    $('#citaDetalle').on('click', 'button.confirmar', function(event) {
        var accion = $(this).data('accion'),
            citaId = $('#citaDetalle').find('#citaId').val();

        bootbox.confirm('Se actualizará la cita a confirmada, ¿desea continuar?', function(eleccion) {
            if(eleccion) {
                // actualizar
                actualizarCitas(citaId, accion);
            }
        });
    });

    // cancelar cita
    $('#citaDetalle').on('click', 'button.cancelar', function(event) {
        var accion = $(this).data('accion'),
            citaId = $('#citaDetalle').find('#citaId').val();

        bootbox.confirm('Se cancelará la cita actual, ¿desea continuar?', function(eleccion) {
            if(eleccion) {
                // actualizar
                actualizarCitas(citaId, accion);
            }
        });
    });

    // inasistencia
    $('#citaDetalle').on('click', 'button.inasistencia', function(event) {
        var accion = $(this).data('accion'),
            citaId = $('#citaDetalle').find('#citaId').val();

        bootbox.confirm('Se marcará la cita actual como inasistencia, ¿desea continuar?', function(eleccion) {
            if(eleccion) {
                // actualizar
                actualizarCitas(citaId, accion);
            }
        });
    });

    // registrar llegada
    $('#citaDetalle').on('click', 'button.registrarLlegada', function () {
        var accion = $(this).data('accion'),
            citaId = $('#citaDetalle').find('#citaId').val();

        bootbox.confirm('Se registrará la llegada del paciente, ¿desea continuar?', function(eleccion) {
            if(eleccion) {
                // actualizar
                actualizarCitas(citaId, accion);
            }
        });
    });

    // reprogramar cita
    $('#citaDetalle').on('click', 'button.reprogramar', function(event) {
        var citaId = $('#citaDetalle').find('#citaId').val();

        bootbox.confirm('¿Desea reprogramar la cita actual?', function(event) {
            if(event === true) {
                $.ajax({
                    url:      '/citas/estatus',
                    type:     'POST',
                    dataType: 'json',
                    data:	  { citaId: citaId },
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
     * @param opciones
     * @param accion
     */
    function actualizarCitas(citaId, accion) {
        $.ajax({
            url:      '/citas/estatus',
            type:     'POST',
            dataType: 'json',
            data:	  { citaId: citaId, accion: accion },
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
                bootbox.alert('El estatus de la cita se actualizó exitosamente.', function () {
                    // refetch events on calendar
                    $('#calendario').fullCalendar('refetchEvents');
                });
            }

        }) .fail(function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(textStatus + ': ' + errorThrown);
            $('#modalLoading').modal('hide');
            bootbox.alert('Ocurrió un error actualizando el estatus de la cita. Intente de nuevo');
        });
    }
});