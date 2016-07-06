$(function() {
	// variables
	var $formDienteEstatus 	   = $('#formDienteEstatus'),
		alMenosUnoSeleccionado = 0,
		respuestaAjax;

	$('#btnGuardar').on('click', function(event) {

		// recorrer todos los checkboxes para ver que al menos uno esté seleccionado
		$formDienteEstatus.find('input.estatus').each(function(index, el) {
			if($(this).is(':checked')) {
				alMenosUnoSeleccionado = 1;
			}
		});

		// si hay al menos uno seleccionado, guardar
		if(alMenosUnoSeleccionado === 1) {
			respuestaAjax = ajax($formDienteEstatus.attr('action'), 'post', 'html', $formDienteEstatus.serialize(), 'guardar');

			// evaluar respuesta AJAX
			respuestaAjax.done(function(resultado) {
				console.log(resultado);

				if(resultado === '0') {
					bootbox.alert('Ocurrió un error al guardar los estatus para el diente seleccionado');
					return false;
				}

				bootbox.alert('Estatus asignados al diente seleccionado', function() {
					// mandar a pintar el odontograma nuevamente y cerrar la ventana
					$('#dvOdontograma').html(resultado);
				});
			})
			.fail(function(XMLHttpRequest, textStatus, errorThrown) {
				console.log(errorThrown);
				bootbox.alert('Imposible realizar la operación solicitada');
			});

		} else {
			bootbox.alert('Seleccione al menos un estatus');
		}
	});
});