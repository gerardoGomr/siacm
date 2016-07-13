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

    // registrar llegada a consultorio
    //$dvOpciones.on('click', 'a.registrarLlegada', function(event) {
    //    // evaluar si es nuevo paciente o subsecuente
    //    if($('#nuevoPaciente').val() === '1') {
    //        bootbox.alert('Debe registrar algunos datos del paciente para generar el expediente correspondiente', function() {
    //            var especialidad = '';
    //            // 2 = odontopediatria
    //            if($especialidad.val() === '3') {
    //                especialidad = '/odont/';
    //            }
    //            // 3 = otorrinolaringología
    //            if($especialidad.val() === '4') {
    //                especialidad = '/otorr/';
    //            }
    //
    //            //window.location.href = $('#urlExpediente').val() + especialidad + $('#idPaciente').val() + '/' + $('#userMedico').val();
    //            window.open($('#urlExpediente').val() + especialidad + $('#idPaciente').val() + '/' + $('#userMedico').val(), '_blank', 'scrollbars=yes')
    //        });
    //    } else {
    //        bootbox.confirm('Se registrará la llegada del paciente al consultorio, ¿Desea continuar?', function(event) {
    //            if(event === true) {
    //                actualizarCitas($urlEstatus.val(), $idCita.val(), 3, _token);
    //            }
    //        });
    //    }
    //});
    //
    //// ver expediente una vez capturado
    //$dvOpciones.on('click', 'a.verExpediente', function(event) {
    //    var especialidad = '';
    //    // 2 = odontopediatria
    //    if($especialidad.val() === '3') {
    //        especialidad = '/odont/';
    //    }
    //    // 3 = otorrinolaringología
    //    if($especialidad.val() === '4') {
    //        especialidad = '/otorr/';
    //    }
    //
    //    // redirigir
    //    //window.location.href = $('#urlVerExpediente').val() + especialidad + $('#idPaciente').val() + '/' + $('#userMedico').val();
    //    window.open($('#urlVerExpediente').val() + especialidad + $('#idPaciente').val() + '/' + $('#userMedico').val(), '_blank', 'scrollbars=yes')
    //});
    //

    // enviar cambio de estatus
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