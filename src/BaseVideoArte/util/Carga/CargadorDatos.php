<?php
namespace BaseVideoArte\Util\Carga;

use Silex\Application;
use BaseVideoArte\Entidades\Pais;
use BaseVideoArte\Entidades\Persona;
use BaseVideoArte\Entidades\Formato;
use BaseVideoArte\Entidades\Genero;
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

	public function cargar() {
		$this -> procesarPaises();
		$this -> procesarTipos();
		$this -> procesarFormatos();
		$this -> procesarGeneros();

		$this -> procesarObras();
		$this -> procesarPersonas();

	}

	public function asociar() {

	}

	public function persistir(Application $app) {

		foreach ($this->paises as $pais) {
			$app['db.orm.em'] -> persist($pais);
		}

		foreach ($this->formatos as $formato) {
			$app['db.orm.em'] -> persist($formato);
		}

		foreach ($this->generos as $genero) {
		$app['db.orm.em'] -> persist($genero);
		}
		

		foreach ($this->tipos as $tipo) {
			$app['db.orm.em'] -> persist($tipo);
		}

		// foreach ($medios as $medio) {
		// $app['db.orm.em'] -> persist($medio);
		// }
		//
	//	foreach ($this->metadatos as $metadato) {
		//$app['db.orm.em'] -> persist($metadato);
	//	}
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
		$app['db.orm.em'] -> flush();

	}

	//-----------------

	public function json($archivo) {

		$str_datos = file_get_contents(__DIR__ . $archivo);
		$datos = json_decode($str_datos, true);
		return $datos;
	}

	public function procesarPaises() {

		$lista_paises = $this -> json("/paises.json");
		foreach ($lista_paises as $clave => $pais) {
			$this -> paises[$clave] = new Pais($pais['pais']);
		}

	}

	public function procesarTipos() {
		$lista_tipos = $this -> json("/tipos.json");
		foreach ($lista_tipos as $clave => $tipo) {
			$this -> tipos[$clave] = new TipoDePersona($tipo['tipo']);
		}
	}

	public function procesarFormatos() {
		$lista_formatos = $this -> json("/formatos.json");
		foreach ($lista_formatos as $clave => $formato) {
			$this -> formatos[$clave] = new Formato($formato['formato']);
		}
	}

	public function procesarGeneros() {
		$lista_generos = $this -> json("/generos.json");
		foreach ($lista_generos as $clave => $genero) {
			$this -> generos[$clave] = new Genero($genero['genero']);
		}
	}




	public function procesarPersonas() {
		$lista_personas = $this -> json("/personas.json");
		foreach ($lista_personas as $clave => $persona) {
			$p = new Persona($persona['nombre'], $persona['apellido'], $persona['data'], $persona['inicio'], $persona['web'], $persona['sexo'], $persona['mostrar']);
			$p -> setPais($this -> paises[$persona['pais']]);
			//;
			foreach ($persona['tipo'] as $tipo) {
				
				$p -> addTipo($this -> tipos[$tipo]);

			}
			foreach ($persona['obras'] as $obra) {
				
				$p -> addObra($this -> obras[$obra]);

			}
			//metadatos persona
			foreach ($persona['metadatos'] as $metadato) {
				//busca el metadato y lo asocia
				echo 'SOY UN METADATO PERSONA';
				$met = new \BaseVideoArte\Entidades\MetadatoPersona($metadato['metadato'],$metadato['tipo']);				
				$p -> addMetadato($met);
				$met->setPersona($p);
			}
			$this -> personas[$clave] = $p;

		}
	}

	public function procesarObras() {
		$lista_obras = $this -> json("/obras.json");
		foreach ($lista_obras as $clave => $obra) {

			$o = new Obra($obra['titulo'], $obra['sinopsis'], $obra['anho'], $obra['duracion']);
			//busca y agrega los formatos
			foreach ($obra['formato'] as $formato) {
				$o -> addFormato($this -> formatos[$formato]);
			}
			//busca y agrega los generos
			foreach ($obra['genero'] as $genero) {
				$o -> addGenero($this -> generos[$genero]);
				
			}
			
			foreach ($obra['metadatos'] as $metadato) {
				//busca el metadato y lo asocia
				$met = new \BaseVideoArte\Entidades\MetadatoObra($metadato['metadato'],$metadato['tipo']);				
				$o -> addMetadato($met);
				$met->setObra($o);
			}
			
			$this -> obras[$clave] = $o;
		}
	}

	public function procesarEventos() {

	}

	//---------------------------

	public function getPaises() {
		return $this -> paises;
	}

	public function getTipos() {
		return $this -> tipos;
	}

	public function getPersonas() {
		return $this -> personas;
	}

	public function getObras() {
		return $this -> obras;
	}

	public function getFormatos() {
		return $this -> formatos;
	}

	public function getGeneros() {
		return $this -> generos;
	}

}
