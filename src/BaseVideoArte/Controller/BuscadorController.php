<?php
namespace BaseVideoArte\Controller;
use Silex\Application;
//utilidades
use BaseVideoArte\Util\Opciones\OpcionesForm;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;

//formularios
use BaseVideoArte\Form\Buscador\BuscadorGeneralType;
use BaseVideoArte\Form\Buscador\BuscadorPersonasType;
use BaseVideoArte\Form\Buscador\BuscadorObrasType;



class BuscadorController {

	public function buscadoresAction(Application $app, Request $request ) {
		$huboConsulta = false; // boolean para determinar si mostrar o no los resultadus	
			
		// facilitador de opciones	
		$opciones = new OpcionesForm();
		
		$receptor_general = array('consulta'); // string recibido
		$receptor_personas = array('nombre' => '','sexo'=>'', 'pais'=>'','tipo'=>array());
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

		// //---------------
		
			 $mensaje = '';
			 $respuesta = array('mensaje'=>'', 'resultado' => array());	
		
		
		
		if ($request -> isMethod('GET')) {
			
			//si hubo algun tipo de consulta mediante formulario,  la variable $huboConsulta se vuelve true
			$consultaGET = $request->query; // consulta del url
			
			
			
			//echo 'HOLA';
			if ($consultaGET -> has('buscador_general')) {
				//echo 'buscador general';
				$huboConsulta = true;
				$form_general->bind($request);
				if ($form_general->isValid() ){
					$consulta = $form_general->getData();
					$respuesta = $this -> busquedaGeneral($app, $consulta['consulta']);
					$form_general = $app["form.factory"] -> create($buscadorGeneral,$receptor_general);
				
				}		
				
			}
// buscador personas
			if ($consultaGET -> has('buscador_personas')) {
				//echo 'buscador personASA';	
				$huboConsulta = true;	
				$form_personas->bind($request);
				if ($form_personas->isValid() ){
					$consulta = $form_personas->getData();
					//print_r($consulta);
					//echo 'el form va';
					$respuesta = $this -> busquedaPersonas($app, $consulta['nombre'],$consulta['sexo'] ,$consulta['pais'], $consulta['tipo']);
				}else{
					//echo 'el form no va';
				}	
							
			}
// buscador obras
			if ($consultaGET-> has('buscador_obras')) {
				//echo 'buscador obras';
				$huboConsulta = true;
				$form_obras->bind($request);
				if ($form_obras->isValid() ){
					$consulta = $form_obras->getData();
					$respuesta = $this -> busquedaObras($app, $consulta['titulo'],$consulta['formato'],$consulta['palabras']);
				}
				
			}

		}

		//mensaje
		/*
		 *  aqui se edita el mensaje que se muestra al realizar la consulta
		 *  indicando la cantidad de resultados
		 * 
		 * IMPORTANTE: EL CRITERIO DE BUSQUEDA SE MUESTRA MEDIANTE JQUERY, EN LOS 3 BUSCADORES.
		 * desde el servidor se envia la cantidad de resultado o errores.
		 */

		$mensaje='';
		$resultados = count($respuesta['resultado']);
		if($resultados == 0){
			$mensaje = $mensaje.' No hubo resultados';
		}else{
			$mensaje = $mensaje. 'La consulta devolvio '.$resultados.' resultados' ;
		}
		
		$respuesta['mensaje'] = $mensaje; 
		
		return $app['twig'] -> render('/busqueda.twig.html', array('form_general' => $form_general -> createView(), 
																	'form_personas' => $form_personas -> createView(), 
																	'form_obras' => $form_obras -> createView(), 
																	'pagina_actual' => 'busqueda', 
																	'respuesta' => $respuesta,
																	'hubo_consulta'=> $huboConsulta 
																	));

	}

//------BUSCAR ACTION-----

public function buscarAction($respuesta){
	echo 'hola';
	$respuesta = 'eh gato';
	return $app->redirect($app['url_generator']->generate('busqueda'));
	
}



//  CONSULTASSSSS-------------------------------------------______________________________________

