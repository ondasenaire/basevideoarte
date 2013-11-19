<?php
namespace BaseVideoArte\Controller;
use Silex\Application;
//utilidades
use BaseVideoArte\Util\Opciones\OpcionesForm;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

//formularios
use BaseVideoArte\Form\Buscador\BuscadorGeneralType;
use BaseVideoArte\Form\Buscador\BuscadorPersonasType;
use BaseVideoArte\Form\Buscador\BuscadorObrasType;



class BuscadorController {

	public function buscadoresAction(Application $app, Request $request) {
		// facilitador de opciones	
		$opciones = new OpcionesForm();
		
		$receptor_general = array('consulta'); // string recibido
		$receptor_personas = array('nombre' => '', 'pais'=>'','tipo'=>array());
		$receptor_obras = array('titulo'=> '', 'formato'=> '','palabras'=> array() );
		/*
		 * -Instancio el formulario
		 * -cargo opciones necesarias
		 * -invoco al builder
		 */

		//  FORM GENERAL
		$buscadorGeneral = new BuscadorGeneralType();
		$form_general = $app["form.factory"] -> create($buscadorGeneral,$receptor_general);
		//  FORM PERSONAS
		$buscadorPersonas = new BuscadorPersonasType();
	
		$buscadorPersonas->setOpcionesPais($opciones->getOpcionesPais($app));
		$buscadorPersonas->setOpcionesTipo($opciones->getOpcionesTipo($app));
		$form_personas = $app["form.factory"] -> create($buscadorPersonas,$receptor_personas);
		
		//  FORM OBRAS
		$buscadorObras = new BuscadorObrasType();
		
		$buscadorObras->setOpcionesFormato($opciones->getOpcionesFormato($app));
		$buscadorObras->setOpcionesPalabra($opciones->getOpcionesPalabraClave($app));
		$form_obras = $app["form.factory"] -> create($buscadorObras);
		//  FORM AVANZADo

		// FORM EVENTOS

		//---------------

		$mensaje = '';
		$respuesta = array('mensaje'=>' ', 'resultado' => array());
		if ($request -> isMethod('POST')) {

			if ($request -> request -> has('buscador_general')) {
				//echo 'buscador general';
				$form_general->bind($request);
				if ($form_general->isValid() ){
					$consulta = $form_general->getData();
					$respuesta = $this -> busquedaGeneral($app, $consulta['consulta']);
				}		
				
			}
// buscador personas
			if ($request -> request -> has('buscador_personas')) {
				//echo 'buscador personASA';		
				$form_personas->bind($request);
				if ($form_personas->isValid() ){
					$consulta = $form_personas->getData();
					//print_r($consulta);
					//echo 'el form va';
					$respuesta = $this -> busquedaPersonas($app, $consulta['nombre'], $consulta['pais'], $consulta['tipo']);
				}else{
					//echo 'el form no va';
				}	
							
			}
// buscador obras
			if ($request -> request -> has('buscador_obras')) {
				//echo 'buscador obras';
				$form_obras->bind($request);
				if ($form_obras->isValid() ){
					$consulta = $form_obras->getData();
					$respuesta = $this -> busquedaObras($app, $consulta['titulo'],$consulta['formato'],$consulta['palabras']);
				}
				
			}

		}

		return $app['twig'] -> render('/busqueda.twig.html', array('form_general' => $form_general -> createView(), 
																	'form_personas' => $form_personas -> createView(), 
																	'form_obras' => $form_obras -> createView(), 
																	'pagina_actual' => 'busqueda', 
																	'respuesta' => $respuesta) );

	}
	/**
 	* 
 	*/
//  CONSULTASSSSS-------------------------------------------______________________________________

