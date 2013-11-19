<?php
namespace BaseVideoArte\Util\Opciones;

use Silex\Application;

class OpcionesForm {
	
	
	
	public function __construct(){
		
	}
	
	public function getOpciones(Application $app, $entidad,$campo){
					
		$opciones = array();
		$consulta = $app['db.orm.em'] -> createQuery("SELECT e FROM BaseVideoArte\\Entidades\\$entidad e ");
		$entidades = $consulta -> getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
		
		foreach ($entidades as $entidad) {
			$op[$entidad['id']] = $entidad[$campo];
		}
		return $op;
	}
	
	
	public function getOpcionesPais(Application $app){
		//echo 'eh gato!';
		return $this->getOpciones($app, 'Pais', 'pais');
	}
	
	public function getOpcionesTipo(Application $app){
		return $this->getOpciones($app, 'TipoDePersona', 'tipo');
	}
	
	public function getOpcionesFormato(Application $app){
		return $this->getOpciones($app, 'Formato', 'formato');
	}
	
	public function getOpcionesGenero(Application $app){
		return $this->getOpciones($app, 'Genero', 'genero');
	}
	
	public function getOpcionesPalabraClave(Application $app){
		return $this->getOpciones($app, 'PalabraClave', 'palabra');
	}

	
}
