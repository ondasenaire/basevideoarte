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

	public function recuperarMetadataAction(Application $app){
		$p = $app['db.orm.em'] ->find('BaseVideoArte\Entidades\Persona',5);
		$met = $p->getMetadatos();
		foreach ($met as $m) {
			$arr [] = $m->getMetadato();
		}
		
		echo print_r($arr);
		return new Response();
	}
	
	public function ingresarDatosAction(Application $app) {
	//$nombre,$apellido,$data,$inicio,$web,$sexo,$mostrar) 		
	
		$evento = new Evento('san pablo','2010','www','videos','sampa');
	
		$hd = new Formato('hd');
		$super8 = new Formato('super8');
		$app['db.orm.em'] -> persist($hd);
		$app['db.orm.em'] -> persist($super8);
		
		$experimental = new Genero('experimental');
		$documental = new Genero('documental');
		$app['db.orm.em'] -> persist($experimental);
		$app['db.orm.em'] -> persist($documental);
		
		
		$m = new MetadatoPersona('derian','nombre');
		$mo = new MetadatoObra('sertao','titulo');
		$app['db.orm.em'] -> persist($m);
		$app['db.orm.em'] -> persist($mo);
		//$me = new MetadatoEvento();
		//$m->setCategoria('1');
		//$m->setTipo('2');
		//$m->setMetadato('dacdfg dfvsfvsft hsf gbt hhdda');
		
		$p = new Persona('carlos','mennon','asdgd','2003','www','m',true);
		//$p = new Persona('','','','','','',true);
		$obra1 = new Obra('eden','dewjb j ',' 2010','1.20');
		$obra2 = new Obra('time','fds  fvd  fdjb j ',' 2000','1.20');
		
		
		//obra1		
		$hd->addObra($obra1);
		$documental->addObra($obra1);
		$obra1->addFormato($hd);
		$obra1->addGenero($documental);
		//obra 2
		
		$experimental->addObra($obra2);
		$super8->addObra($obra2);
		$obra2->addFormato($super8);
		$obra2->addGenero($experimental);
		$obra2->addMetadato($mo);
		$mo->setObra($obra2);
		
		
		
		$p->addMetadato($m);
		$p->addObra($obra1);
		$p->addObra($obra2);
		$m->setPersona($p);
		
		//evento
		
		$evento->addObra($obra1);
		$evento->addObra($obra2);
		
		
		
		
		
		$app['db.orm.em'] -> persist($evento);
		$app['db.orm.em'] -> persist($obra1);
		$app['db.orm.em'] -> persist($obra2);
		$app['db.orm.em'] -> persist($p);
		$app['db.orm.em'] -> flush();
		
		return new Response('hola');
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
		$mt -> setOpcionesTipo($m -> getTipos('persona'));
		$multiple = new MultipleType();
		$multiple -> setOpciones($mt);
		$form = $app["form.factory"] -> create($multiple, $coll);

		if ($request -> isMethod('POST')) {
			$form -> bind($request);

			if ($form -> isValid()) {
				$coll = $form -> getData();

				//echo $coll['metadatos']['meta2'] -> getMetadato();
				print_r($coll);

				foreach ( $coll['metadatos'] as $meta) {
				//	echo ' '.$meta->getMetadato();
				}
			}
		}

		return $app['twig'] -> render('/Admin/pruebas.twig.html', array('meta' => $m, 'form' => $form -> createView()));

	}

}
