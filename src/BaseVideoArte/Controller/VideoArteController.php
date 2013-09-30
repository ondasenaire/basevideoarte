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
	//----------------------------------------------------------------
	// PERSONAS
	public function listarPersonasAction(Application $app){
		$qb = $app['db.orm.em']->createQueryBuilder();
		
		
		$qb->select('p.id','p.nombre','p.apellido')
		   ->from('BaseVideoArte\Entidades\Persona','p');
		   
		 $consulta = $qb->getQuery();
		 $personas = $consulta->getResult();
		 
		return $app['twig'] -> render('/personas.html.twig', array('lista_personas' => $personas));
	} 

	public function mostrarPersonaAction(Application $app, $persona){
		$repoPersonas = $app['db.orm.em'] -> getRepository('BaseVideoArte\Entidades\Persona');
		$persona = $repoPersonas->findOneById($persona);
		return $app['twig'] -> render('/persona.html.twig', array('persona' => $persona));
	} 
	//----------------------------------------------------------------
	//OBRAS
	public function listarObrasAction(Application $app) {
		$repositorioObras = $app['db.orm.em'] -> getRepository('BaseVideoArte\Entidades\Obra');					 
	//	$query = $app['db.orm.em']->createQuery('SELECT partial o.{id, titulo, anho}, partial a.{id, nombre, apellido} FROM BaseVideoArte\Entidades\Obra o JOIN o.artistas a ');
	//	$obras = $query->getResult(); 
		$obras = $repositorioObras->findAll();
		return $app['twig'] -> render('/obras.html.twig', array('lista_obras' => $obras));
	}

	public function mostrarObraAction(Application $app, $obra) {
		$repositorioObras = $app['db.orm.em'] -> getRepository('BaseVideoArte\Entidades\Obra');
		$obra = $repositorioObras -> findOneById($obra);
		return $app['twig'] -> render('/obra.html.twig', array('obra' => $obra));
	}

	//----------------------------------------------------------------
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
