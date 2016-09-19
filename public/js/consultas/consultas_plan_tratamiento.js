$(function() {
	var $btnGenerarPlan = $('#btnGenerarPlan');

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
				$('#modalLoading').modal('show');
			}
		})
		.done(function(resultado) {
			$('#modalLoading').modal('hide');
			console.log(resultado);

			if(resultado.estatus === 'fail') {
				bootbox.alert('Ocurrió un error al generar el plan de tratamiento.');
			}

			if (resultado.estatus === 'OK') {
				$('#dvPlanTratamiento').html(resultado.html);
				$('#planDeTratamiento').modal('show');
			}
		})
		.fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(textStatus + ': ' + errorThrown);
			$('#modalLoading').modal('hide');
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
				$('#modalLoading').modal('show');
			}
		})
		.done(function(resultado) {
			$('#modalLoading').modal('hide');
			console.log(resultado);

			if(resultado.estatus === 'fail') {
				bootbox.alert('Ocurrió un error al agregar el tratamiento al plan actual.');
			}

			if (resultado.estatus === 'OK') {
				$('#dvPlanTratamiento').html(resultado.html);
			}
		})
		.fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(textStatus + ': ' + errorThrown);
			$('#modalLoading').modal('hide');
			bootbox.alert('Ocurrió un error alagregar el tratamiento al plan actual.');
		});
	});	

	// eliminar otro tratamiento
	$('#dvPlanTratamiento').on('click', 'button.eliminarOtroTratamiento', function () {
		var url = $(this).data('url'),
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
				$('#modalLoading').modal('show');
			}
		})
		.done(function(resultado) {
			$('#modalLoading').modal('hide');
			console.log(resultado);

			if(resultado.estatus === 'fail') {
				bootbox.alert('Ocurrió un error al eliminar el tratamiento del plan actual.');
			}

			if (resultado.estatus === 'OK') {
				$('#dvPlanTratamiento').html(resultado.html);
			}
		})
		.fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(textStatus + ': ' + errorThrown);
			$('#modalLoading').modal('hide');
			bootbox.alert('Ocurrió un error al eliminar el tratamiento del plan actual.');
		});
	});	
});