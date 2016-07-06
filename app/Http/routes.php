<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('login', 'Usuarios\LoginController@index');
Route::post('login', 'Usuarios\LoginController@logueo');
Route::get('logout', 'Usuarios\LoginController@logout');

// aplicacion
Route::group(['middleware' => 'checaLogin'], function() {
	// pagina principal
	Route::get('/', 'PrincipalController@index');

	/////////////////////////////////////////// CITAS /////////////////////////////////////////////////////
	// pagina principal
	Route::get('citas/{med}', 'Citas\CitasController@index');
	// ver eventos
	Route::get('citas/citas/{med}/{fecha?}', 'Citas\CitasController@verCitas');
	// ver formulario de alta
	Route::get('citas/agregar/{fecha}/{hora}/{med}', 'Citas\CitasController@agregar');
	// guardar cita
	Route::post('citas/agregar', 'Citas\CitasController@guardar');
	// verificar que exista un expediente
	Route::post('citas/verifica', 'Citas\CitasController@comprobarPaciente');
	// ver detalles de una cita
	Route::get('citas/detalle/{id}/{medico}', 'Citas\CitasController@verDetalle');
	// ver formulario de editar
	Route::get('citas/editar/{id}', 'Citas\CitasController@editar');
	// actualizar cita
	Route::post('citas/actualizar', 'Citas\CitasController@actualizar');
	// modificar estatus de cita
	Route::post('citas/estatus', 'Citas\CitasController@estatus');
	// seleccion de reprogramar
	Route::post('citas/guardaEnSesion', 'Citas\CitasController@guardaEnSesion');
	// acción de reprogramar
	Route::post('citas/reprogramar', 'Citas\CitasController@reprogramar');
	// generar el reporte de las citas del dia
	Route::get('citas/lista/pdf/{medico}/{fecha}', 'Citas\CitasController@pdf');
	///////////////////////////////////////////////////////////////////////////////////////////////////////

	/////////////////////////////////////////// EXPEDIENTES //////////////////////////////////////////////
	// abrir formulario de captura
	Route::get('expedientes/agregar/odont/{id}/{med}', 'Expedientes\ExpedienteController@index');
	// abrir pantalla de vista previa
	Route::get('expedientes/ver/odont/{id}/{med}', 'Expedientes\ExpedienteController@ver');
	// guardar / editar expediente
	Route::post('expedientes/agregarEditar', 'Expedientes\ExpedienteController@agregarEditarExpediente');
	// firmar expediente
	Route::post('expedientes/firmar', 'Expedientes\ExpedienteController@firmar');
	// subir foto
	Route::post('expedientes/subir/foto', 'Expedientes\ExpedienteController@subirFoto');
	//recortar foto
	Route::post('expedientes/recortar/foto', 'Expedientes\ExpedienteController@recortarFoto');
	//abrir camara
	Route::get('expedientes/foto/camara/{id}/{med}', 'Expedientes\ExpedienteController@camara');
	// guardar foto capturada por camara
	Route::post('expedientes/foto/camara/{id}/{med}', 'Expedientes\ExpedienteController@capturarFoto');

	/////////////////////////////////////////// CONSULTAS //////////////////////////////////////////////
	// principal consultas
	Route::get('consultas/{medico}', 'Consultas\ConsultasController@index');
	// buscar citas por dia
	Route::post('consultas/citas', 'Consultas\ConsultasController@verCitasDelDia');
	// ver detalle de una cita
	Route::post('consultas/cita/detalle', 'Consultas\ConsultasController@citaDetalle');
	// abrir pantalla de captura de consulta
	Route::get('consultas/capturar/{id}/{med}/{idCita}', 'Consultas\ConsultasController@capturar');
	// abrir pantalla de selección de estatus, pasando el número de diente
	Route::get('consultas/odontograma/estatus/{id}', 'Consultas\ConsultasController@seleccionEstatus');
	// guardar estatus para el odontograma
	Route::post('consultas/odontograma/estatus/asignar', 'Consultas\ConsultasController@asignarEstatusDental');
	// pintar odontograma
	Route::post('consultas/odontograma/dibujar', 'Consultas\ConsultasController@dibujar');
	// ventana recetas
	Route::get('consultas/receta/agregar', 'Consultas\ConsultasController@capturaReceta');
	// asignar padecimientos al diente
	Route::post('consultas/capturar/diente/padecimiento', 'Consultas\ConsultasController@agregaDientePadecimiento');
	// abrir ventana para plan de tratamiento
	Route::get('consultas/plan/agregar/{med}/{id}', 'Consultas\ConsultasController@verPlan');
	// agregar un tratamiento a un diente
	Route::post('consultas/plan/tratamientos/agregar', 'Consultas\ConsultasController@agregarTratamiento');
	// agregar otro tratamiento al plan
	Route::post('consultas/plan/tratamientos/otros/agregar', 'Consultas\ConsultasController@agregarOtroTratamiento');
	// agregar receta
	Route::post('consultas/capturar/receta', 'Consultas\ConsultasController@agregarReceta');
	// agregar interconsulta
	Route::post('consultas/capturar/interconsulta', 'Consultas\ConsultasController@agregarInterconsulta');
	// guardar consulta
	Route::post('consultas/guardar', 'Consultas\ConsultasController@guardar');

	// imprimir receta
	Route::get('consultas/receta/{med}/{id}', 'Consultas\ConsultasController@receta');

	// imprimir interconsulta
	Route::get('consultas/interconsulta/{med}/{id}', 'Consultas\ConsultasController@interconsulta');

	// imprimir plan
	Route::get('consultas/plan/{med}/{id}', 'Consultas\ConsultasController@plan');

	/////////////////////////////////////////// PACIENTES //////////////////////////////////////////////
	Route::get('pacientes/{med}', 'Pacientes\PacientesController@index');
	// buscar pacientes
	Route::post('pacientes/buscar', 'Pacientes\PacientesController@buscar');
	// detalles de un paciente
	Route::post('pacientes/detalle', 'Pacientes\PacientesController@detalle');
	// agregar anexos al expediente del paciente
	Route::post('pacientes/anexo/agregar', 'Pacientes\PacientesController@agregarAnexo');
	// borrar anexos
	Route::post('pacientes/anexo/eliminar', 'Pacientes\PacientesController@eliminarAnexo');
	// generar tratamientos ortopedia - ortodoncia
	Route::post('pacientes/tratamiento/agregar', 'Pacientes\PacientesController@agregarTratamiento');

	// generar receta en PDF
	Route::get('pacientes/receta/{id}/{idPaciente}/{med}', 'Pacientes\PacientesController@generarReceta');

	// generar interconsulta PDF
	Route::get('pacientes/interconsulta/{id}/{idPaciente}/{med}', 'Pacientes\PacientesController@generarInterconsulta');

	// generar plan de tratamiento PDF
	Route::get('pacientes/plan/{id}/{idPaciente}/{med}', 'Pacientes\PacientesController@generarPlan');

	/////////////////////////////////////////// USUARIOS /////////////////////////////////////////////////////
	Route::get('usuarios', 'Usuarios\UsuariosController@index');
	Route::get('usuarios/agregar', 'Usuarios\UsuariosController@agregar');
	Route::post('usuarios/buscar', 'Usuarios\UsuariosController@buscar');
	Route::post('usuarios/agregar', [
		'as'  => 'usuarios-agregar',
		'uses' =>'Usuarios\UsuariosController@guardarUsuario'
	]);
});