<?php
// src/BaseVideoArte/Controladores/AdminController.php
namespace BaseVideoArte\Controller;
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class AdminController {
	public function indexAction( Application $app) {
		//return $app['twig']->render('/inicio.html.twig', array());
		return $app['twig'] -> render('/admin.twig.html');
	}
	
	public function listarPersonasAction(){}
	public function nuevaPersonaAction(){}
	public function eliminarPersonaAction(){}
	public function editarPersonasAction(){}
	

}
