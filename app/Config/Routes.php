<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Inicio');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/Login', 'Inicio::index');
$routes->get('/Inicio', 'Inicio::cargarVistaInicio');
$routes->get('/Registrar', 'Inicio::RegistrarVendedor');
$routes->get('/InsertarVendedor', 'Inicio::InsertarVendedor');
$routes->get('/LoginMovil', 'Inicio::validarDatosIngresoMovil');

// Rutas para el modulo de GestionUsuarios
$routes->group('ModuloUsuarios', ['namespace' => 'App\Controllers\ModuloUsuarios'], function ($routes) {
    $routes->add('RegistrarAdmin', 'RegistrarUsuario::registrarAdmin');
    $routes->add('InsertarAdmin', 'RegistrarUsuario::insertar');
    $routes->add('InsertarMovil', 'RegistrarUsuario::insertarMovil');
    $routes->add('CargarCiudades', 'RegistrarUsuario::cargarCiudadesMovil');
    $routes->add('BuscarUsuarios', 'BuscarUsuarios::index');
    $routes->add('CantidadUsuarios', 'BuscarUsuarios::totalUsuarios');
    $routes->add('CantidadPendientes', 'BuscarUsuarios::totalPendientes');


    $routes->add('MostrarUsuarios', 'BuscarUsuarios::listarusuarios');
    $routes->add('BuscarusuId', 'BuscarUsuarios::buscarporId');
    $routes->add('Actuaestado', 'BuscarUsuarios::actualizarest');
    $routes->add('DesactivarUs', 'BuscarUsuarios::inactivarusuario');

    $routes->add('BuscarInactivos', 'BuscarInactivos::index');
    $routes->add('MostrarInactivos', 'BuscarInactivos::listarinactivos');
    $routes->add('BuscarInacId', 'BuscarInactivos::buscarinacId');
    $routes->add('ActualizarInac', 'BuscarInactivos::actualizarinac');
    $routes->add('RestaurarUsuario', 'BuscarInactivos::restaurarestado');

    $routes->add('BuscarPendientes', 'BuscarPendientes::index');
    $routes->add('MostrarPendientes', 'BuscarPendientes::listarpendientes');
    $routes->add('BuscarPenId', 'BuscarPendientes::buscarpenId');
    $routes->add('ActualizarPen', 'BuscarPendientes::actualizarpen');

    $routes->add('PerfilUsuario', 'PerfilUsuario::index');
    $routes->add('CargarAvatar', 'PerfilUsuario::editarAvatar');
    // Buscar y Editar datos generales del perfil 
    $routes->add('BuscarDatosPerfil', 'PerfilUsuario::buscar_session');
    $routes->add('EditarPerfil', 'PerfilUsuario::enviarnewdatos');

    //  Editar datos  de seguridad del perfil 
    $routes->add('PasswordPerfil', 'PerfilUsuario::password_edit');



    // Rutas para consultar y modificar la ciudad del usuario (AppMovil)
    $routes->add('nombreCiudad', 'PerfilUsuario::consultarNombreCiudad');

    $routes->add('CambiarCiudadMovil', 'PerfilUsuario::editarCiudadMovil');
    $routes->add('EditarDatosMovil', 'PerfilUsuario::editarDatosMovil');
    $routes->add('EditarEmailMovil', 'PerfilUsuario::editarCorreoMovil');
    $routes->add('EditarPasswordMovil', 'PerfilUsuario::editarPasswordMovil');
    $routes->add('DesactivarCuentaMovil', 'PerfilUsuario::desactivarUsuarioMovil');
    $routes->add('ActualizarImagenPerfil', 'PerfilUsuario::editarAvatarMovil');
});

