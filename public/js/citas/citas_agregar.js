$(document).ready(function($) {
	// inicializar validaciones
	init();

	// validar form
	$('#formNuevacita').validate();
	agregaValidacionesElementos($('#formNuevacita'));

	// agendar cita
	$('#agendarCita').on('click', function () {
		if ($('#busquedaPacienteRealizada').val() === '0') {
			bootbox.alert('Por favor, busque a un paciente para agendarle su cita.');
			return false;
		}

		if (!$('#formNuevaCita').valid()) {
			return false;
		}

		// guardar
	});

	// evitar submit
	$('#nombreBusqueda').on('keypress', function(event) {
		if (event === 13 || event.which === 13) {
			return false;
		}
	});

	// buscar paciente
	$('#nombreBusqueda').on('keyup', function(event) {
		if (event === 13 || event.which === 13) {
			// especificar al menos nombre y ap paterno
			buscarPacientes($('#nombreBusqueda').val());
		}
	});

	$('#btnComprueba').on('click', function() {
		buscarPacientes($('#nombreBusqueda').val());
	});

	/**
	 * buscar pacientes
	 * @param string dato
	 * @returns {boolean}
     */
	function buscarPacientes(dato) {
		if(dato === '') {
			bootbox.alert('Especifique al menos el nombre y apellido paterno');
			return false;
		}

		$.ajax({
			url:      $('#btnComprueba').data('url'),
			type:     'post',
			dataType: 'json',
			data:	  { dato: dato, _token: $('#formNuevaCita').find('input[name="_token"]').val() },
			beforeSend: function () {
				$('#modalLoading').modal('show');
			}

		}).done(function(resultado) {
			$('#modalLoading').hide('show');

			console.log(resultado.estatus);

			if(resultado.estatus === 'fail') {
				bootbox.alert('Error al buscar pacientes. Intente de nuevo');
				return false;
			}

			if (resultado.estatus === 'OK') {
				$('#dvResultados').html(resultado.html);
			}

		}) .fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(textStatus + ': ' + errorThrown);
			$('#modalLoading').hide('show');
			bootbox.alert('Error al buscar pacientes. Intente de nuevo');
		});
	}
})