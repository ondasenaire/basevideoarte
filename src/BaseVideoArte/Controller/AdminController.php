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

	public function nuevaPersonaAction(Application $app) {

		$persona = new Persona();
		$form = $app["form.factory"] -> create(new PersonaType());

		$consulta = $app['db.orm.em'] -> createQuery('SELECT p FROM BaseVideoArte\Entidades\Pais p');
		$paises = $consulta -> getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
		foreach ($paises as $pais) {
			//echo $pais['pais'] . ' '.$pais['id']. '<br>';
			$p[$pais['id']] = $pais['pais'];
		}

		
		$form -> add('pais', 'choice', array('choices' => $p, 'required' => false, ));

		return $app['twig'] -> render('/Admin/nueva_persona.twig.html', array('form' => $form -> createView()));
	}

	public function eliminarPersonaAction() {
	}

	public function editarPersonasAction() {
	}

}
