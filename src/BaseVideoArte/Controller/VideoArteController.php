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
	public function listarPersonasAction(Application $app, $filtro, $valor) {

		if ($filtro != null) {
			if ($filtro == 'abc' && $valor != null) {
				echo 'filtra por abecedario con la letra '.$valor;
				
			
					$q =$app['db.orm.em'] -> createQueryBuilder();
       				$q ->select('persona', 'pais')
      				 ->from('BaseVideoArte\Entidades\Persona',' persona')
					 ->leftJoin('persona.pais', 'pais')
        			 ->where("SUBSTRING(persona.apellido, 1, 1) = '$valor'");		
					$consulta = $q->getQuery(); 					
					$resultado = $consulta->getResult();								
				
			}
			if ($filtro == 'pais' && $valor != null) {
				echo 'filtra por pais';
			}

		}else{
				$qb = $app['db.orm.em'] -> createQueryBuilder();
				$qb->select('persona', 'pais')
					->from('BaseVideoArte\Entidades\Persona', 'persona')
					->leftJoin('persona.pais', 'pais')
					->orderBy('pais.pais', 'ASC')
					; 
				// $qb -> select('p.id', 'p.nombre', 'p.apellido','c')
				 // ->from('BaseVideoArte\Entidades\Persona', 'p')
				 // ->leftJoin('p.pais','c');
				$consulta = $qb -> getQuery();
				$resultado = $consulta -> getResult();
			
			
		

			
		}
	
	

	//	echo $filtro;
		//echo $valor;
		return $app['twig'] -> render('/personas.twig.html', array('lista_personas' => $resultado));
	}

	public function mostrarPersonaAction(Application $app, $persona) {
		$repoPersonas = $app['db.orm.em'] -> getRepository('BaseVideoArte\Entidades\Persona');
		$persona = $repoPersonas -> findOneById($persona);
		return $app['twig'] -> render('/persona.twig.html', array('persona' => $persona));
	}

	//----------------------------------------------------------------
	//OBRAS
	public function listarObrasAction(Application $app) {
		$repositorioObras = $app['db.orm.em'] -> getRepository('BaseVideoArte\Entidades\Obra');
		$obras = $repositorioObras -> findAll();
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
		$consulta = $app['db.orm.em'] -> createQuery('SELECT e.id,e.nombre,e.anho, SUBSTRING(e.info,1,300) AS info  FROM BaseVideoArte\Entidades\Evento e');
		$eventos = $consulta -> getResult();
		return $app['twig'] -> render('/eventos.twig.html', array('eventos' => $eventos));
	}

	public function mostrarEventoAction(Application $app, $evento) {
		$repoEventos = $app['db.orm.em'] -> getRepository('BaseVideoArte\Entidades\Evento');
		$evento = $repoEventos -> findOneById($evento);
		return $app['twig'] -> render('/evento.html.twig', array('evento' => $evento));
	}

}
