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
		
		$letra_activa = '';
		$mensajes = array();
		
		if ($filtro != null) {
			if ($filtro == 'abc' && $valor != null) {
			//	echo 'filtra por abecedario con la letra '.$valor;
				
			
					$q =$app['db.orm.em'] -> createQueryBuilder();
       				$q ->select('persona', 'pais')
      				 ->from('BaseVideoArte\Entidades\Persona',' persona')
					 ->leftJoin('persona.pais', 'pais')
        			 ->where("SUBSTRING(persona.apellido, 1, 1) = '$valor'")
					 ->andWhere('persona.mostrar = true')
        			->orderBy('pais.pais, persona.apellido', 'ASC')
					 ;		
					$consulta = $q->getQuery(); 					
					$resultado = $consulta->getResult();
					$letra_activa = $valor;								
				
			}
			if ($filtro == 'pais' && $valor != null) {
			//	echo 'filtra por pais';
				$qb = $app['db.orm.em'] -> createQueryBuilder();
				$qb->select('persona', 'pais')
					->from('BaseVideoArte\Entidades\Persona', 'persona')
					->leftJoin('persona.pais', 'pais')
					->where("pais.pais = '$valor'")
					->andWhere('persona.mostrar = true')
					->orderBy( 'persona.apellido', 'ASC')
					; 
				
				$consulta = $qb -> getQuery();
				$resultado = $consulta -> getResult();
				
			}

		}else{
				//personas sin aplicar filtros		
				$qb = $app['db.orm.em'] -> createQueryBuilder();
				$qb->select('persona', 'pais')
					->from('BaseVideoArte\Entidades\Persona', 'persona')
					->leftJoin('persona.pais', 'pais')
					->where('persona.mostrar = true')
					->orderBy('pais.pais, persona.apellido', 'ASC')
					//->orderBy('pais.pais', 'ASC')
					; 
				// $qb -> select('p.id', 'p.nombre', 'p.apellido','c')
				 // ->from('BaseVideoArte\Entidades\Persona', 'p')
				 // ->leftJoin('p.pais','c');
				$consulta = $qb -> getQuery();
				$resultado = $consulta -> getResult();
				$letra_activa = 'todas';			
		}
	
	
		if( count($resultado) === 0 ){
			$mensajes [] = 'No existen personas para el criterio especificado';
		}
		//$app->redirect('/here', 301)
		//	echo $filtro;
		//echo $valor;
		return $app['twig'] -> render('/personas.twig.html', array(
				 'lista_personas' => $resultado,
				 'pagina_actual'=>'personas',
				 'letra_activa'=>$letra_activa,
				 'mensajes' => $mensajes
				 ));
	}

	public function mostrarPersonaAction(Application $app, $persona) {
		
		$mensajes = array(); // mensajes de error y demas
		$repoPersonas = $app['db.orm.em'] -> getRepository('BaseVideoArte\Entidades\Persona');
		$persona = $repoPersonas -> findOneById($persona);
		
		if ($persona === null){
			$mensajes [] = 'No existe la persona buscada';
		}else{
			//ordenamos las obras cronologicamente
			$persona->ordenarObras();
		}
			
			
		return $app['twig'] -> render('/persona.twig.html', array('persona' => $persona, 'pagina_actual'=>'personas', 'mensajes' => $mensajes));
	}

	//----------------------------------------------------------------
	//OBRAS
	public function listarObrasAction(Application $app,$filtro,$valor) {
		$letra_activa = '';	
		$mensajes = array();
		if ($filtro != null) {
			//echo 'hay filtro';
			if ($filtro == 'abc' && $valor != null) {
					if( $valor == '*' ){
						$abc = "'A','B','C','D','E','F','G','H','I','J','K','L','M','N','Ñ','O','P','Q','R','S','T','U','V','W','X','Y','Z'";
						$query = $app['db.orm.em']->createQuery("SELECT obra.titulo, obra.id, persona.id AS id_persona, persona.apellido, persona.nombre FROM
												BaseVideoArte\Entidades\Obra obra LEFT JOIN obra.artistas persona WHERE SUBSTRING(obra.titulo, 1, 1) NOT IN ($abc)");
						$obras = $query->getResult();
						
						$letra_activa = '*';
				//		echo 'buscar aquellas obras que NO comienzan con letra';
					}else{
					//	echo 'buscar aquellas obras que SI comienzan con letra';
						$query = $app['db.orm.em']->createQuery("SELECT obra.titulo, obra.id, persona.id AS id_persona, persona.apellido, persona.nombre FROM
												BaseVideoArte\Entidades\Obra obra LEFT JOIN obra.artistas persona WHERE SUBSTRING(obra.titulo, 1, 1) LIKE '$valor%'");
						$obras = $query->getResult();
						$letra_activa = $valor;
						//echo $valor;
					}	
					
				//echo ' por abecedario';			
			}
		}else{
			echo 'no hay filtro';		
		}	
		
		
		if( count($obras) === 0){
			$mensajes [] = 'No existen obras para el criterio especificado';
		}
		
		return $app['twig'] -> render('/obras.twig.html', array(
					'lista_obras' => $obras,
					'pagina_actual'=>'obras',
					'letra_activa'=>$letra_activa,
					'mensajes' => $mensajes
					));
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