	public function busquedaGeneral(Application $app, $criterio) {
		//obras
		//('persona',{persona: persona.id})
		$lp = "persona/";
		$lo = "obras/";
		
		$query = $app['db.orm.em']->createQuery("SELECT CONCAT('$lo',obra.id) AS link, obra.titulo AS encabezado FROM BaseVideoArte\Entidades\Obra obra WHERE obra.titulo LIKE '%$criterio%'");
		$obras = $query->getResult();
		//personas
		$query = $app['db.orm.em']->createQuery("SELECT  CONCAT('$lp',persona.id) AS link, CONCAT(persona.apellido, CONCAT(', ',persona.nombre) ) AS encabezado 
		FROM BaseVideoArte\Entidades\Persona persona WHERE (persona.apellido LIKE '%$criterio%' OR persona.nombre LIKE '%$criterio%') ");
		$personas = $query->getResult();
		// mezclo arrays
		$resultado_general = array_merge($obras,$personas);
		
		return array('mensaje' => 'hay una busqueda general que procesar', 'resultado' => $resultado_general);
	}
	
	// busqueda personas
	/**
	 *   BUSCADOR PERSONAS
	 */
	public function busquedaPersonas(Application $app, $nombre,$pais,$tipos ){
		/*
		 * -El array $condiciones contiene las distintos criterios de consulta marcador por el usuario
		 * - El array $leftJoins contiene los LEFT JOIN necesarios
		 */	
		$condiciones = array();
		$leftJoin = array();
		$mensaje = '';	
		
		if( !empty($nombre)){
			$mensaje = $mensaje. ' hay nombre';
			$condiciones [] =  " (persona.apellido LIKE '%$nombre%' OR persona.nombre LIKE '%$nombre%')";			
		}		
		if( !empty($pais)){
			$mensaje = $mensaje. ',  hay pais';
			$condiciones []= " pais.id= $pais ";
			$leftJoin[] = " persona.pais pais";
		}
		
		if( !empty($tipos) ){
			
			$mensaje = $mensaje. ',  hay tipo';
			// armo condicion de acuerdo a la cantidad de tipos
			$condicion = "";
			foreach($tipos as $indice => $tipo){
					if( $indice != 0){
						//ver atentamente este caso, multiples tipos
						$condicion = $condicion." AND ";	
					}
						
						$condicion = $condicion." persona.id IN (SELECT p$indice.id FROM BaseVideoArte\Entidades\Persona p$indice JOIN p$indice.tipos tipos$indice WHERE tipos$indice.id = $tipo)";
					
				//echo $tipo;
			} 
		//	$condicion = $condicion.") ";
			
			//"SELECT persona.apellido FROM BaseVideoArte\Entidades\Persona persona WHERE  persona.id IN (SELECT p.id FROM BaseVideoArte\Entidades\Persona p JOIN p.tipos tipos 
			//WHERE tipos.id = 1) AND persona.id IN (SELECT p2.id FROM BaseVideoArte\Entidades\Persona p2 JOIN p2.tipos tipos2 WHERE tipos2.id = 2)";
			$condiciones[]= $condicion;
			$leftJoin[] = " persona.tipos tipos";
		}
				

// PROCESA LA CONSULTA
 		if(  empty($condiciones) ){
			$personas = null;
			$mensaje = 'No ha ingresado ningún criterio de búsqueda';
		}else{
			
			$andWhere = '';
			foreach ($condiciones as $indice => $condicion) {
				if	($indice != 0){
					$andWhere = $andWhere.' AND '.$condicion;
				}else{
					$andWhere = $andWhere.' '.$condicion;
				}
								
			}	
			
			$consulta = "SELECT DISTINCT CONCAT('persona/',persona.id) AS link, CONCAT(persona.apellido, CONCAT(', ',persona.nombre) ) AS encabezado FROM BaseVideoArte\Entidades\Persona persona 
						LEFT JOIN persona.pais pais LEFT JOIN persona.tipos tipos WHERE $andWhere";
			$q =  $app['db.orm.em']->createQuery($consulta);
			$personas = $q->getResult();
			$mensaje = $consulta;
		}
		
		return array('mensaje' => $mensaje, 'resultado' => $personas);
		
	}
	
	// busqueda obras
	
	public function busquedaObras(Application $app, $titulo,$formato,$palabras){
		
		$palabras = implode(",", $palabras );
		
		//print_r($tipo);
		
		$mensaje = "titulo: $titulo  formato: $formato palabras: $palabras";		
		return array('mensaje' => $mensaje, 'resultado' => '--');
	}

}
