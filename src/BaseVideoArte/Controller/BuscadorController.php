<?php
namespace BaseVideoArte\Controller;
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

//formularios
use BaseVideoArte\Form\Buscador\BuscadorGeneralType;
use BaseVideoArte\Form\Buscador\BuscadorPersonasType;
use BaseVideoArte\Form\Buscador\BuscadorObrasType;

class BuscadorController {

	public function buscadoresAction(Application $app, Request $request) {

		//  FORM GENERAL
		$buscadorGeneral = new BuscadorGeneralType();
		$form_general = $app["form.factory"] -> create($buscadorGeneral);
		//  FORM PERSONAS
		$buscadorPersonas = new BuscadorPersonasType();
		$form_personas = $app["form.factory"] -> create($buscadorPersonas);
		//  FORM OBRAS
		$buscadorObras = new BuscadorObrasType();
		$form_obras = $app["form.factory"] -> create($buscadorObras);
		//  FORM AVANZADo

		// FORM EVENTOS

		//---------------

		$mensaje = '';
		$respuesta = array('mensaje'=>' ', 'resultado' => array());
		if ($request -> isMethod('POST')) {

			if ($request -> request -> has('buscador_general')) {
				//echo 'buscador general';
				$respuesta = $this -> busquedaGeneral($app);
				
			}

			if ($request -> request -> has('buscador_personas')) {
				//$respuesta['mensaje'] = 'hay una busqueda de personas que procesar';
			}

			if ($request -> request -> has('buscador_obras')) {
				//$respuesta ['mensaje'] = 'hay una busqueda de obras que procesar';
			}

		}

		return $app['twig'] -> render('/busqueda.twig.html', array('form_general' => $form_general -> createView(), 
																	'form_personas' => $form_personas -> createView(), 
																	'form_obras' => $form_obras -> createView(), 
																	'pagina_actual' => 'busqueda', 
																	'respuesta' => $respuesta) );

	}
//  CONSULTASSSSS

	public function busquedaGeneral(Application $app) {
		// $q_obras = $app['db.orm.em'] -> createQueryBuilder();
		// $q_obras -> select('obra') -> from('BaseVideoArte\Entidades\Obra', ' obra') -> where() -> orderBy('obra.titulo', 'ASC');
		// $consulta = $q -> getQuery();
		
		
		$query = $app['db.orm.em']->createQuery("SELECT obra.id, obra.titulo AS encabezado FROM BaseVideoArte\Entidades\Obra obra WHERE obra.titulo LIKE '%or%'");
		$obras = $query->getResult();
		

		
		return array('mensaje' => 'hay una busqueda general que procesar', 'resultado' => $obras);
	}

}
