<?php
namespace BaseVideoArte\Util\Inicializador;

use Silex\Application;

class InicializarDatos {
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

}