	public function busquedaGeneral(Application $app, $criterio) {
		//obras
		//('persona',{persona: persona.id})
		$lp = "persona/";
		$lo = "obras/";
		
		$obras_query = "SELECT 'obras' AS entidad,obra.id AS link, obra.titulo AS encabezado FROM BaseVideoArte\Entidades\Obra obra WHERE obra.titulo LIKE '%$criterio%'";
		$query = $app['db.orm.em']->createQuery($obras_query);
		$obras = $query->getResult();
		//personas
		$personas_query = "SELECT 'personas' AS entidad, persona.id AS link, CONCAT(persona.apellido, CONCAT(', ',persona.nombre) ) AS encabezado 
		FROM BaseVideoArte\Entidades\Persona persona WHERE (persona.apellido LIKE '%$criterio%' OR persona.nombre LIKE '%$criterio%') ";
		$query = $app['db.orm.em']->createQuery($personas_query);
		$personas = $query->getResult();
		// mezclo arrays
		$resultado_general = array_merge($obras,$personas);
		
		$mensaje='';
		
		
		return array('mensaje' => $mensaje, 'resultado' => $resultado_general);
	}
	
	// busqueda personas
	/**
	 *   BUSCADOR PERSONAS
	 */
	public function busquedaPersonas(Application $app, $nombre,$sexo,$pais,$tipos ){
		/*
		 * -El array $condiciones contiene las distintos criterios de consulta marcador por el usuario
		 * - El array $leftJoins contiene los LEFT JOIN necesarios
		 */	
		$condiciones = array();
		$leftJoin = array();
		$criterio = '';	
		$mensaje = '';	
		
		if( !empty($nombre)){
			$criterio = $criterio. 'nombre: '.$nombre;
			$condiciones [] =  " (persona.apellido LIKE '%$nombre%' OR persona.nombre LIKE '%$nombre%')";			
		}	
		
		if(!empty($sexo) ){
			$criterio = $criterio. ' sexo: '.$sexo;
			//echo $mensaje;
			$condiciones[] = " persona.sexo = '$sexo' ";
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
					
			} 
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
			
			$consulta = "SELECT DISTINCT 'personas' AS entidad ,persona.id AS link, CONCAT(persona.apellido, CONCAT(', ',persona.nombre) ) AS encabezado FROM BaseVideoArte\Entidades\Persona persona 
						LEFT JOIN persona.pais pais LEFT JOIN persona.tipos tipos WHERE $andWhere";
			$q =  $app['db.orm.em']->createQuery($consulta);
			$personas = $q->getResult();
			//$mensaje = $consulta;
		}
		
		/*
		 * Editando mensaje
		 */  
		 
		// $criterio = "nombre: $nombre, sexo: $sexo, pais: $pais, tipo: $tipos";
		 
		$mensaje = '' ;
		// $resultados = count($personas);
		// if($resultados == 0){
			// $mensaje = $mensaje.' No hubo resultados';
		// }else{
			// $mensaje = $mensaje. 'La consulta devolvio '.$resultados.' resultados' ;
		// }
// 		
		
		
		return array('mensaje' => $mensaje, 'resultado' => $personas);
		
	}
	
	// busqueda obras
		
	/**
	 *   BUSCADOR OBRAS
	 */
	
	public function busquedaObras(Application $app, $titulo,$formato,$palabra){
		
		//$palabras = implode(",", $palabras );
		$condiciones = array();
		$leftJoin = array();
		$mensaje = '';	
		if(!empty($titulo)){
			$condiciones [] = " o.titulo LIKE '%$titulo%' ";
		}
		if(!empty($formato)){
			$condiciones [] = " formato.id =$formato ";
		}
		if(!empty($palabra)){
			$condiciones [] = " palabra.id =$palabra ";
		}
		
		//--------------
		//--------------
		if(  empty($condiciones) ){
			$obras = null;
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
			
			$consulta ="SELECT DISTINCT 'obras' AS entidad, o.titulo AS encabezado, o.id AS link FROM BaseVideoArte\Entidades\Obra o LEFT JOIN o.palabrasClave palabra LEFT JOIN o.formatos formato
		  WHERE $andWhere";
			$q =  $app['db.orm.em']->createQuery($consulta);
			$obras = $q->getResult();
			//$mensaje = $consulta;	
		}
		//--------------
				
		// $consulta = "SELECT DISTINCT o.titulo AS encabezado, o.id AS link FROM BaseVideoArte\Entidades\Obra o LEFT JOIN o.palabrasClave palabra LEFT JOIN o.formatos formato
		  // WHERE palabra.id =$palabra AND formato.id =$formato AND o.titulo LIKE '%$titulo%' ";
	//	$mensaje = "titulo: $titulo  formato: $formato palabras: $palabras";
		
		
		return array('mensaje' => $mensaje, 'resultado' => $obras);
	}

}
