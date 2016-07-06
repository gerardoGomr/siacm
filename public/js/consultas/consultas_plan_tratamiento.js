$(function() {
	// bandera padre
	window.opener.$('#generoPlan').val('1');

	// variables
	var $dvPlanTratamiento = $('#dvPlanTratamiento');

	// evento change de los selects
	$dvPlanTratamiento.on('change', 'select.tratamientos', function(event) {
		if ($(this).val() !== '') {

			var datos = {
					_token: 	    $('#_token').val(),
					numeroDiente:   $(this).parent('td').siblings('td.diente').text(),
					idTratamiento:  $(this).val(),
					numeroElemento: $(this).siblings('input.numeroTratamiento').val()
				},
				respuestaAjax = ajax($('#urlAgregarTratamientos').val(), 'post', 'html', datos, 'guardar');

			respuestaAjax.done(function(resultado) {
				console.log('éxito');

				$('#dvPlanTratamiento').html(resultado);
				$('#generarPlan').attr('disabled', false);
			})
			.fail(function(XMLHttpRequest, textStatus, errorThrown) {
				console.log(errorThrown);
			});
		}
	});

	// evento click para otros tratamientos
	$('#btnAgregarOtroTratamiento').on('click', function(event) {
		event.preventDefault();
		if ($("#otrosTratamientos").val() !== '') {
			var datos = {
					_token: 	       $('#_token').val(),
					idOtroTratamiento: $('#otrosTratamientos').val()
				},
				respuestaAjax = ajax($(this).attr('href'), 'post', 'html', datos, 'guardar');

			respuestaAjax.done(function(resultado) {
				console.log('éxito');

				$('#dvPlanTratamiento').html(resultado);
			})
			.fail(function(XMLHttpRequest, textStatus, errorThrown) {
				console.log(errorThrown);
			});
		}
	});

	// cerrar ventana
	$('#btnAceptar').on('click', function(event) {
		window.close();
	});
});