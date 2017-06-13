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
                type:       'POST',
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
                        var datos = {
                                medicoId:      $('#medicoId').val(),
                                expedienteId:  $('#resultadoPacientes').find('li.paciente').first().data('id'),
                                _token:        $formPaciente.find('input[name="_token"]').val()
                            };

                        mostrarExpediente(datos);
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

		var datos = {
                expedienteId: $(this).data('id'),
                medicoId:     $('#medicoId').val(),
                _token:       $formPaciente.find('input[name="_token"]').val()
			};

        mostrarExpediente(datos);

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
        window.open($('#consultas').data('url') + '/' + $(this).data('id'));
    });

    // otros tratamientos
    $('#dvDetalles').on('click', '#generarOtroTratamiento', function () {
        var id = $(this).data('id');

        $('#formOtroTratamiento').attr('action', '/pacientes/tratamiento/otros/agregar');
        $('#ortopedia').attr('checked', false);
        $('#ortodoncia').attr('checked', false);
        $('#dx').val('');
        $('#observaciones').val('');
        $('#tx').val('');
        $('#costo').val('');
        $('#fechaInicio').val('');
        $('#fechaTermino').val('');
        $('#mensualidades').val('');
        $('#expId').val(id);
        $('#otroTratamientoId').val('');
        $('#dvOtroTratamiento').modal('show');
    });

    // editar otro tratamiento
    $('#dvDetalles').on('click', 'button.editar', function () {
        $('#formOtroTratamiento').attr('action', '/pacientes/tratamiento/otros/editar');

        var data = {
            expedienteId:      $(this).siblings('input.expedienteId').val(),
            otroTratamientoId: $(this).siblings('input.otroTratamientoId').val(),
            ortopedia:         $(this).siblings('input.ortopedia').val(),
            ortodoncia:        $(this).siblings('input.ortodoncia').val(),
            dx:                $(this).siblings('input.dx').val(),
            observaciones:     $(this).siblings('input.observaciones').val(),
            tx:                $(this).siblings('input.tx').val(),
            costo:             $(this).siblings('input.costo').val(),
            fechaInicio:       $(this).siblings('input.fechaInicio').val(),
            fechaTermino:      $(this).siblings('input.fechaTermino').val(),
            mensualidades:     $(this).siblings('input.mensualidades').val(),
        };

        if (data.ortopedia === '1') {
            $('#ortopedia').attr('checked', true);
        }

        if (data.ortodoncia === '1') {
            $('#ortodoncia').attr('checked', true);
        }

        $('#dx').val(data.dx);
        $('#observaciones').val(data.observaciones);
        $('#tx').val(data.tx);
        $('#costo').val(data.costo);
        $('#fechaInicio').val(data.fechaInicio);
        $('#fechaTermino').val(data.fechaTermino);
        $('#mensualidades').val(data.mensualidades);
        $('#otroTratamientoId').val(data.otroTratamientoId);
        $('#expId').val(data.expedienteId);

        $('#dvOtroTratamiento').modal('show');
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
                            var datos = {
                                    expedienteId: expedienteId,
                                    medicoId:     $('#medicoId').val(),
                                    _token:       $formPaciente.find('input[name="_token"]').val()
                                };

                            mostrarExpediente(datos);
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
});

/**
 * funcion para mostrar el detall del expediente
 * @param datos
 */
function mostrarExpediente(datos) {
    $.ajax({
        url:        '/pacientes/detalle',
        type:       'POST',
        dataType:   'json',
        data:       datos,
        beforeSend: function () {
            $('#modalLoading').modal('show');
        }

    }).done(function (respuesta) {
        $('#modalLoading').modal('hide');
        $('#dvDetalles').html('');
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
            $('#modalLoading').modal('show');

            if (!$('#' + form).valid()) {
                $('#modalLoading').modal('hide');
                return false;
            }
        },
        success: function(respuesta) {
            $('#modalLoading').modal('hide');

            if(respuesta.estatus === 'fail') {
                var mensaje = respuesta.mensaje !== '' ? respuesta.mensaje : '';

                bootbox.alert('Ocurrió un error al agregar el anexo. Intente de nuevo. ' + mensaje);
                return false;
            }

            if (respuesta.estatus === 'OK') {
                bootbox.alert('Anexo agregado con éxito', function () {
                    var datos = {
                            expedienteId: $('#' + form).find('input[name="expedienteId"]').val(),
                            medicoId:     $('#medicoId').val(),
                            _token:       $formPaciente.find('input[name="_token"]').val()
                        };

                    mostrarExpediente(datos);
                });
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            $('#modalLoading').modal('hide');
            console.log(textStatus + ': ' + errorThrown);
            bootbox.alert('Ocurrió un error al agregar el anexo. Intente de nuevo');
        }
    };

    $('#' + form).ajaxForm(opciones);
}