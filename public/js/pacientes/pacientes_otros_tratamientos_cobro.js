var saldo,
    abono;
// pagar otro tratamiento
$('#dvDetalles').on('click', 'button.pagoOtroTratamiento', function(event) {
    saldo = $(this).data('saldo');
    abono = $(this).data('abono');

    $('#formCobroOtroTratamiento').validate();
    agregaValidacionesElementos($('#formCobroOtroTratamiento'));

    $('#saldo').text('$' + saldo);

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
$('#formCobroOtroTratamiento').on('click', 'input.formaPagoOtroTratamiento', function(event) {
    if ($(this).val() === '1') {
        // efectivo
        $('#efectivoOtroTratamiento').removeClass('hide');

        $('#abono').attr('placeholder', abono);
        $('#abono').rules('add', {
            required: true,
            number: true,
            min: abono,
            messages: {
                required: 'Campo obligatorio',
                number: 'Ingrese solo números',
                min: 'El abono mínimo es de ' + abono
            }
        });

        $('#pagoOtroTratamiento').rules('add', {
            required: true,
            number: true,
            messages: {
                required: 'Ingrese el monto del pago',
                number: 'Ingrese un número válido'
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
        $('#abono').rules('remove');
        $('#pagoOtroTratamiento').rules('remove');
        $('#cambioOtroTratamiento').rules('remove');
    }
});

// ingresar pago y calcular el cambio
$('#pagoOtroTratamiento').on('keyup', function (event) {
    var cambio = Number($(this).val()) - abono;

    $('#cambioOtroTratamiento').val(Math.round(cambio * 100) / 100);
});
