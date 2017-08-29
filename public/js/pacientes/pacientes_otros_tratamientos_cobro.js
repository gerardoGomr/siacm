$(document).ready(function() {

    'use strict';

    var saldo,
        abono,
        tratamientoOdontologiaId,
        expedienteId,
        $formCobroOtroTratamiento = $('#formCobroOtroTratamiento');

    // pagar otro tratamiento
    $('#dvDetalles').on('click', 'button.pagoOtroTratamiento', function(event) {
        // inicializar campos
        $('#abono').val('');
        $('#pagoOtroTratamiento').val('');
        $('#cambioOtroTratamiento').val('');

        $('input.formaPagoOtroTratamiento').attr('checked', false);

        let $parent = $(this).parent('div');

        saldo                    = $(this).data('saldo');
        abono                    = $(this).data('abono');
        tratamientoOdontologiaId = $(this).data('id');
        expedienteId             = $parent.siblings('input.expedienteId').val();

        $formCobroOtroTratamiento.validate();
        agregaValidacionesElementos($formCobroOtroTratamiento);

        $('#saldo').text('$' + saldo);
        $('#otroTratamientoIdCobro').val(tratamientoOdontologiaId);
        $('#dvCobroOtroTratamiento').modal('show');
        $('#expIdCobro').val(expedienteId);
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
                            window.open('/pacientes/otrosTratamientos/recibo/' + respuesta.id);

                            var totalResultados = $('#totalResultados').val(),
                                expedienteId    = null;

                            if (totalResultados === '1') {
                                expedienteId = $('#resultadoPacientes').find('li.paciente')
                                    .first()
                                    .data('id');
                            } else {
                                expedienteId = $('#resultadoPacientes').find('li.active').data('id');
                            }

                            var datos = {
                                medicoId:     $('#medicoId').val(),
                                expedienteId: expedienteId
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
});