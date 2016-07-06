$(function() {
	// variables
	var $formCita 	       = $('#formCita'),
		$dvFormCitas       = $('#dvFormCitas'),
		$dvResultados      = $('#dvResultados'),
		$txtNombre     	   = $('#txtNombre'),
		$txtNombreBusqueda = $('#txtNombreBusqueda'),
		$txtPaterno    	   = $('#txtPaterno'),
		$txtMaterno        = $('#txtMaterno'),
		$txtTelefono       = $('#txtTelefono'),
		$txtCelular        = $('#txtCelular'),
		$txtEmail          = $('#txtEmail'),
		$urlBusqueda 	   = $('#urlBusqueda'),
		$fecha			   = $('#fecha'),
		$hora			   = $('#hora'),
		$medico			   = $('#medico'),
		$btnPacienteNuevo  = $('#btnPacienteNuevo'),
		_token			   = $('input[name="_token"]').val();

	// focus
	setTimeout(function (argument) {
		$txtNombreBusqueda.focus();
	}, 500);

	// inicializar validaciones
	init();

	// validar form
	$formCita.validate();
	agregaValidacionesElementos($formCita);

	// guardar nueva cita
	$('#btnAgendar').on('click', function(event) {
		if($formCita.valid() === true) {
			var data = $formCita.serialize();

			// guardar cita
			agendarCita(data, $formCita.attr('action'));
		}
	});

	////////////////////////////////////////////////////////////////////////////////////////////
	// logica para busqueda de pacientes
	$('#btnComprueba').on('click', function(event) {
		// especificar al menos nombre y ap paterno
		if($txtNombreBusqueda.val() === '') {
			bootbox.alert('Especifique al menos el nombre y apellido paterno');
			return false;
		}

		var respuesta = ajax($urlBusqueda.val(), 'post', 'html', {txtNombreBusqueda: $txtNombreBusqueda.val(), _token: _token, medico: $('#medico').val()}, 'guardar', '', '');
		respuesta.done(function(resultado) {
			console.log(resultado);
			// resultados
			$dvResultados.html(resultado);
			// ocultar form y mostrar resultados
			$dvResultados.show(300);

		})
		.fail(function(XMLHttpRequest, textStatus, errorThrown) {
			bootbox.alert('Error al realizar la operación solicitada');
			// imprimir en consola el error
			console.log(errorThrown);
		});

	});

	// nuevo paciente, nueva captura
	$btnPacienteNuevo.on('click', function(event) {
		$dvResultados.hide(300);
		$formCita.show(300);
		$('#nuevoPaciente').val(1);
	});

	// nueva captura
	$dvResultados.on('click', 'a.nuevo', function(event) {
		$dvResultados.hide(300);
		$formCita.show(300);
		// borrar dato de busqueda
		$txtNombreBusqueda.val('');
		$('#nuevoPaciente').val(1);
	});

	// seleccionar paciente de las coincidencias encontradas
	$dvResultados.on('click', 'a.seleccionaPersona', function(event) {
		// setear variables
		var data = {
			'idExpediente' : $(this).parent('td').siblings('td.id').text(),
			'idPaciente'   : $(this).siblings('input[name="idPaciente"]').val(),
			'txtNombre'    : $(this).siblings('input[name="nombre"]').val(),
			'txtPaterno'   : $(this).siblings('input[name="paterno"]').val(),
			'txtMaterno'   : $(this).siblings('input[name="materno"]').val(),
			'txtTelefono'  : $(this).siblings('input[name="telefono"]').val(),
			'txtCelular'   : $(this).siblings('input[name="celular"]').val(),
			'txtEmail' 	   : $(this).parent('td').siblings('td.email').text(),
			'fecha'        : $fecha.val(),
			'hora'		   : $hora.val(),
			'medico'	   : $medico.val(),
			'opcion'	   : $('#opcion').val(),
			'nuevoPaciente': '0',
			'_token'	   : _token
		};

		bootbox.confirm('¿Desea agendar la cita de esta persona?', function(r) {
			if(r === true) {
				// agendar cita
				agendarCita(data, $formCita.attr('action'));
			}
		});
	});
});

// guardar citas
function agendarCita(data, url)
{
	var respuesta = ajax(url, 'post', 'html', data, 'guardar', '', '');
	respuesta.done(function(resultado) {
		console.log(resultado);

		// verificar resultado
		if(resultado === '1') {
			bootbox.alert('Cita agendada con éxito', function() {
				// refresh events
				window.opener.recargarCitas();
				// cerrar ventana
				window.close();
			});
		} else {
			bootbox.alert('Ocurrió un error al agendar la cita. Intente de nuevo');
		}

	})
	.fail(function(XMLHttpRequest, textStatus, errorThrown) {
		console.log(errorThrown);
		bootbox.alert('Error al realizar la operación solicitada');
	});
}