$(function() {
	// variables
	var $formConsulta       	 = $('#formConsulta'),
		$btnGuardarConsulta 	 = $('#btnGuardarConsulta'),
		$btnGuardarInterconsulta = $('#btnGuardarInterconsulta'),
		$btnGuardarReceta 		 = $('#btnGuardarReceta'),
		costoTotalConsulta       = 0

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

	//  guardar consulta
	$btnGuardarConsulta.on('click', function(){
		if ($formConsulta.valid() === true) {
			
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
})
