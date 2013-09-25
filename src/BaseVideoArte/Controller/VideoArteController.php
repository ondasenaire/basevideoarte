<?php
namespace BaseVideoArte\Controller;
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
// src/BaseVideoArte/Controladores/VideoArteController.php
class VideoArteController
{
    public function indexAction(Request $request, Application $app, $h)
    {
        //return $app['twig']->render('/inicio.html.twig', array());
        return new Response('<html><body>Hello '.$h.'!</body></html>');
    }
}