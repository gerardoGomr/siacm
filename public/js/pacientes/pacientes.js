$(document).ready(function () {
	var $paciente            = $('#paciente'),
		$formPaciente        = $('#formPaciente'),
		$formOtroTratamiento = $('#formOtroTratamiento'),
        costoConsulta        = 0,
		idForm               = '';

	setTimeout(function(){
		$paciente.focus();
	}, 500);

	// prevenir submit normal
	$paciente.on('keypress', function(event) {
		if (event === 13 || event.which === 13) {
			return false;
		}
	});

    init();

    // validaciones a form de cobro
    $('#formCobro').validate();
    agregaValidacionesElementos($('#formCobro'));

	// buscar pacientes
	$paciente.on('keyup', function(event) {
		if (event === 13 || event.which === 13) {
            $.ajax({
                url:        $formPaciente.attr('action'),
                type:       'post',
                dataType:   'json',
                data:       $formPaciente.serialize(),
                beforeSend: function () {
                    $('#modalLoading').modal('show');
                }

            }).done(function (respuesta) {
                $('#modalLoading').modal('hide');

                $('#resultadoPacientes').html(respuesta.html);

                setTimeout(function() {
                    var totalResultados = $('#totalResultados').val();
                    if (totalResultados === '1') {
                        var url   = $('#resultadoPacientes').data('url'),
                            datos = {
                                medicoId:      $('#medicoId').val(),
                                expedienteId:  $('#resultadoPacientes').find('li.paciente').first().data('id'),
                                _token:        $formPaciente.find('input[name="_token"]').val()
                            };

                        mostrarExpediente(url, datos);
                    }
                }, 500);

            }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
                $('#modalLoading').modal('hide');
                console.log(textStatus + ': ' + errorThrown);
                bootbox.alert('Ocurrió un error al buscar a paciente');
            });
		}
	});

	// detalles de un paciente
	$('#resultadoPacientes').on('click', 'li.paciente', function(event) {
        $(this).addClass('active');
        $(this).siblings('li.active').removeClass('active');

		var url   = $('#resultadoPacientes').data('url'),
			datos = {
                expedienteId: $(this).data('id'),
                medicoId:     $('#medicoId').val(),
                _token:       $formPaciente.find('input[name="_token"]').val()
			};

        mostrarExpediente(url, datos);

        // validación básica
        $('#formAnexo').validate();

        // validar formulario
        agregaValidacionesElementos($('#formAnexo'));

        // generar ajax form
        generarAjaxForm('formAnexo');
	});

    // cobrar consulta
    $('#dvDetalles').on('click', 'button.cobrar', function(event) {
        $('#desgloseCosto').html('');
        $('#desgloseCosto').html($(this).siblings('input.desgloseCosto').val());
        $('#totalPagarTexto').text('$' + $(this).data('costo'));
        $('#totalPagar').text($(this).data('costo'));
        $('#expedienteId').val($(this).data('expediente'));
        $('#consultaId').val($(this).data('id'));

        costoConsulta = $(this).data('costo');

        $('#dvCobroConsulta').modal('show');
    });

    // abrir recibo de pago
    $('#dvDetalles').on('click', 'button.imprimirRecibo', function(event) {
        window.open($('#consultas').data('url') + '/' + $(this).data('id') + '/' + $(this).data('expediente'));
    });

    // otros tratamientos
    $('#dvDetalles').on('click', '#generarOtroTratamiento', function () {
         $('#dvOtroTratamiento').appendTo('body').modal('show');
    });

    // forma pago de consulta
    $('#dvCobroConsulta').on('click', 'input.formaPago', function(event) {
        if ($(this).val() === '1') {
            // efectivo
            $('#efectivo').removeClass('hide');
            $('#pago').rules('add', {
                required: true,
                number: true,
                min: costoConsulta,
                messages: {
                    required: 'Ingrese el monto del pago',
                    number: 'Ingrese un número válido',
                    min: 'El monto mínimo es ' + costoConsulta
                }
            });

            $('#cambio').rules('add', {
                required: true
            });
        }

        if ($(this).val() === '2') {
            // tarjeta de crédito
            $('#efectivo').addClass('hide');

            $('#pago').rules('remove');
            $('#cambio').rules('remove');
        }

    });

    // ingresar pago y calcular el cambio
    $('#pago').on('keyup', function (event) {
        var cambio = Number($(this).val()) - costoConsulta;

        $('#cambio').val(cambio);
    });

    // cobrar consulta
    $('#cobrarConsulta').on('click', function (event) {
        if ($('#formCobro').valid()) {
            // guardar mediante ajax
            $.ajax({
                url:        $('#formCobro').attr('action'),
                type:       'post',
                dataType:   'json',
                data:       $('#formCobro').serialize(),
                beforeSend: function () {
                    $('#modalLoading').modal('show');
                }

            }).done(function (respuesta) {
                $('#modalLoading').modal('hide');

                if (respuesta.estatus === 'fail') {
                    var mensajeError = respuesta.mensaje !== '' ? respuesta.mensaje : '';
                    bootbox.alert('Ocurrió un error al cobrar la consulta. Intente de nuevo.' + mensajeError);
                }

                if (respuesta.estatus === 'OK') {
                    bootbox.alert('Consulta cobrada con éxito. Imprima el recibo de pago.', function () {

                        var url   = $('#resultadoPacientes').data('url'),
                            datos = {
                                expedienteId: $('#expedienteId').val(),
                                medicoId:     $('#medicoId').val(),
                                _token:       $formPaciente.find('input[name="_token"]').val()
                            };

                        mostrarExpediente(url, datos);

                        // abrir recibo de pago
                        window.open($('#consultas').data('url') + '/' + $('#consultaId').val() + '/' + datos.expedienteId);

                        $('#dvCobroConsulta').modal('hide');
                    });
                }

            }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
                $('#modalLoading').modal('hide');
                console.log(textStatus + ': ' + errorThrown);
                bootbox.alert('Ocurrió un error al cobrar la consulta. Intente de nuevo');
            });
        }
    });

	// borrar anexos
	$('#dvDetalles').on('click', 'button.eliminarAnexo', function(event){
        var url   = $(this).data('url'),
            anexo = $(this).data('id');

        bootbox.confirm('¿Desea eliminar el anexo seleccionado?', function (respuesta) {
            if (respuesta) {
                var formId       = $('#dvDetalles').find('form').attr('id'),
                    expedienteId = $('#' + formId).find('input[name="expedienteId"]').val(),
                    datos        = {
                        expedienteId: expedienteId,
                        anexo:        anexo,
                        _token:       $formPaciente.find('input[name="_token"]').val()
                    };

                $.ajax({
                    url:        url,
                    type:       'post',
                    dataType:   'json',
                    data:       datos,
                    beforeSend: function () {
                        $('#modalLoading').modal('show');
                    }
                }).done(function (respuesta) {
                    $('#modalLoading').modal('hide');

                    if (respuesta.estatus === 'fail') {
                        var mensajeError = respuesta.mensaje !== '' ? respuesta.mensaje : '';
                        bootbox.alert('Ocurrió un error al eliminar el anexo seleccionado. Intente de nuevo.' + mensajeError);
                    }

                    if (respuesta.estatus === 'OK') {
                        bootbox.alert('Anexo eliminado con éxito.', function () {
                            var url   = $('#resultadoPacientes').data('url'),
                                datos = {
                                    expedienteId: expedienteId,
                                    medicoId:     $('#medicoId').val(),
                                    _token:       $formPaciente.find('input[name="_token"]').val()
                                };

                            mostrarExpediente(url, datos);
                        });
                    }

                }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log(textStatus + ': ' + errorThrown);
                    $('#modalLoading').modal('hide');
                    bootbox.alert('Ocurrió un error al eliminar el anexo seleccionado. Intente de nuevo.');

                });
            }
        });
	});

	// inicializar form validación
	init();

	// validación vacía
	$formOtroTratamiento.validate();

	// validar formulario de otros tratamientos
	agregaValidacionesElementos($formOtroTratamiento);

	// guardar formulario otros tratamientos
	$('#guardarFormOtros').on('click', function(event) {
		if ($formOtroTratamiento.valid() === true) {
			if (!$formOtroTratamiento.find('input[name="ortodoncia"]').is(':checked') && !$formOtroTratamiento.find('input[name="ortopedia"]').is(':checked')) {
				bootbox.alert('Por favor, seleccione al menos un tipo de tratamiento');
				return false;
			}

			// guardar
			var respuesta = ajax($formOtroTratamiento.attr('action'), 'post', 'html', $formOtroTratamiento.serialize(), 'guardar');
			respuesta.done(function(respuesta){
				if(respuesta === '0') {
					bootbox.alert('Ocurrió un error al generar el tratamiento. Intente de nuevo');
					return false;
				}

				var idForm     = $('#dvDetalles').find('form').attr('id'),
					idPaciente = $('#' + idForm).find('input[name="idPaciente"]').val();

				bootbox.alert('Tratamiento generado con éxito', function () {
					// refrescar detalles del paciente seleccionado
					recargarDetalles(idPaciente);
				});
			})
			.fail(function(XMLHttpRequest, textStatus, errorThrown){
				console.log(textStatus + ': ' + errorThrown);
			});
		}
	});

	/**
	 * funcion para generar un formulario ajax
	 * @param form
     */
	function generarAjaxForm(form) {
		var opciones = {
			url:        $('#' + form).attr('action'),
			type:       'post',
			dataType:   'json',
			beforeSend: function() {
				if (!$('#' + form).valid()) {
					return false;
				}
			},
			success: function(respuesta) {
				if(respuesta.estatus === 'fail') {
					var mensaje = respuesta.mensaje !== '' ? respuesta.mensaje : '';

					bootbox.alert('Ocurrió un error al agregar el anexo. Intente de nuevo. ' + mensaje);
					return false;
				}

				if (respuesta.estatus === 'OK') {
					bootbox.alert('Anexo agregado con éxito', function () {
						var url   = $('#resultadoPacientes').data('url'),
						    datos = {
						        expedienteId: $('#' + form).find('input[name="expedienteId"]').val(),
						        medicoId:     $('#medicoId').val(),
						        _token:       $formPaciente.find('input[name="_token"]').val()
						    };

						mostrarExpediente(url, datos);
					});
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				console.log(textStatus + ': ' + errorThrown);
				bootbox.alert('Ocurrió un error al agregar el anexo. Intente de nuevo');
			}
		};

		$('#' + form).ajaxForm(opciones);
	}

    /**
     * funcion para mostrar el detall del expediente
     * @param url
     * @param datos
     */
    function mostrarExpediente(url, datos) {
        $.ajax({
            url:        url,
            type:       'post',
            dataType:   'json',
            data:       datos,
            beforeSend: function () {
                $('#modalLoading').modal('show');
            }

        }).done(function (respuesta) {
            $('#modalLoading').modal('hide');

            $('#dvDetalles').html(respuesta.html);

            // validación básica
            $('#formAnexo').validate();

            // validar formulario
            agregaValidacionesElementos($('#formAnexo'));

            // generar ajax form
            generarAjaxForm('formAnexo');

        }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
            $('#modalLoading').modal('hide');
            console.log(textStatus + ': ' + errorThrown);
            bootbox.alert('Ocurrió un error al mostrar los detalles del paciente.');
        });
    }
});