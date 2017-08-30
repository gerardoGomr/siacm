'use strict';

$(document).ready(function() {
    let urlConsultas   = $('#urlConsultas').val(),
        $formConsultas = $('#formConsultas'),
        $formCobro     = $('#formCobro'),
        $abono         = $('#abono'),
        $pago          = $('#pago'),
        $cambio        = $('#cambio'),
        $efectivo      = $('#efectivo'),
        costoConsulta  = 0;

    init();
    $formCobro.validate();
    agregaValidacionesElementos($formCobro);


    // buscar citas al seleccionar una fecha
    $('#fecha').datepicker({
        autoclose: true,
        language:  'es',
        format:    'yyyy-mm-dd'
    }).on('changeDate', function() {
        buscarConsultas();
    });

    // click en lista y cargar contenido derecho
    $('#resultadoConsultas').on('click', 'li.consulta', function() {
        $(this).addClass('active');
        $(this).siblings('li.active').removeClass('active');

        let datos = {
            consultaId:     $(this).data('id'),
            imagen:         $(this).children('input.imagen').val(),
            nombreCompleto: $(this).children('input.nombreCompleto').val(),
            edad:           $(this).children('input.edad').val(),
            fechaConsulta:  $(this).children('input.fechaConsulta').val(),
            costoConsulta:  $(this).children('input.costoConsulta').val(),
            saldo:          $(this).children('input.saldoConsulta').val(),
            pagoMinimo:     $(this).children('input.pagoMinimo').val()
        };

        costoConsulta = datos.saldo;
        rellenarFormCobro(datos);
    });

    // buscar consultas con la fecha
    function buscarConsultas () {
        $.ajax({
            url:        $formConsultas.attr('action'),
            type:       'POST',
            dataType:   'json',
            data:       $formConsultas.serialize(),
            beforeSend: function () {
                $('#modalLoading').modal('show');
            }

        }).done(function(respuesta) {
            $('#modalLoading').modal('hide');

            if (respuesta.estatus === 'fail') {
                bootbox.alert('Ocurrió un error al realizar la búsqueda de consultas. Intente de nuevo');
            }

            if (respuesta.estatus === 'OK') {
                $('#resultadoConsultas').html(respuesta.html);

                setTimeout(function() {
                    let totalResultados = $('#totalResultados').val();
                    if (totalResultados === '1') {
                        let $consulta = $('#resultadoConsultas').find('li.consulta').first(),
                            datos     = {
                                consultaId:     $consulta.data('id'),
                                imagen:         $consulta.children('input.imagen').val(),
                                nombreCompleto: $consulta.children('input.nombreCompleto').val(),
                                edad:           $consulta.children('input.edad').val(),
                                fechaConsulta:  $consulta.children('input.fechaConsulta').val(),
                                costoConsulta:  $consulta.children('input.costoConsulta').val(),
                                saldo:          $consulta.children('input.saldoConsulta').val(),
                                pagoMinimo:     $consulta.children('input.pagoMinimo').val()
                            };

                        costoConsulta = datos.saldo;
                        rellenarFormCobro(datos);
                    }
                }, 500);
            }

        }).fail(function(jqXHR, textStatus, errorThrown) {
            $('#modalLoading').modal('hide');
            console.log(textStatus + ': ' + errorThrown);
            bootbox.alert('Ocurrió un error al realizar la búsqueda de consultas. Intente de nuevo');
        });
    }

    // rellenar el form con los datos
    function rellenarFormCobro (datos) {
        if (datos.imagen !== '') {
            $('#imagen').removeClass('hide');
            $('#fotoCapturada').attr('src', datos.imagen);
        }

        $('#nombreCompleto').text(datos.nombreCompleto);
        $('#anios').text(datos.edad);

        $('#costoConsulta').text('$' + datos.costoConsulta);
        $('#totalPagarTexto').text('$' + datos.saldo);
        $('#totalPagar').text(datos.saldo);
        $('#consultaId').val(datos.consultaId);
        $('#cobros').removeClass('hide');

        $abono.rules('add', {
            number:   true,
            max:      datos.saldo,
            messages: {
                number: 'Ingrese solo números',
                max:    'El máximo a abonar es de $' + datos.saldo
            }
        })
    }

    // forma pago de consulta
    $formCobro.on('click', 'input.formaPago', function(event) {
        if ($(this).val() === '1') {
            // efectivo
            $efectivo.removeClass('hide');
            $pago.rules('add', {
                required: true,
                number:   true,
                messages: {
                    required: 'Ingrese el monto del pago',
                    number:   'Ingrese un número válido'
                }
            });

            $cambio.rules('add', {
                required: true
            });
        }

        if ($(this).val() === '2') {
            // tarjeta de crédito
            $efectivo.addClass('hide');

            $pago.rules('remove');
            $cambio.rules('remove');
        }
    });

    // validar minimo pago
    $abono.on('keyup', function () {
        $pago.rules('add', {
            min:      $abono.val(),
            messages: {
                min: 'La cantidad mínima a pagar es $' + $abono.val()
            }
        })
    })

    // ingresar pago y calcular el cambio
    $pago.on('keyup', function (event) {
        let cambio = Number($(this).val()) - $abono.val();

        $cambio.val(cambio);
    });

    // cobrar consulta
    $('#cobrarConsulta').on('click', function (event) {
        if ($formCobro.valid()) {
            // guardar mediante ajax
            $.ajax({
                url:        $formCobro.attr('action'),
                type:       'POST',
                dataType:   'json',
                data:       $formCobro.serialize(),
                beforeSend: function () {
                    $('#modalLoading').modal('show');
                }

            }).done(function (respuesta) {
                $('#modalLoading').modal('hide');

                if (respuesta.estatus === 'fail') {
                    let mensajeError = respuesta.mensaje !== '' ? respuesta.mensaje : '';
                    bootbox.alert('Ocurrió un error al cobrar la consulta. Intente de nuevo.' + mensajeError);
                }

                if (respuesta.estatus === 'OK') {
                    bootbox.alert('Consulta cobrada con éxito. Imprima el recibo de pago.', function () {
                        // abrir recibo de pago
                        window.open('/pacientes/consulta/recibo/' + respuesta.cobroConsultaId);
                    });

                    setTimeout(function () {
                        $('#cobros').addClass('hide');
                        // rebuscar consultas
                        buscarConsultas();
                        $efectivo.addClass('hide');

                        $abono.val('');
                        $efectivo.find('input[type="text"]').each(function () {
                            $(this).val('');
                        });
                    }, 1000);
                }

            }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
                $('#modalLoading').modal('hide');
                console.log(textStatus + ': ' + errorThrown);
                bootbox.alert('Ocurrió un error al cobrar la consulta. Intente de nuevo');
            });
        }
    });
});