<?php
// src/BaseVideoArte/Controladores/AdminController.php
namespace BaseVideoArte\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use BaseVideoArte\Entidades\Persona;
use BaseVideoArte\Form\Admin\PersonaType;

use BaseVideoArte\Entidades\Metadato;
use BaseVideoArte\Form\Admin\MetadatoType;

use BaseVideoArte\Form\Admin\MultipleType;

class AdminController {
	public function indexAction(Application $app) {
		//return $app['twig']->render('/inicio.html.twig', array());

		return $app['twig'] -> render('/Admin/admin.twig.html');
	}

	public function listarPersonasAction() {
	}

	public function nuevaPersonaAction(Application $app, Request $request) {

		//	$persona = new Persona();
		/*
		 * ESTO ES POCO PRACTICO PERO .... con Silex esta complicado
		 */
		$persona = array('nombre' => 'introduzca los nombres', 'apellido' => 'apellido de la persona', 'pais' => '', 'data' => '', 'inicio' => '', 'sexo' => '', 'web' => '', 'tipo' => '', 'mostrar' => true);

		/* Campos 'entity' */

		$consulta = $app['db.orm.em'] -> createQuery('SELECT p FROM BaseVideoArte\Entidades\Pais p');
		$paises = $consulta -> getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

		$con = $app['db.orm.em'] -> createQuery('SELECT t FROM BaseVideoArte\Entidades\TipoDePersona t');
		$tipos = $con -> getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

		foreach ($paises as $pais) {
			$p[$pais['id']] = $pais['pais'];
		}

		foreach ($tipos as $tipo) {
			$t[$tipo['id']] = $tipo['tipo'];
		}

		$fp = new PersonaType();
		$fp -> setOpcionesTipo($t);
		$fp -> setOpcionesPais($p);

		$form = $app["form.factory"] -> create($fp, $persona);

		//...PROCESAR PETICION
		if ($request -> isMethod('POST')) {

			$form -> bind($request);

			if ($form -> isValid()) {
				$persona = $form -> getData();
				/***/

				$nuevaPersona = new Persona();
				$nuevaPersona -> setNombre($persona['nombre']);
				$nuevaPersona -> setApellido($persona['apellido']);
				$nuevaPersona -> setData($persona['data']);
				$nuevaPersona -> setInicio($persona['inicio']);
				$nuevaPersona -> setSexo($persona['sexo']);
				$nuevaPersona -> setWeb($persona['web']);
				//pais
				$nuevaPersona -> setPais($app['db.orm.em'] -> getRepository('BaseVideoArte\Entidades\Pais') -> findOneById($persona['pais']));
				//

				//mañana hacer esto
				$nuevaPersona -> setTipo($app['db.orm.em'] -> getRepository('BaseVideoArte\Entidades\TipoDePersona') -> findOneById($persona['tipo']));
				$nuevaPersona -> setMostrar($persona['mostrar']);

				//echo  $nuevaPersona->getPais()->getPais();
				$app['db.orm.em'] -> persist($nuevaPersona);
				$app['db.orm.em'] -> flush();

			} else {
				echo 'No Valido ';
			}
		}

		return $app['twig'] -> render('/Admin/nueva_persona.twig.html', array('form' => $form -> createView()));
	}

	public function eliminarPersonaAction() {
	}

	public function editarPersonasAction() {
	}

	public function metadatoAction(Application $app, Request $request) {

		$coll = array('metadatos' => array(), 'titulo' => 'gf');

		$m = new Metadato();
		//$m2 = new Metadato();
		//$m->setMetadato(" estra");
		//$m2->setMetadato(" estra2");
		//$coll['metadatos'][] = $m;
		//$coll['metadatos'][] = $m2;

		$mt = new MetadatoType();
		$mt -> setOpcionesTipo($m -> getTipos());
		$multiple = new MultipleType();
		$multiple -> setOpciones($mt);
		$form = $app["form.factory"] -> create($multiple, $coll);

		if ($request -> isMethod('POST')) {
			$form -> bind($request);

			if ($form -> isValid()) {
				$coll = $form -> getData();

				//echo $coll['metadatos']['meta2'] -> getMetadato();
				//print_r($coll);

				foreach ( $coll['metadatos'] as $meta) {
					echo ' '.$meta->getMetadato();
				}
			}
		}

		return $app['twig'] -> render('/Admin/pruebas.twig.html', array('meta' => $m, 'form' => $form -> createView()));

	}

}
