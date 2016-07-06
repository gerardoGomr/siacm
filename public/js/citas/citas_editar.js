$(function() {
	// variables
	var $formCita 	       = $('#formCita'),
		$txtNombre     	   = $('#txtNombre'),
		$txtPaterno    	   = $('#txtPaterno'),
		$txtMaterno        = $('#txtMaterno'),
		$txtTelefono       = $('#txtTelefono'),
		$txtCelular        = $('#txtCelular'),
		$txtEmail          = $('#txtEmail'),
		_token			   = $('input[name="_token"]').val();

	// validar form
	$formCita.validate({
		rules: {
			txtNombre:   'required',
			txtPaterno:  'required',
			txtTelefono: {
				digits: true
			},
			txtCelular:  {
				digits: true
			},
			txtEmail:    {
				email:true
			}
		},
		messages: {
			txtNombre:   'Ingrese nombre',
			txtPaterno:  'Ingrese apellido paterno',
			txtTelefono: {
				digits: 'Ingrese sólo dígitos'
			},
			txtCelular:  {
				digits: 'Ingrese sólo dígitos'
			},
			txtEmail:    {
				email:  'Ingrese un correo electrónico válido'
			}
		}
	});

	// guardar nueva cita
	$('#btnAgendar').on('click', function(event) {
		if($formCita.valid() === true) {
			var data = $formCita.serialize();

			// guardar cita
			agendarCita(data, $formCita.attr('action'));
		}
	});
});

// guardar citas
function agendarCita(data, url)
{
	$.ajax({
		url:  	  url,
		type: 	  'post',
		// dataType: 'json',
		data: 	  data
	})
	.done(function(resultado) {
		console.log(resultado);

		// verificar resultado
		if(resultado === '1') {

			bootbox.alert('Cita actualizada con éxito', function() {
				// redirect
				window.location.href = $('#urlDetalle').val();
			});
		} else {
			bootbox.alert('Ocurrió un error al actualizar la cita. Intente de nuevo');
		}

	})
	.fail(function(XMLHttpRequest, textStatus, errorThrown) {
		console.log(errorThrown);
		bootbox.alert('Error al realizar la operación solicitada');
	});
}