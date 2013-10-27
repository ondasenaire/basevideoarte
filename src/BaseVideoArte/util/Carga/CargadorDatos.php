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
		$this->paises = $this->procesarPaises();
		$this->formatos = $this->procesarFormatos();
		$this->generos = $this->procesarGeneros();
		$this->tipos = $this->procesarTipos();
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
		$paises = array();
		foreach ($lista_paises as $clave => $pais) {
			$paises [$clave] = $pais;
		}
		
		return $paises;	
	}
	
	
	public function procesarTipos(){
		
	}
	
	public function procesarGeneros(){
		
	}
	
	public function procesarFormatos(){
		
	}
	
	public function procesarPersonas(){
		
	}
	
	public function procesarObras(){
		
	}
		
	public function procesarEventos(){
		
	}
	
	
	
	



}