$routes->group('ModuloPublicaciones', ['namespace' => 'App\Controllers\ModuloPublicaciones'], function ($routes) {
    $routes->add('ListarPublicaciones', 'ListarPublicaciones::index');
    $routes->add('ListarPublicacionesMovil', 'ListarPublicaciones::ListarPublicacionesMovil');
    $routes->add('ListarPublicacionesPerfilMovil', 'ListarPublicaciones::ListarPublicacionesPerfilMovil');
    $routes->add('getImagenesPublicacion', 'ListarPublicaciones::getImagenesPublicacion');
    $routes->add('RegistrarPregunta', 'GestionarPreguntasAppMovil::InsertarPregunta');
    $routes->add('ConsultarPreguntas', 'GestionarPreguntasAppMovil::getPreguntas');

    $routes->add('InsertarPublicacion', 'CrearPublicacion::insertar');
    $routes->add('ConsultaIndividual', 'ListarPublicaciones::consultarId');
    $routes->add('ConsultaImagenes', 'ListarPublicaciones::consultarImagenes');
    $routes->add('ConsultaDetalle', 'ListarPublicaciones::detallePublicacion');
    $routes->add('Busqueda', 'ListarPublicaciones::busqueda');
    $routes->add('ActualizarPublicacion', 'EditarPublicacion::editar');
    $routes->add('traerImagenes', 'EditarPublicacion::cargarImagenes');

    $routes->add('EliminarPublicacion', 'ListarPublicaciones::eliminarPublicacion');
    $routes->add('ListarValoracionesPublicacion', 'ListarPublicaciones::getValoracionesPublicacion');
    $routes->add('TraerPreguntas', 'Preguntas::listarPreguntas');
    $routes->add('PreguntaIndividual', 'Preguntas::consultarPregunta');
    $routes->add('RespuestaPregunta', 'Preguntas::guardarRespuesta');
    $routes->add('ConsultarRespuesta', 'Preguntas::consultarRespuesta');
    $routes->add('EliminarPregunta', 'Preguntas::eliminarPregunta');
    $routes->add('EliminarPregunta_Respuesta', 'Preguntas::eliminarPregunta_Respuesta');
    $routes->add('EditarRespuesta', 'Preguntas::editarRespuesta');

    $routes->add('getDatosPublicacion', 'ListarPublicaciones::traerDatosParaCompra');

    $routes->add('PublicacionesInactivas', 'ListarPublicacionesInactivas::index');
    $routes->add('ActivarPublicacion', 'ListarPublicacionesInactivas::activarPublicacion');

    $routes->add('Unidades', 'Unidades::index');
    $routes->add('ConsultarUnidades', 'Unidades::consultarTodo');
    $routes->add('UnidadesInactivas', 'UnidadesInactivas::index');
    $routes->add('ActivarUnidad', 'UnidadesInactivas::activarUnidad');

    $routes->add('ConsultarUno', 'Unidades::consultarId');
    $routes->add('EditarUnidad', 'Unidades::actualizarUnidades');
    $routes->add('EliminarUnidad', 'Unidades::eliminarUnidades');
    $routes->add('InsertarUnidad', 'Unidades::registrarUnidades');
});

$routes->group('ModuloPedidos', ['namespace' => 'App\Controllers\ModuloPedidos'], function ($routes) {
    $routes->add('Pedidos', 'Pedidos::index');
    $routes->add('PedidosEnProceso', 'Pedidos::enProceso');
    $routes->add('PedidosEntregados', 'Pedidos::entregados');
    $routes->add('PasarEnProceso', 'Pedidos::pasar_a_Proceso');
    $routes->add('PasarCancelado', 'Pedidos::pasar_a_Cancelado');
    $routes->add('PasarEntregado', 'Pedidos::pasar_a_Entregado');
    $routes->add('PasarFinalizado', 'Pedidos::pasar_a_Finalizado');
    $routes->add('TotalPedidos', 'Pedidos::totalPedidos');
    $routes->add('EditarPedidos', 'Pedidos::editarPedido');

    $routes->add('DetallePedido', 'Pedidos::detalle');
    $routes->add('HistorialPedidos', 'Pedidos::historial');

    $routes->add('GenerarPedidoMovil', 'GestionPedidosMovil::generarPedido');
    $routes->add('ConsultarPedidosUsuario', 'GestionPedidosMovil::getPedidos');
    $routes->add('DatosDetallePedido', 'GestionPedidosMovil::detallePedido');
    $routes->add('nombreEspecializacionVendedor', 'GestionPedidosMovil::getEspecializacionVendedor');
    $routes->add('FinalizarPedido', 'GestionPedidosMovil::estadoFinalizadoPedido');
    $routes->add('CalificarPublicacion', 'GestionPedidosMovil::calificarPublicacion');

    $routes->add('CantVentaPerfil', 'GestionPedidosMovil::ListarVentasPerfilMovil');
    $routes->add('CantPostPerfil', 'GestionPedidosMovil::PublicacionesPerfilMovil');
    $routes->add('PromedioPerfil', 'GestionPedidosMovil::PromedioPerfilMovil');

    $routes->add('GuardarMensajeChat', 'Chat::insertarMensaje');
    $routes->add('CargarMensajesChat', 'Chat::cargarMensajes');
    $routes->add('CargarMensajesChatMovil', 'Chat::cargarMensajesMovil');
});


/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
