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
$('#dvDetalles').on('keyup', '#abono', function () {
    var abono = $(this).val();
    $('#pagoOtroTratamiento').rules('add', {
        min: abono,
        messages: {
            min: 'El pago mínimo es ' + abono
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
            type:     'post',
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
                        window.open();
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
