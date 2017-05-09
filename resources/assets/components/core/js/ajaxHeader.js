/*
 * Se especifican los headers para toda petición ajax
 */
jQuery(document).ready(function($) {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
});