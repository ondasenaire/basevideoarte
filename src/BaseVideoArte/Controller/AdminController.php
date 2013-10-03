<?php
// src/BaseVideoArte/Controladores/AdminController.php
namespace BaseVideoArte\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use BaseVideoArte\Entidades\Persona;
use BaseVideoArte\Form\Admin\PersonaType;




class AdminController {
	public function indexAction(Application $app) {
		//return $app['twig']->render('/inicio.html.twig', array());

		return $app['twig'] -> render('/Admin/admin.twig.html');
	}

	public function listarPersonasAction() {
	}

	public function nuevaPersonaAction(Application $app,Request $request) {

	//	$persona = new Persona();
		/*
		 * ESTO ES POCO PRACTICO PERO .... con Silex esta complicado
		 */	 
		$persona = array (
			'nombre' => 'introduzca los nombres',
			'apellido' => 'apellido de la persona',
			'pais' => '',
			'data' => '',
			'inicio' => '',
			'sexo' => '',
			'web' => ''		
		); 		
		
		$consulta = $app['db.orm.em'] -> createQuery('SELECT p FROM BaseVideoArte\Entidades\Pais p');
		$paises = $consulta -> getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
		
		foreach ($paises as $pais) {
			$p[$pais['id']] = $pais['pais'];
		}
		
		//print_r($p) ;
		//$a = array('1' => 'jaja' );		
		
		$fp = new PersonaType();
		$fp->setOpcionesPais($p);
		$form = $app["form.factory"] -> create($fp,$persona);
		
	//	$form-> add('pais', 'choice', array('choices' => $p, 'required' => false, ));

		
		//...PROCESAR PETICION
		if($request->isMethod('POST') ){
					
			$form->bind($request);
			
			
			
			
			if($form->isValid( )){
				echo 'SOY VALIDO';
				$d = $form->getData();
				var_dump($d);
			}else{
				echo 'No Valido ';
			}
		}
		

		return $app['twig'] -> render('/Admin/nueva_persona.twig.html', array('form' => $form -> createView()));
	}

	public function eliminarPersonaAction() {
	}

	public function editarPersonasAction() {
	}

}
