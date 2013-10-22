<?php
// src/BaseVideoArte/Controladores/AdminController.php
namespace BaseVideoArte\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use BaseVideoArte\Entidades\Persona;
use BaseVideoArte\Form\Admin\PersonaType;

use BaseVideoArte\Entidades\MetadatoPersona;
use BaseVideoArte\Entidades\MetadatoEvento;
use BaseVideoArte\Entidades\MetadatoObra;

use BaseVideoArte\Form\Admin\MetadatoType;
use BaseVideoArte\Form\Admin\MultipleType;


use BaseVideoArte\Entidades\Obra;
use BaseVideoArte\Entidades\Genero;
use BaseVideoArte\Entidades\Formato;
use BaseVideoArte\Entidades\PalabraClave;
use BaseVideoArte\Entidades\Evento;
use BaseVideoArte\Entidades\Medio;

use BaseVideoArte\Util\Manejador\ManejadorPersonas;

class AdminController {
	public function indexAction(Application $app) {
		//return $app['twig']->render('/inicio.html.twig', array());

		return $app['twig'] -> render('/Admin/admin.twig.html');
	}

	public function listarPersonasAction() {
	}


	public function agregarObraAction (Application $app){
		$p = new Persona('jose','casa','ssss','2098','222www','s',true);
		$o = new Obra('limones','s','1123','23');
		$mp = new ManejadorPersonas($p);
		$mp->asociarObra($o);
		
		
		$app['db.orm.em']->persist($p);
		$app['db.orm.em']->persist($o);		
		$app['db.orm.em']->flush();		
		return new Response('asignada');
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
//$nombre,$apellido,$data,$inicio,$web,$sexo,$mostrar) 
				$nuevaPersona = new Persona($persona['nombre'], $persona['apellido'],$persona['data'], $persona['inicio'], $persona['web'],$persona['sexo'],true );
	
				//pais
				$nuevaPersona -> setPais($app['db.orm.em'] -> getRepository('BaseVideoArte\Entidades\Pais') -> findOneById($persona['pais']));
				//
				$nuevaPersona -> setTipo($app['db.orm.em'] -> getRepository('BaseVideoArte\Entidades\TipoDePersona') -> findOneById($persona['tipo']));
			
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
	
}
