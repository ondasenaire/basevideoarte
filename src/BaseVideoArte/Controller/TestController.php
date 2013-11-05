<?php
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


use BaseVideoArte\Util\Carga\CargadorDatos;


class TestController{
	
	public function jsonAction(Application $app){
		$a = new CargadorDatos();
		
		$a->cargar();
		$p = $a->getPaises();
		foreach ($p as $pais) {
			
			 echo '<br>';	
			 echo $pais->getPais();
		}
		echo '<br>';		
		//--
		$t = $a->getTipos();
		foreach ($t as $tipo) {
			 echo '<br>';	
			 echo $tipo->getTipo();
		}
		// print_r($t);	
		 echo '<br>';	
		$personas = $a->getPersonas();
		foreach ($personas as $persona) {
			 echo '<br>';	
			 $persona->verDatos();
		}	
		 echo '<br>';	
		
		$obras = $a->getObras();
		foreach ($obras as $obra) {
			 echo '<br>';	
			$obra->verDatos();
		}	
		 echo '<br>';	
		$formatos = $a->getFormatos();
		foreach ($formatos as $formato) {
			 echo '<br>';	
			 echo $formato->getFormato();
		}	 
		 echo '<br>';	
		$generos = $a->getGeneros();
		foreach ($generos as $genero) {
			 echo '<br>';	
			 echo $genero->getGenero();
		}		 
		//print_r($personas);	
		
		
		//$a->persistir($app);
		return new Response( " ");
	}
	
	
	public function colaboradorAction(Application $app, Request $request) {
		$p = new Persona('a','b','c','d','f','b',true);
		$o = new Obra('t','r','d','23');
		
		$p->addColaboracion($o);
		$o->addColaborador($p);
		$app['db.orm.em'] -> persist($p);
		$app['db.orm.em'] -> persist($o);
		$app['db.orm.em'] -> flush();
		
		
		$p = $app['db.orm.em']-> getRepository('BaseVideoArte\Entidades\Persona') -> findOneByNombre('a');
		
	}
	
	//----
	
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
	
	
	//---------
	
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
		$me = new MetadatoEvento('en ingles','nombre');
		$app['db.orm.em'] -> persist($m);
		$app['db.orm.em'] -> persist($mo);
		$app['db.orm.em'] -> persist($me);
		//$me = new MetadatoEvento();
		//$m->setCategoria('1');
		//$m->setTipo('2');
		//$m->setMetadato('dacdfg dfvsfvsft hsf gbt hhdda');
		
		$p = new Persona('carlos','mennon','asdgd','2003','www','m',true);
		
		$medioPer = new Medio('carlos.jpg',' ','imagen principal');
		$medioOb = new Medio('time.jpg','general ','imagen principal');
		$medioEv = new Medio('sampa.jpg',' ','imagen principal');
		

		//$p = new Persona('','','','','','',true);
		$obra1 = new Obra('eden','dewjb j ',' 2010','1.20');
		$obra2 = new Obra('time','fds  fvd  fdjb j ',' 2000','1.20');
		
		
		//obra1		
		$hd->addObra($obra1);
		$documental->addObra($obra1);
		$obra1->addFormato($hd);
		$obra1->addGenero($documental);
		
		$obra1->addMedio($medioOb);
		$medioOb->addObra($obra1);
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
	
		$p->addMedio($medioPer);
		$medioPer->addPersona($p);
		
		//evento
		
		$evento->addObra($obra1);
		$evento->addObra($obra2);
		$evento->addMetadato($me);
	
		$evento->addMedio($medioEv);
		$medioEv->addEvento($evento);
		$me->setEvento($evento);
		
		
		$app['db.orm.em'] -> persist($medioPer);
		$app['db.orm.em'] -> persist($medioEv);
		$app['db.orm.em'] -> persist($medioPer);
		
		$app['db.orm.em'] -> persist($evento);
		$app['db.orm.em'] -> persist($obra1);
		$app['db.orm.em'] -> persist($obra2);
		$app['db.orm.em'] -> persist($p);
		$app['db.orm.em'] -> flush();
		
		return new Response('hola');
	}

	//----
	
	public function recuperarMetadataAction(Application $app){
		$p = $app['db.orm.em'] ->find('BaseVideoArte\Entidades\Persona',5);
		$met = $p->getMetadatos();
		foreach ($met as $m) {
			$arr [] = $m->getMetadato();
		}
		
		echo print_r($arr);
		return new Response();
	}
	
	
}
