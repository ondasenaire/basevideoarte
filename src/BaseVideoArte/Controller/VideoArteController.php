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
			//	echo 'filtra por abecedario con la letra '.$valor;
				
			
					$q =$app['db.orm.em'] -> createQueryBuilder();
       				$q ->select('persona', 'pais')
      				 ->from('BaseVideoArte\Entidades\Persona',' persona')
					 ->leftJoin('persona.pais', 'pais')
        			 ->where("SUBSTRING(persona.apellido, 1, 1) = '$valor'")
        			 ->orderBy('pais.pais', 'ASC')
					 ;		
					$consulta = $q->getQuery(); 					
					$resultado = $consulta->getResult();								
				
			}
			if ($filtro == 'pais' && $valor != null) {
			//	echo 'filtra por pais';
				$qb = $app['db.orm.em'] -> createQueryBuilder();
				$qb->select('persona', 'pais')
					->from('BaseVideoArte\Entidades\Persona', 'persona')
					->leftJoin('persona.pais', 'pais')
					->where("pais.pais = '$valor'")
					
					; 
				
				$consulta = $qb -> getQuery();
				$resultado = $consulta -> getResult();
				
				
				
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
		return $app['twig'] -> render('/personas.twig.html', array('lista_personas' => $resultado, 'pagina_actual'=>'personas'));
	}

	public function mostrarPersonaAction(Application $app, $persona) {
		$repoPersonas = $app['db.orm.em'] -> getRepository('BaseVideoArte\Entidades\Persona');
		$persona = $repoPersonas -> findOneById($persona);
		return $app['twig'] -> render('/persona.twig.html', array('persona' => $persona, 'pagina_actual'=>'personas'));
	}

	//----------------------------------------------------------------
	//OBRAS
	public function listarObrasAction(Application $app,$filtro,$valor) {
			
		if ($filtro != null) {
			echo 'hay filtro';
			if ($filtro == 'abc' && $valor != null) {
				echo ' por abecedario';
				$query = $app['db.orm.em']->createQuery("SELECT obra.titulo, obra.id, persona.id AS id_persona, persona.apellido, persona.nombre FROM
												BaseVideoArte\Entidades\Obra obra LEFT JOIN obra.artistas persona WHERE SUBSTRING(obra.titulo, 1, 1) LIKE 'a%'");
			$obras = $query->getResult();
			}
		}else{
			echo 'no hay filtro';
		
		
		}	
		//	$obras = '';
		//$repositorioObras = $app['db.orm.em'] -> getRepository('BaseVideoArte\Entidades\Obra');
		//$obras = $repositorioObras -> findAll();
		
		
		
		
		return $app['twig'] -> render('/obras.twig.html', array('lista_obras' => $obras, 'pagina_actual'=>'obras'));
	}

	public function mostrarObraAction(Application $app,$obra) {
		$repositorioObras = $app['db.orm.em'] -> getRepository('BaseVideoArte\Entidades\Obra');
		$obra = $repositorioObras -> findOneById($obra);
		return $app['twig'] -> render('/obra.twig.html', array('obra' => $obra, 'pagina_actual'=>'obras'));
	}

	//----------------------------------------------------------------
	//EVENTOS
	public function listarEventosAction(Application $app) {
		$consulta = $app['db.orm.em'] -> createQuery('SELECT e.id,e.nombre,e.anho, SUBSTRING(e.info,1,300) AS info  FROM BaseVideoArte\Entidades\Evento e');
		$eventos = $consulta -> getResult();
		return $app['twig'] -> render('/eventos.twig.html', array('eventos' => $eventos, 'pagina_actual'=>'eventos'));
	}

	public function mostrarEventoAction(Application $app, $evento) {
		$repoEventos = $app['db.orm.em'] -> getRepository('BaseVideoArte\Entidades\Evento');
		$evento = $repoEventos -> findOneById($evento);
		return $app['twig'] -> render('/evento.html.twig', array('evento' => $evento, 'pagina_actual'=>'eventos'));
	}

}
