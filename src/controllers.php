<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

$app->get('/', function () use ($app) {
    return $app['twig']->render('/inicio.html.twig', array());
})
->bind('inicio')
;

/*
 * RUTAS
 */
// PERSONAS
//$app->get('/personas',    'BaseVideoArte\Controller\VideoArteController::listarPersonasAction')->bind('personas');

$app->get('/personas/{filtro}/{valor}',    'BaseVideoArte\Controller\VideoArteController::listarPersonasAction')
	->bind('personas')
	->value('filtro',null)
	->value('valor',null)
	->assert('filtro','[a-z]+')
	->assert('valor','[ñ a-z]+');
$app->get('/persona/{persona}',    'BaseVideoArte\Controller\VideoArteController::mostrarPersonaAction')
	->bind('persona')
	->assert('persona','\d+');
// OBRAS
$app->get('/obras',    'BaseVideoArte\Controller\VideoArteController::listarObrasAction')->bind('obras');
$app->get('/obras/{obra}',    'BaseVideoArte\Controller\VideoArteController::mostrarObraAction')->bind('obra');
// EVENTOS
$app->get('/eventos','BaseVideoArte\Controller\VideoArteController::listarEventosAction')->bind('eventos');
$app->get('/eventos/{evento}','BaseVideoArte\Controller\VideoArteController::mostrarEventoAction')->bind('evento');

//--------------------------------------------------------
// BACK-END TEMPORAL, SIN SECURITY

$app->get('/admin', 'BaseVideoArte\Controller\AdminController::indexAction')->bind('admin');
$app->get('/admin/personas', 'BaseVideoArte\Controller\AdminController::editarPersonasAction')->bind('admin_personas');
$app->match('/admin/nueva_persona', 'BaseVideoArte\Controller\AdminController::nuevaPersonaAction')->bind('admin_nueva_persona');
$app->match('/admin/pruebas', 'BaseVideoArte\Controller\AdminController::metadatoAction')->bind('pruebas');
$app->match('/admin/reset', 'BaseVideoArte\Controller\AdminController::ingresarDatosAction')->bind('reset');
$app->match('/admin/pruebas_get_metadatos', 'BaseVideoArte\Controller\AdminController::recuperarMetadataAction')->bind('get_metadatos');
//BUSCADOR
$app->get('/busqueda', function () use ($app) {
    return $app['twig']->render('/busqueda.html.twig', array());
})
->bind('busqueda')
;
//---------------------------------------------------------------------

$app->get('/admin/cargar', 'BaseVideoArte\Controller\CargaDatosController::cargarDatosAction')->bind('cargar_datos');
$app->get('/admin/colab', 'BaseVideoArte\Controller\AdminController::colaboradorAction')->bind('colab');
//---------------------------------------------------------------------
//contacto y "sobre el proyecto"
$app->get('/contacto', function () use ($app) {
    return $app['twig']->render('/contacto.html.twig', array());
})
->bind('contacto')
;

$app->get('/proyecto', function () use ($app) {
    return $app['twig']->render('/proyecto.html.twig', array());
})
->bind('proyecto')
;
//ERROR
$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    $page = 404 == $code ? '404.html' : '500.html';

    return new Response($app['twig']->render($page, array('code' => $code)), $code);
});
