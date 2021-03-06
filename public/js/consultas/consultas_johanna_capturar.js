$(function() {
	// variables
	var $formConsulta       		  = $('#formConsulta'),
		$btnGuardarPadecimientoDental = $('#btnGuardarPadecimientoDental'),
		$btnGuardarConsulta 		  = $('#btnGuardarConsulta'),
		$btnGuardarInterconsulta      = $('#btnGuardarInterconsulta'),
		$btnGuardarReceta 			  = $('#btnGuardarReceta'),
		$btnGuardarHigieneDental      = $('#btnGuardarHigieneDental'),
		$btnGuardarIndicacion         = $('#btnGuardarIndicacion'),
		costoTotalConsulta            = 0

	// inicializar form
	init();

	// validación básica
	$formConsulta.validate({
		ignore: []
	});

	// validar formulario
	agregaValidacionesElementos($formConsulta);

	// validar el costo de la consulta
	asignarCostoAConsulta();

	// evento click de los dientes
	$('#dvOdontograma').on('click', 'a.diente', function(event) {
		// setear el valor del diente seleccionado
		$('#diente').val($(this).children('input[name="valor"]').val());
	});

	// remover padecimientos de diente
	$('#dvOdontograma').on('click', 'button.removerPadecimientosDiente', function () {
		let diente = $(this).data('diente');

		$.ajax({
			url:      '/consultas/diente-padecimientos/remover',
			type:     'POST',
			dataType: 'json',
			data:     {diente: diente},
			beforeSend: function() {
				$('#modalLoading').modal('show');
			}
		})
		.done(function(resultado) {
			$('#modalLoading').modal('hide');
			console.log(resultado);

			if(resultado.estatus === 'fail') {
				bootbox.alert('Ocurrió un error al remover los padecimientos del diente seleccionado. Por favor, intente de nuevo');
			}

			if (resultado.estatus === 'OK') {
				bootbox.alert('Padecimientos removidos con éxito.', function () {
					$('#dvOdontograma').html(resultado.html);

					let totalConPadecimientos = Number($('#totalConPadecimientos').val());

					if (totalConPadecimientos === 0) {
						$('#btnGenerarPlan').attr('disabled', true);
					}
				});
			}
		})
		.fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(textStatus + ': ' + errorThrown);
			$('#modalLoading').modal('hide');
			bootbox.alert('Ocurrió un error al remover los padecimientos del diente seleccionado. Por favor, intente de nuevo');
		});
	});

	/**
	 * verificar cuantos padecimientos han sido seleccionados
	 * agregar todos los padecimientos al arreglo
	 */
	$btnGuardarPadecimientoDental.on('click', function(event) {
		event.preventDefault();

		var totalPadecimientos = 0,
		 	padecimientos      = [];

		$('#dvPadecimientosDentales').find('input.padecimiento').each(function() {
			if ($(this).is(':checked')) {
				totalPadecimientos ++;

				padecimientos.push($(this).val());
			}
		});

		if (totalPadecimientos > 2) {
			bootbox.alert('Solamente puede seleccionar hasta dos padecimientos');
			return false;
		} else if(totalPadecimientos === 0) {
			bootbox.alert('Seleccione al menos un padecimiento');
			return false;
		}

		// objeto a enviar
		var datos = {
			_token:        $formConsulta.find('input[name="_token"]').val(),
			diente:        $('#diente').val(),
			padecimientos: padecimientos
		},
			url = $btnGuardarPadecimientoDental.data('url');

		$.ajax({
			url:      url,
			type:     'post',
			dataType: 'json',
			data:     datos,
			beforeSend: function() {
				$('#modalLoading').modal('show');
			}
		})
		.done(function(resultado) {
			$('#modalLoading').modal('hide');
			console.log(resultado);

			if(resultado.estatus === 'fail') {
				bootbox.alert('Ocurrió un error al guardar los padecimientos del diente seleccionado.');
			}

			if (resultado.estatus === 'OK') {
				$('#dvOdontograma').html(resultado.html);

				$('#dvPadecimientosDentales').find('input.padecimiento').each(function() {
					// reiniciar modal
					$(this).attr('checked', false);
				});

				// cerrar modal
				$('#dvPadecimientosDentales').modal('hide');

				// activar boton de plan
				$('#btnGenerarPlan').attr('disabled', false);
			}
		})
		.fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(textStatus + ': ' + errorThrown);
			$('#modalLoading').modal('hide');
			bootbox.alert('Ocurrió un error al guardar los padecimientos del diente seleccionado.');
		});
	});

	// change para mostrar receta
	$('#receta').on('change', function() {
		var receta = atob($('input[name="receta' + $(this).val() + '"]').val());
		$('#cuerpoReceta').val(receta);
	});

	// guardar receta
	$btnGuardarReceta.on('click', function(event) {
		event.preventDefault();

		var datos = {
				_token:   $formConsulta.find('input[name="_token"]').val(),
				recetaId: $('#receta').val(),
				receta:   btoa($('#cuerpoReceta').val())
			},
			url   = $btnGuardarReceta.attr('href');

		$.ajax({
			url:      url,
			type:     'post',
			dataType: 'json',
			data:     datos,
			beforeSend: function() {
				$('#modalLoading').modal('show');
			}
		})
		.done(function(resultado) {
			$('#modalLoading').modal('hide');
			console.log(resultado);

			if(resultado.estatus === 'fail') {
				bootbox.alert('Ocurrió un error al anexar la receta a la consulta actual.');
			}

			if (resultado.estatus === 'OK') {
				bootbox.alert('Se anexó la receta a la consulta actual.', function() {
					$('#generarReceta').attr('disabled', false);
					$('#generoReceta').val('1');
				});
			}
		})
		.fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(textStatus + ': ' + errorThrown);
			$('#modalLoading').modal('hide');
			bootbox.alert('Ocurrió un error al anexar la receta a la consulta actual.');
		});
	});

	// interconsulta
	$btnGuardarInterconsulta.on('click', function(event) {
		event.preventDefault();
		if ($('#referencia').val() === '') {
			bootbox.alert('Por favor, escriba una referencia');
			return false;
		}

		if ($('#medico').val() === '') {
			bootbox.alert('Por favor, seleccione a un médico');
			return false;
		}
		// objeto a enviar
		var datos = {
				_token:     $formConsulta.find('input[name="_token"]').val(),
				medicoId:   $('#medico').val(),
				referencia: btoa($('#referencia').val())
			},
			url   = $btnGuardarInterconsulta.attr('href');

		$.ajax({
			url:      url,
			type:     'post',
			dataType: 'json',
			data:     datos,
			beforeSend: function() {
				$('#modalLoading').modal('show');
			}
		})
		.done(function(resultado) {
			$('#modalLoading').modal('hide');
			console.log(resultado);

			if(resultado.estatus === 'fail') {
				bootbox.alert('Ocurrió un error al anexar la interconsulta a la consulta actual.');
			}

			if (resultado.estatus === 'OK') {
				bootbox.alert('Se anexó la interconsulta a la consulta actual.', function() {
					$('#generarInterconsulta').attr('disabled', false);
					$('#generoInterconsulta').val('1');
				});
			}
		})
		.fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(textStatus + ': ' + errorThrown);
			$('#modalLoading').modal('hide');
			bootbox.alert('Ocurrió un error al anexar la interconsulta a la consulta actual.');
		});
	});

	// activar y desactivar elementos de medida
	$('input.medidas').on('click', function(event) {
		var idInputText = $(this).data('id');

		if ($(this).is(':checked')) {
			$('#' + idInputText).attr('readonly', false);
		} else {
			$('#' + idInputText).attr('readonly', true);
			$('#' + idInputText).val('');
		}
	});

	//  guardar consulta
	$btnGuardarConsulta.on('click', function(){
		if ($formConsulta.valid() === true) {
			if ($('#primeraVez').val() === '1' || $('#dadoAlta').val() === '1') {
				if ($('#generoPlan').val() === '0') {
					bootbox.alert('Por favor, genere el plan de tratamiento para el odontograma del paciente');
					return false;
				} else {
					bootbox.confirm('¿El plan de tratamiento está generado de manera correcta?', function (eleccion) {

						if (eleccion) {
							// generar objeto de datos
							var datos 		   = $formConsulta.serialize(),
								tipoEncontrado = false;

							$.ajax({
								url:        $formConsulta.attr('action'),
								type:       'post',
								dataType:   'json',
								data:       datos,
								beforeSend: function () {
									$('#modalLoading').modal('show');
								}

							}).done(function (respuesta) {
								$('#modalLoading').modal('hide');

								if (respuesta.estatus === 'fail') {
									bootbox.alert('Ocurrió un error al generar la consulta. Por favor, intente de nuevo.');
								}

								if (respuesta.estatus === 'OK') {
									bootbox.alert('La consulta se guardó exitósamente.', function () {
                                        // abrir plan de tratamiento si tiene
										if (respuesta.odontogramaId !== null) {
                                            window.open('/pacientes/plan/' + respuesta.odontogramaId +'/' + respuesta.expedienteId);
                                        }
                                        // redirigir a pantalla principal
                                        window.location.href = $('#url').val();
									});
								}

							}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
								console.log(textStatus + ': ' + errorThrown);
								$('#modalLoading').modal('hide');
								bootbox.alert('Ocurrió un error al generar la consulta. Por favor, intente de nuevo.');
							});
						}
					});
				}
			} else {
				// guardar form
				var datos 		   = $formConsulta.serialize(),
                    tipoEncontrado = false;

                $.ajax({
                    url:        $formConsulta.attr('action'),
                    type:       'post',
                    dataType:   'json',
                    data:       datos,
                    beforeSend: function () {
                        $('#modalLoading').modal('show');
                    }

                }).done(function (respuesta) {
                    $('#modalLoading').modal('hide');

                    if (respuesta.estatus === 'fail') {
                        bootbox.alert('Ocurrió un error al generar la consulta. Por favor, intente de nuevo.');
                    }

                    if (respuesta.estatus === 'OK') {
                        bootbox.alert('La consulta se guardó exitósamente.', function () {
                            // redirigir a pantalla principal
                            window.location.href = $('#url').val();
                        });
                    }

                }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log(textStatus + ': ' + errorThrown);
                    $('#modalLoading').modal('hide');
                    bootbox.alert('Ocurrió un error al generar la consulta. Por favor, intente de nuevo.');
                });
			}
		}
	});

	// costos de consulta
	$formConsulta.on('click', 'input.consultaCosto', function(event) {
		if($(this).attr('checked') === 'checked') {
			costoTotalConsulta += Number($(this).data('value'));
		} else {
			costoTotalConsulta -= Number($(this).data('value'));
		}

		$('#costoAsignadoConsulta').val(costoTotalConsulta);
	});

	// cambio a indicaciones dentales
    $('#indicacion').on('change', function() {
        let indicacion = atob($('input[name="higieneDental_' + $(this).val() + '"]').val())
        $('#indicacionDental').val(indicacion)
    })

    // cambio a indicaciones
    $('#indicacionId').on('change', function() {
        let indicacion = atob($('input[name="indicacion_' + $(this).val() + '"]').val())
        $('#indicacionCuerpo').val(indicacion)
    })
    
    // guardar higiene dental
    $btnGuardarHigieneDental.on('click', function () {
        var datos = {
                _token:          $formConsulta.find('input[name="_token"]').val(),
                higieneDentalId: $('#indicacion').val(),
                indicacion:      btoa($('#indicacionDental').val())
            },
            url = '/consultas/higiene/agregar'

        if (datos.indicacion === '') {
            bootbox.alert('Debe especificar el cuerpo de la indicación dental')
            return false;
        }

        $.ajax({
            url:      url,
            type:     'post',
            dataType: 'json',
            data:     datos,
            beforeSend: function() {
                $('#modalLoading').modal('show')
            }
        })
        .done(function(resultado) {
            $('#modalLoading').modal('hide')
            console.log(resultado)

            if(resultado.estatus === 'error') {
                bootbox.alert('Ocurrió un error al anexar la indicacion de higiene dental a la consulta actual.')
            }

            if (resultado.estatus === 'success') {
                bootbox.alert('Se anexó la indicación de higiene dental a la consulta actual.', function() {
                    $('#generarHigieneDental').attr('disabled', false)
                    $('#generoHigieneDental').val('1')
                })
            }
        })
        .fail(function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(textStatus + ': ' + errorThrown)
            $('#modalLoading').modal('hide')
            bootbox.alert('Ocurrió un error la indicación de higiene dental a la consulta actual.')
        })
    })

    // guardar indicacion
    $btnGuardarIndicacion.on('click', function () {
        var datos = {
                _token:           $formConsulta.find('input[name="_token"]').val(),
                indicacionId:     $('#indicacionId').val(),
                indicacionCuerpo: btoa($('#indicacionCuerpo').val())
            },
            url = '/consultas/indicacion/agregar'

        if (datos.indicacionCuerpo === '') {
            bootbox.alert('Debe especificar el cuerpo de la indicación')
            return false;
        }

        $.ajax({
            url:      url,
            type:     'post',
            dataType: 'json',
            data:     datos,
            beforeSend: function() {
                $('#modalLoading').modal('show')
            }
        })
        .done(function(resultado) {
            $('#modalLoading').modal('hide')
            console.log(resultado)

            if(resultado.estatus === 'error') {
                bootbox.alert('Ocurrió un error al anexar la indicacion de higiene dental a la consulta actual.')
            }

            if (resultado.estatus === 'success') {
                bootbox.alert('Se anexó la indicación a la consulta actual.', function() {
                    $('#generarIndicacion').attr('disabled', false)
                    $('#generoIndicacion').val('1')
                })
            }
        })
        .fail(function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(textStatus + ': ' + errorThrown)
            $('#modalLoading').modal('hide')
            bootbox.alert('Ocurrió un error al anexar la indicación a la consulta actual.')
        })
    })
    
	/**
	 * se ejecuta una sola vez
	 */
	function asignarCostoAConsulta() {
		$formConsulta.find('input.consultaCosto').each(function() {
			if ($(this).is(':checked')) {
				costoTotalConsulta += Number($(this).data('value'));
			}
		});

		if (costoTotalConsulta > 0) {
			$('#costoAsignadoConsulta').val(costoTotalConsulta);
		}
	}
});