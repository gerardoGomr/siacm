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

		// agendar
		agendarCita();
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

	// buscar paciente
	$('#btnComprueba').on('click', function() {
		buscarPacientes($('#nombreBusqueda').val());
	});

	// mostar busqueda de nuevo
	$('#buscarDeNuevo').on('click', function() {
		$('#buscadorPacientes').removeClass('hide');
		$('#datos').addClass('hide');
		$('#nombreBusqueda').focus();
		$('#seguirCapturando').removeClass('hide');
	});

	// mostar seguir capturando
	$('#seguirCapturando').on('click', function() {
		$('#buscadorPacientes').addClass('hide');
		$('#datos').removeClass('hide');
		$('#nombre').focus();
		$('#seguirCapturando').addClass('hide');
	});

	// clic en resultados, utilizar paciente
	$('#dvResultados').on('click', 'tr.seleccionarPaciente', function(event) {
		var pacienteId = $(this).data('id'),
			nombre     = $(this).children('td.nombreCompleto').text();

		bootbox.confirm('¿Desea agendar una nueva cita a ' + nombre + '?', function(r) {
			if(r) {
				// agendar cita
				$('#pacienteId').val(pacienteId);
				// agendar
				agendarCita();
			}
		});
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
			$('#modalLoading').modal('hide');
			$('#busquedaPacienteRealizada').val('1');
			console.log(resultado.estatus);

			if(resultado.estatus === 'fail') {
				console.log(resultado.mensaje);
				bootbox.alert('No se encontraron coincidencias para ' + dato + '. Por favor, captúre sus datos para registrar su cita.', function () {
					$('#buscadorPacientes').addClass('hide');
					$('#datos').removeClass('hide');
					$('#nombre').focus();
				});
			}

			if (resultado.estatus === 'OK') {
				$('#dvResultados').html(resultado.html);
			}

		}) .fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(textStatus + ': ' + errorThrown);
			$('#modalLoading').modal('hide');
			bootbox.alert('Error al buscar pacientes. Intente de nuevo');
		});
	}

	/**
	 * agendar nueva cita
	 */
	function agendarCita() {
		// agendar cita
		$.ajax({
			url:      $('#formNuevaCita').attr('action'),
			type:     'post',
			dataType: 'json',
			data:	  $('#formNuevaCita').serialize(),
			beforeSend: function () {
				$('#modalLoading').modal('show');
			}

		}).done(function(resultado) {
			$('#modalLoading').modal('hide');
			console.log(resultado.estatus);

			if(resultado.estatus === 'fail') {
				bootbox.alert('Ocurrió un error al agendar la cita. Por favor, intente de nuevo');
			}

			if (resultado.estatus === 'OK') {
				bootbox.alert('Cita agendada con éxito', function() {
					reiniciarForm();
					$('#modalAgendarCita').modal('hide');
				});
			}

		}) .fail(function(XMLHttpRequest, textStatus, errorThrown) {
			$('#modalLoading').modal('hide');
			console.log(textStatus + ': ' + errorThrown);
			bootbox.alert('Ocurrió un error al agendar la cita. Por favor, intente de nuevo');
		});
	}

	/**
	 * reiniciar formulario al poner sus campos vacíos
	 * y layers
	 */
	function reiniciarForm() {
		$('#formNuevacita').each('input', function() {
			$(this).val('');
		});

		$('#buscadorPacientes').removeClass('hide');
		$('#datos').addClass('hide');
		$('#nombreBusqueda').focus();
		$('#seguirCapturando').addClass('hide');
	}
});