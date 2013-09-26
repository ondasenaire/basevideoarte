<?php
namespace BaseVideoArte\Controller;
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
// src/BaseVideoArte/Controladores/VideoArteController.php
class VideoArteController {
	public function indexAction(Request $request, Application $app, $h) {
		//return $app['twig']->render('/inicio.html.twig', array());
		return new Response('<html><body>Hello ' . $h . '!</body></html>');
	}
	// ARTISTAS


	//OBRAS
	public function listarObrasAction(Application $app) {
		$repositorioObras = $app['db.orm.em'] -> getRepository('BaseVideoArte\Entidades\Obra');
		$obras = $repositorioObras -> findAll();

		//7$obras = $app['db.orm.em']->createQuery('SELECT o FROM Obra o JOIN o.artistas a');
		return $app['twig'] -> render('/obras.html.twig', array('lista_obras' => $obras));
	}

	public function mostrarObraAction(Application $app, $obra) {
		$repositorioObras = $app['db.orm.em'] -> getRepository('BaseVideoArte\Entidades\Obra');
		$obra = $repositorioObras -> findOneById($obra);
		return $app['twig'] -> render('/obra.html.twig', array('obra' => $obra));
	}

	//EVENTOS
	public function listarEventosAction(Application $app) {
		
		$repoEventos = $app['db.orm.em'] -> getRepository('BaseVideoArte\Entidades\Evento');
		$eventos = $repoEventos->findAll();
		return $app['twig'] -> render('/eventos.html.twig', array('eventos' => $eventos ));
	}

	public function mostrarEventoAction(Application $app, $evento) {
		$repoEventos = $app['db.orm.em'] -> getRepository('BaseVideoArte\Entidades\Evento');
		$evento = $repoEventos->findOneById($evento);
		
		return $app['twig'] -> render('/evento.html.twig', array('evento' => $evento));
	}

}
