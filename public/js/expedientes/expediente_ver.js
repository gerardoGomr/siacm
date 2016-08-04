$(document).ready(function($) {
	
	$('#widgetForm').on('click', 'a', function() {
		$(this).parents('li').addClass('bg-primary');
		$(this).parents('li').siblings('li').removeClass('bg-primary');
	});
	
	$('#firmar').on('click', function() {
		bootbox.confirm('Se marcará al expediente como revisado, ¿desea continuar?', function(r) {
			if(r) {
				$.ajax({
					url:      $('#urlFirmar').val(),
					type:     'post',
					dataType: 'json',
					data:     $('#formExpediente').serialize(),
					beforeSend: function() {
						$('#modalLoading').modal('show');
					}
				})
				.done(function(respuesta) {
					$('#modalLoading').modal('hide');

					if (respuesta.estatus === 'fail') {
						bootbox.alert('Ocurrió un error marcar el expediente como revisado. Intente de nuevo.');
					}

					if (respuesta.estatus === 'OK') {
						bootbox.alert('Se marcó al expediente como revisado');
						window.location.href = '';
					}
				})
				.fail(function(XMLHttpRequest, textStatus, errorThrown) {
					$('#modalLoading').modal('hide');
					bootbox.alert('Ocurrió un error marcar el expediente como revisado. Intente de nuevo.');
					console.log(textStatus + ': ' + errorThrown);
				});
			}
		});
	});

});