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

$app->get('/personas',    'BaseVideoArte\Controller\VideoArteController::listarPersonasAction')->bind('personas');
$app->get('/persona/{persona}',    'BaseVideoArte\Controller\VideoArteController::mostrarPersonaAction')->bind('persona');

//$app->get('/hola/{h}', 'BaseVideoArte\Controller\VideoArteController::indexAction')->bind('hola');

$app->get('/obras',    'BaseVideoArte\Controller\VideoArteController::listarObrasAction')->bind('obras');
$app->get('/obras/{obra}',    'BaseVideoArte\Controller\VideoArteController::mostrarObraAction')->bind('obra');

$app->get('/eventos','BaseVideoArte\Controller\VideoArteController::listarEventosAction')->bind('eventos');
$app->get('/eventos/{evento}','BaseVideoArte\Controller\VideoArteController::mostrarEventoAction')->bind('evento');
// $app->get('/hola', 'BaseVideoArte\Controller\VideoArteController::indexAction')->bind('hola');



//---
$app->get('/artistas/{id}', function ($id) use ($app) {
	$repositorioArtistas = $app['db.orm.em']->getRepository('BaseVideoArte\Entidades\Artista');
	$artista = $repositorioArtistas->findOneById($id);
    return $app['twig']->render('/artista.html.twig', array('artista'=> $artista));
	
})
->bind('artista')
;

//BUSCADOR
$app->get('/busqueda', function () use ($app) {
    return $app['twig']->render('/busqueda.html.twig', array());
})
->bind('busqueda')
;

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
