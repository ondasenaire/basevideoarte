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

//OBRAS

$app->get('/obras', function () use ($app) {
    return $app['twig']->render('/obras.html.twig', array());
})
->bind('obras')
;

//---
$app->get('/obras/{id}', function ($id) use ($app) {
    return $app['twig']->render('/obra.html.twig', array('id'=> $id));
})
->bind('obra')
;


//ARTISTAS

$app->get('/artistas', function () use ($app) {
    return $app['twig']->render('/artistas.html.twig', array());
})
->bind('artistas')
;

//---
$app->get('/artistas/{id}', function ($id) use ($app) {
    return $app['twig']->render('/artista.html.twig', array('id'=> $id));
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
