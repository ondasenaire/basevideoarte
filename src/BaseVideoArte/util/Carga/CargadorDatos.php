<?php
namespace BaseVideoArte\Util\Carga;

use Silex\Application;

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
	
	
	
	public function iniciar(){
		$this->procesarPaises();
		$this->procesarTipos();
		$this->procesarPersonas();
		$this->procesarObras();

	}
	
	
	public function asociar(){
		
	}
	public function persistir() {

		foreach ($paises as $pais) {
			$app['db.orm.em'] -> persist($pais);
		}

		foreach ($formatos as $formato) {
			$app['db.orm.em'] -> persist($formato);
		}

		foreach ($generos as $genero) {
			$app['db.orm.em'] -> persist($genero);
		}
		
		
		foreach ($tipos as $tipo) {
			$app['db.orm.em'] -> persist($tipo);
		}
		
		
		foreach ($medios as $medio) {
			$app['db.orm.em'] -> persist($medio);
		}
		
		foreach ($metadatos as $metadato) {
			$app['db.orm.em'] -> persist($metadato);
		}
		
//----------------------

		foreach ($personas as $persona) {
			$app['db.orm.em'] -> persist($persona);
		}		
		
		foreach ($obra as $obra) {
			$app['db.orm.em'] -> persist($obra);
		}
		
		foreach ($eventos as $evento) {
			$app['db.orm.em'] -> persist($evento);
		}
	

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
			$this->paises [$clave] = $pais;
		}
					
	}
	
	
	public function procesarTipos(){
		$lista_tipos = $this->json("/tipos.json");
		//$paises = array();
		foreach ($lista_tipos as $clave => $tipo) {
			$this->tipos [$clave] = $tipo;
		}
	}
	
	public function procesarGeneros(){
		
	}
	
	public function procesarFormatos(){
		
	}
	
	public function procesarPersonas(){
			$lista_personas = $this->json("/personas.json");
			foreach ($lista_personas as $clave => $persona) {
			$this->personas [$clave] = $persona;
		}	
	}
	
	public function procesarObras(){
			$lista_obras = $this->json("/obras.json");
			foreach ($lista_obras as $clave => $obra) {
			$this->obras [$clave] = $obra;
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
