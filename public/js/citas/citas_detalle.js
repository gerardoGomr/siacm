$(function() {
	var $dvOpciones   = $('#dvOpciones'),
        $urlEstatus   = $('#urlEstatus'),
        $idCita       = $('#idCita'),
        $idConfirmar  = $('#idConfirmar'),
        $idCancelar   = $('#idCancelar'),
        $especialidad = $('#especialidad'),
        _token        = $('#_token').val();

    // confirmar cita
    $dvOpciones.on('click', 'a.confirmar', function(event) {
        bootbox.confirm('Se actualizará la cita a confirmada, ¿desea continuar?', function(eleccion) {
            if(eleccion === true) {
                // actualizar
                actualizarCitas($urlEstatus.val(), $idCita.val(), $idConfirmar.val(), _token);
            }
        });
    });

    // cancelar cita
    $dvOpciones.on('click', 'a.cancelar', function(event) {
        bootbox.confirm('Se cancelara la cita actual, ¿desea continuar?', function(eleccion) {
            if(eleccion === true) {
                // actualizar
                actualizarCitas($urlEstatus.val(), $idCita.val(), $idCancelar.val(), _token);
            }
        });
    });

    // registrar llegada a consultorio
    $dvOpciones.on('click', 'a.registrarLlegada', function(event) {
        // evaluar si es nuevo paciente o subsecuente
        if($('#nuevoPaciente').val() === '1') {
            bootbox.alert('Debe registrar algunos datos del paciente para generar el expediente correspondiente', function() {
                var especialidad = '';
                // 2 = odontopediatria
                if($especialidad.val() === '3') {
                    especialidad = '/odont/';
                }
                // 3 = otorrinolaringología
                if($especialidad.val() === '4') {
                    especialidad = '/otorr/';
                }

                //window.location.href = $('#urlExpediente').val() + especialidad + $('#idPaciente').val() + '/' + $('#userMedico').val();
                window.open($('#urlExpediente').val() + especialidad + $('#idPaciente').val() + '/' + $('#userMedico').val(), '_blank', 'scrollbars=yes')
            });
        } else {
            bootbox.confirm('Se registrará la llegada del paciente al consultorio, ¿Desea continuar?', function(event) {
                if(event === true) {
                    actualizarCitas($urlEstatus.val(), $idCita.val(), 3, _token);
                }
            });
        }
    });

    // ver expediente una vez capturado
    $dvOpciones.on('click', 'a.verExpediente', function(event) {
        var especialidad = '';
        // 2 = odontopediatria
        if($especialidad.val() === '3') {
            especialidad = '/odont/';
        }
        // 3 = otorrinolaringología
        if($especialidad.val() === '4') {
            especialidad = '/otorr/';
        }

        // redirigir
        //window.location.href = $('#urlVerExpediente').val() + especialidad + $('#idPaciente').val() + '/' + $('#userMedico').val();
        window.open($('#urlVerExpediente').val() + especialidad + $('#idPaciente').val() + '/' + $('#userMedico').val(), '_blank', 'scrollbars=yes')
    });

    // reprogramar cita
    $dvOpciones.on('click', 'a.reprogramar', function(event) {
        bootbox.confirm('¿Desea reprogramar la cita actual?', function(event) {
			if(event === true) {
                var resp = ajax($('#urlReprogramar').val(), 'post', 'json', {idCita: $idCita.val(), _token:_token}, 'guardar', '', '');
				resp.done(function(resultado) {
			       console.log(resultado.respuesta);

			        if(resultado.respuesta !== 1) {
						bootbox.alert('Ocurrió un error. Intente de nuevo');
		            	return false;
			        }

			        window.opener.$('#reprogramar').val('1');

			        bootbox.alert('Por favor, elija la nueva fecha para reprogramar la cita.', function() {
			            window.close();
			        });
			    })
			    .fail(function(XMLHttpRequest, textStatus, errorThrown) {
			       console.log(errorThrown);
			        bootbox.alert('Error al realizar la operación solicitada');
			    });
			}
        });
    });
});

// enviar cambio de estatus
function actualizarCitas(url, idCita, idEstatus, _token)
{
    var resp = ajax(url, 'post', 'json', {idCita: idCita, idEstatus: idEstatus, _token:_token}, 'guardar', '', '');

    resp.done(function(resultado) {
        console.log(resultado.respuesta);
        console.log(atob(resultado.html));

        if(resultado.respuesta !== 1) {
            bootbox.alert('Ocurrió un error al actualizar el estatus. Intente de nuevo');
            return false;
        }

         // se actualizo estatus
        bootbox.alert('Cita actualizada con éxito', function() {
            // actualizar pantalla
            window.location.reload(true);
        });
    })
    .fail(function(XMLHttpRequest, textStatus, errorThrown) {
        console.log(errorThrown);
        bootbox.alert('Error al realizar la operación solicitada');
    });
}