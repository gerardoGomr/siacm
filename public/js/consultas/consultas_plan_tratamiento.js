$(function() {
	var $btnGenerarPlan = $('#btnGenerarPlan'),
		$formConsulta   = $('#formConsulta'),
		$modalLoading   = $('#modalLoading')

	/**
	 * abir nueva ventana
	 * generar plan de tratamiento en base a odontograma
	 */
	$btnGenerarPlan.on('click', function(event) {
		var url = $(this).data('url');

		$.ajax({
			url:      url,
			type:     'post',
			dataType: 'json',
			data:     {_token: $formConsulta.find('input[name="_token"]').val()},
			beforeSend: function() {
				$modalLoading.modal('show');
			}
		})
		.done(function(resultado) {
			$modalLoading.modal('hide');
			console.log(resultado);

			if(resultado.estatus === 'fail') {
				bootbox.alert('Ocurrió un error al generar el plan de tratamiento.');
			}

			if (resultado.estatus === 'OK') {
				$('#dvPlanTratamiento').html(resultado.html);

				validarBotonesDeAccionDePlan(resultado);

				$('#planDeTratamiento').modal('show');
			}
		})
		.fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(textStatus + ': ' + errorThrown);
			$modalLoading.modal('hide');
			bootbox.alert('Ocurrió un error al generar el plan de tratamiento.');
		});
	});

	// evento para agregar otro tratamiento al plan
	$('#btnAgregarOtroTratamiento').on('click', function () {
		var url = $(this).data('url');

		if ($("#otrosTratamientos").val() === '') {
			bootbox.alert('Por favor, seleccione un tratamiento');
			return false;
		}

		$.ajax({
			url:      url,
			type:     'post',
			dataType: 'json',
			data:     {_token: $formConsulta.find('input[name="_token"]').val(), otroTratamientoId: $('#otrosTratamientos').val()},
			beforeSend: function() {
				$modalLoading.modal('show');
			}
		})
		.done(function(resultado) {
			$modalLoading.modal('hide');
			console.log(resultado);

			if(resultado.estatus === 'fail') {
				var mensaje = resultado.mensaje !== '' ? resultado.mensaje : '';

				bootbox.alert('Ocurrió un error al agregar el tratamiento al plan actual. ' + mensaje);
			}

			if (resultado.estatus === 'OK') {
				$('#dvPlanTratamiento').html(resultado.html);
			}
		})
		.fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(textStatus + ': ' + errorThrown);
			$modalLoading.modal('hide');
			bootbox.alert('Ocurrió un error al agregar el tratamiento al plan actual.');
		});
	});

	// eliminar otro tratamiento
	$('#dvPlanTratamiento').on('click', 'button.eliminarOtroTratamiento', function () {
		var url = $('#urlEliminarOtroTratamiento').val(),
			otroTratamientoId = $(this).data('id'),
			datos = {
				_token: $formConsulta.find('input[name="_token"]').val(),
				otroTratamientoId: otroTratamientoId
			};

		$.ajax({
			url:      url,
			type:     'post',
			dataType: 'json',
			data:     datos,
			beforeSend: function() {
				$modalLoading.modal('show');
			}
		})
		.done(function(resultado) {
			$modalLoading.modal('hide');
			console.log(resultado);

			if(resultado.estatus === 'fail') {
				var mensaje = resultado.mensaje !== '' ? resultado.mensaje : '';
				bootbox.alert('Ocurrió un error al eliminar el tratamiento del plan actual. ' + mensaje);
			}

			if (resultado.estatus === 'OK') {
				$('#dvPlanTratamiento').html(resultado.html);
			}
		})
		.fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(textStatus + ': ' + errorThrown);
			$modalLoading.modal('hide');
			bootbox.alert('Ocurrió un error al eliminar el tratamiento del plan actual.');
		});
	});

	// evento para agregar tratamientos al diente actual
	$('#dvPlanTratamiento').on('click', 'button.agregarTratamiento', function () {
		var $select = $(this).parents('div').siblings('select.tratamientos');

		if ($select.val() !== '') {

			var datos = {
					_token: 	    $formConsulta.find('input[name="_token"]').val(),
					numeroDiente:   $select.parents('td').siblings('td.diente').text(),
					tratamientoId:  $select.val()
				},
				url = $('#urlAgregarTratamiento').val();

			$.ajax({
				url:      url,
				type:     'post',
				dataType: 'json',
				data:     datos,
				beforeSend: function() {
					$modalLoading.modal('show');
				}
			})
			.done(function(resultado) {
				$modalLoading.modal('hide');
				console.log(resultado);

				if(resultado.estatus === 'fail') {
					var mensaje = resultado.mensaje !== '' ? resultado.mensaje : '';
					bootbox.alert('Ocurrió un error al agregar el tratamiento al diente seleccionado. ' + mensaje);
				}

				if (resultado.estatus === 'OK') {
					$('#dvPlanTratamiento').html(resultado.html);

					validarBotonesDeAccionDePlan(resultado);
				}
			})
			.fail(function(XMLHttpRequest, textStatus, errorThrown) {
				console.log(textStatus + ': ' + errorThrown);
				$modalLoading.modal('hide');
				bootbox.alert('Ocurrió un error al agregar el tratamiento al diente seleccionado.');
			});
		}
	});

	// eliminar tratamientos
	$('#dvPlanTratamiento').on('click', 'button.eliminarTratamiento', function() {
		var numeroDiente = $(this).parents('td').siblings('td.diente').text();

		var datos = {
				_token: 	    $formConsulta.find('input[name="_token"]').val(),
				numeroDiente:   numeroDiente,
				tratamientoId:  $(this).data('id')
			},
			url = $('#urlEliminarTratamiento').val();

		$.ajax({
			url:      url,
			type:     'post',
			dataType: 'json',
			data:     datos,
			beforeSend: function() {
				$modalLoading.modal('show');
			}
		})
		.done(function(resultado) {
			$modalLoading.modal('hide');
			console.log(resultado);

			if(resultado.estatus === 'fail') {
				var mensaje = resultado.mensaje !== '' ? resultado.mensaje : '';
				bootbox.alert('Ocurrió un error al eliminar el tratamiento del diente seleccionado. ' + mensaje);
			}

			if (resultado.estatus === 'OK') {
				$('#dvPlanTratamiento').html(resultado.html);

				validarBotonesDeAccionDePlan(resultado);
			}
		})
		.fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(textStatus + ': ' + errorThrown);
			$modalLoading.modal('hide');
			bootbox.alert('Ocurrió un error al eliminar el tratamiento del diente seleccionado.');
		});
	});

	// cancelar plan de tratamiento
	$formConsulta.on('click', 'button.marcar-plan', function() {
		let expedienteId = $(this).data('id')

		bootbox.confirm('Una vez que se marque a este plan como atendido, no podrá ser editado diréctamente. ¿Desea continuar?', function (r) {
			if (r === true) {
				$.ajax({
					url: 	  '/plan-tratamiento/atender',
					type: 	  'POST',
					dataType: 'json',
					data: 	  {
						expedienteId: expedienteId
					},
					beforeSend: function () {
						$modalLoading.modal('show')
					}
				})
				.done(function(response) {
					$modalLoading.modal('hide');

					if (response.status === 'success') {
						bootbox.alert('El plan de tratamiento actual se ha marcado como atendido.', function () {
							$formConsulta.submit();
						});
						// TODO: refresh form
						window.location.reload(true)
					}

					if (response.status === 'error') {
						bootbox.alert('Ocurrió un error al marcar al tratamiento actual como atendido. Consulte al administrador del sistema.')
					}
				})
				.fail(function(jqXHR, textStatus, errorThrown) {
					console.log(errorThrown)
					$modalLoading.modal('hide')
				});
			}
		});
	});

	// cerrar el modal
	$('#btnAceptar').on('click', function() {
		if ($('#dirigidoA').val() === '') {
			bootbox.alert('Por favor, especifique a quien va a ir dirigido el plan de tratamiento.');
			return false;
		}

		$('#dirigido').val($('#dirigidoA').val());
		$('#planDeTratamiento').modal('hide');
	});

	function validarBotonesDeAccionDePlan(resultado) {
		$('#btnAceptar, #generarPlan').attr('disabled', false);
		$('#generoPlan').val('1');

		if (resultado.planValido === '0') {
			$('#btnAceptar, #generarPlan').attr('disabled', true);

			// colocar la bandera de plan generado en 1
			$('#generoPlan').val('0');
		}
	}

});
