'use strict';

var saldo,
    abono,
    tratamientoOdontologiaId,
    $formCobroOtroTratamiento = $('#formCobroOtroTratamiento');

// pagar otro tratamiento
$('#dvDetalles').on('click', 'button.pagoOtroTratamiento', function(event) {
    saldo                    = $(this).data('saldo');
    abono                    = $(this).data('abono');
    tratamientoOdontologiaId = $(this).data('id');

    $formCobroOtroTratamiento.validate();
    agregaValidacionesElementos($formCobroOtroTratamiento);

    $('#saldo').text('$' + saldo);
    $('#otroTratamientoIdCobro').val(tratamientoOdontologiaId);
    $('#dvCobroOtroTratamiento').appendTo('body').modal('show');
});

// on keyup de abono
$('#abono').on('keyup', function () {
    var abonoActual = $(this).val();
    $('#pagoOtroTratamiento').rules('add', {
        min: abonoActual,
        messages: {
            min: 'El pago mínimo es ' + abonoActual
        }
    });
});

// forma pago de consulta
$formCobroOtroTratamiento.on('click', 'input.formaPagoOtroTratamiento', function(event) {
    if ($(this).val() === '1') {
        // efectivo
        $('#efectivoOtroTratamiento').removeClass('hide');

        $('#abono').attr('placeholder', 'Abono mínimo:' + abono);
        $('#abono').rules('add', {
            required: true,
            number:   true,
            min:      1,
            messages: {
                required: 'Campo obligatorio',
                number:   'Ingrese solo números',
                min:      'El abono mínimo es de ' + abono
            }
        });

        $('#pagoOtroTratamiento').rules('add', {
            required: true,
            number:   true,
            messages: {
                required: 'Ingrese el monto del pago',
                number:   'Ingrese un número válido'
            }
        });

        $('#cambioOtroTratamiento').rules('add', {
            required: true,
            messages: {
                required: 'Campo obligatorio'
            }
        });
    }

    if ($(this).val() === '2') {
        // tarjeta de crédito
        $('#efectivoOtroTratamiento').addClass('hide');
        $('#pagoOtroTratamiento').rules('remove');
        $('#cambioOtroTratamiento').rules('remove');
    }
});

// ingresar pago y calcular el cambio
$('#pagoOtroTratamiento').on('keyup', function (event) {
    var cambio = Number($(this).val()) - Number($('#abono').val());

    $('#cambioOtroTratamiento').val(Math.round(cambio * 100) / 100);
});

$('#registrarPagoOtroTratamiento').on('click', function () {
    if ($formCobroOtroTratamiento.valid()) {
        $.ajax({
            url:      $formCobroOtroTratamiento.attr('action'),
            type:     'POST',
            dataType: 'json',
            data:     $formCobroOtroTratamiento.serialize(),
            beforeSend: function () {
                $('#modalLoading').modal('show');
            }

        }).done(function (respuesta) {
            $('#modalLoading').modal('hide');

            switch (respuesta.estatus) {
                case 'fail':
                    bootbox.alert('Ocurrió un error al realizar el cobro del tratamiento. Intente de nuevo.');
                    break;

                case 'OK':
                    bootbox.alert('El cobro del tratamiento fue registrado con éxito. Imprima el recibo al paciente.', function () {
                        //window.open();

                        var datos = {
                            medicoId:      $('#medicoId').val(),
                            expedienteId:  $('#resultadoPacientes').find('li.active').data('id')
                        };

                        mostrarExpediente(datos);
                    });

                    $('#dvCobroOtroTratamiento').modal('hide');
                    break;
            }

        }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(textStatus + ': ' + errorThrown);
            $('#modalLoading').modal('hide');
            bootbox.alert('Ocurrió un error al realizar el cobro del tratamiento. Intente de nuevo.');
        });
    }
});

/**
 * funcion para mostrar el detall del expediente
 *
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
        type:       'POST',
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
            $('#modalLoading').modal('hide');
            console.log(textStatus + ': ' + errorThrown);
            bootbox.alert('Ocurrió un error al agregar el anexo. Intente de nuevo');
        }
    };

    $('#' + form).ajaxForm(opciones);
}