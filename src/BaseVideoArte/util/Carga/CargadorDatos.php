<?php
namespace BaseVideoArte\Util\Carga;

use Silex\Application;
use BaseVideoArte\Entidades\Pais;
use BaseVideoArte\Entidades\Persona;
use BaseVideoArte\Entidades\Formato;
use BaseVideoArte\Entidades\Obra;
use BaseVideoArte\Entidades\TipoDePersona;
class CargadorDatos {
	//Entidades de clasificacion
	private $paises;
	private $formatos;
	private $generos;
	private $tipos;
	///--------
	private $medios;
	private $metadatos;
	///--------	
	private $personas;
	private $obras;
	private $eventos;
	
	
	
	public function cargar(){
		$this->procesarPaises();
		$this->procesarTipos();
		$this->procesarPersonas();
		$this->procesarObras();

	}
	
	
	public function asociar(){
		
	}
	
	public function persistir(Application $app) {
		
		foreach ($this->paises as $pais) {
			$app['db.orm.em'] -> persist($pais);
		}
// 
		// foreach ($formatos as $formato) {
			// $app['db.orm.em'] -> persist($formato);
		// }
// 
		// foreach ($generos as $genero) {
			// $app['db.orm.em'] -> persist($genero);
		// }
// 		
		
		foreach ($this->tipos as $tipo) {
			$app['db.orm.em'] -> persist($tipo);
		}
		
		
		// foreach ($medios as $medio) {
			// $app['db.orm.em'] -> persist($medio);
		// }
// 		
		// foreach ($metadatos as $metadato) {
			// $app['db.orm.em'] -> persist($metadato);
		// }
// 		
//----------------------

		foreach ($this->personas as $persona) {
			$app['db.orm.em'] -> persist($persona);
		}		
		
		foreach ($this->obras as $obra) {
			$app['db.orm.em'] -> persist($obra);
		}
		
		// foreach ($eventos as $evento) {
			// $app['db.orm.em'] -> persist($evento);
		// }
// 	
// 	
		$app['db.orm.em']->flush();

	}

//-----------------

	public function json($archivo){

		$str_datos = file_get_contents(__DIR__.$archivo);
		$datos = json_decode($str_datos,true);
		return $datos;
	}
	
	
	public function procesarPaises(){
		
		$lista_paises = $this->json("/paises.json");
		foreach ($lista_paises as $clave => $pais) {
			$this->paises [$clave] = new Pais($pais['pais']);
		}
					
	}
	
	
	public function procesarTipos(){
		$lista_tipos = $this->json("/tipos.json");
		//$paises = array();
		foreach ($lista_tipos as $clave => $tipo) {
			$this->tipos [$clave] = new TipoDePersona($tipo['tipo']);
		}
	}
	
	public function procesarGeneros(){
		
	}
	
	public function procesarFormatos(){
		
	}
	
	public function procesarPersonas(){
			$lista_personas = $this->json("/personas.json");
			foreach ($lista_personas as $clave => $persona) {
			$this->personas [$clave] = new Persona($persona['nombre'],$persona['apellido'],$persona['data'],$persona['inicio'],$persona['web'],$persona['sexo'],$persona['mostrar']);
		}	
	}
	
	public function procesarObras(){
			$lista_obras = $this->json("/obras.json");
			foreach ($lista_obras as $clave => $obra) {
			$this->obras [$clave] = new Obra($obra['titulo'],$obra['sinopsis'],$obra['anho'],$obra['duracion']);
		}		
	}
		
	public function procesarEventos(){
		
	}
	
	//---------------------------
	
	public function getPaises(){
		return $this->paises;
	}

	public function getTipos(){
		return $this->tipos;
	}	
	
	public function getPersonas(){
		return $this->personas;
	}	

	public function getObras(){
		return $this->obras;
	}
}
