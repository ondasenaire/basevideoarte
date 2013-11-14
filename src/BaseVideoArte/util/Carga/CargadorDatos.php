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
	private $datos;
	//
	private $palabrasClave;

	public function cargar() {
		$this -> datos = '/datos';
		
		$this-> palabrasClave = array();
		
		$this -> procesarPaises();
		$this -> procesarTipos();
		$this -> procesarFormatos();
		$this -> procesarGeneros();
		$this -> procesarPersonas();
		$this -> procesarObras();
		
		$this -> buscarArchivos('obras');
		
		
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

	public function buscarArchivos($tipo) {

		$finder = new \Symfony\Component\Finder\Finder();
		$finder -> files() -> in(__DIR__ . $this -> datos) -> name($tipo . '*');
		//	echo '<br> en la carpeta datos hay: <br> ';
		// foreach ($finder as $file) {
		//
		// echo $file -> getRelativePathname() . "<br>";
		// }
		//echo '<br>'.iterator_count($finder).'<br>';
		//print_r( iterator_to_array($finder) );

		return iterator_to_array($finder);
	}

	//--------------
	/*	Algoritmo Procesar  (con finder, sin finder desde paso 3)
	 * 1. busco archivos correspondientes al la entidad (personas,obras,paises)
	 * 2. recorro la lista de archivos y por cada uno encontrado
	 * 3. abro el archivo .json y vuelco la info en un array ( json_decode mediante metodo json)
	 * 4. recorro el array json y por cada elemento creo una instancia de la entidad correspondiente
	 * 5. asigno esa instancia al listado general
	 */
	/// -------------------
	public function procesarPaises() {// va a haber un solo archivo paises, no tiene mucho sentido el finder

		$lista_paises = $this -> json($this -> datos . "/paises.json");
		foreach ($lista_paises as $clave => $pais) {
			$this -> paises[$clave] = new Pais($pais['pais']);
		}

	}

	public function procesarTipos() {// idem paises
		$lista_tipos = $this -> json($this -> datos . "/tipos.json");
		foreach ($lista_tipos as $clave => $tipo) {
			$this -> tipos[$clave] = new TipoDePersona($tipo['tipo']);
		}
	}

	public function procesarFormatos() {// idem paises
		$lista_formatos = $this -> json($this -> datos . "/formatos.json");
		foreach ($lista_formatos as $clave => $formato) {
			$this -> formatos[$clave] = new Formato($formato['formato']);
		}
	}

	public function procesarGeneros() {// idem paises
		$lista_generos = $this -> json($this -> datos . "/generos.json");
		foreach ($lista_generos as $clave => $genero) {
			$this -> generos[$clave] = new Genero($genero['genero']);
		}
	}
	// PERSONAS, OBRAS Y EVENTOS
	/*
	 * el metodo procesar carga las obras, pais y metadados en Personas
	 */   
	public function procesarPersonas() {
		// debido a la cantidad de personar se usa el finder para organizar las personas en grupos
		//finder
		$finder = $this -> buscarArchivos('personas');
		foreach ($finder as $archivo) {
			//----- paso 3
			$lista_personas = $this -> json($this -> datos .'/' . $archivo -> getRelativePathname());
			foreach ($lista_personas as $clave => $persona) {
				$p = new Persona($persona['nombre'], $persona['apellido'], $persona['data'], $persona['inicio'], '', $persona['sexo'], $persona['mostrar']);
				$p -> setPais($this -> paises[$persona['pais']]);
				//proceso tipo;
				foreach ($persona['tipo'] as $tipo) {

					$p -> addTipo($this -> tipos[$tipo]);

				}
				//proceso las obras (no. ahora se hace desde obras)
				
				//metadatos persona
				if( array_key_exists('metadatos',$persona) ){
					foreach ($persona['metadatos'] as $metadato) {
						//busca el metadato y lo asocia
						//echo 'SOY UN METADATO PERSONA';
						$met = new \BaseVideoArte\Entidades\MetadatoPersona($metadato['metadato'], $metadato['tipo']);
						$p -> addMetadato($met);
						$met -> setPersona($p);
					}
				}
				
				// foto ppal
				if( array_key_exists('foto',$persona) ){
					
						 echo '<br>existe la foto<br>';
						 $m = new \BaseVideoArte\Entidades\Medio($persona['foto'],"foto de $persona[nombre] $persona[apellido]",'ppal');
						 $p->addMedio($m);
						 $m->addPersona($p);
					 
				}
				
				
				//web
				
				if( array_key_exists('web',$persona) ){
					echo '<br>existe la web<br>';
					foreach ($persona['web'] as $web) {
						 $m = new \BaseVideoArte\Entidades\Medio($web,"web de $persona[apellido]",'web');
						 $p->addMedio($m);
						 $m->addPersona($p);
					}
				}
				
				
				// guardo la perosna en array
				$this -> personas[$clave] = $p;

			}

		}//fin finder
	}

	public function procesarObras() {

		$finder = $this -> buscarArchivos('obras');
		foreach ($finder as $archivo) {
			//--
			$lista_obras = $this -> json($this -> datos.'/' . $archivo -> getRelativePathname());
			foreach ($lista_obras as $clave => $obra) {

				$o = new Obra($obra['titulo'], $obra['sinopsis'], $obra['anho'], $obra['duracion'],$obra['mostrar']);
				//busca y agrega los formatos
				if( array_key_exists('formato',$obra) ){
					foreach ($obra['formato'] as $formato) {
						$o -> addFormato($this -> formatos[$formato]);
						//echo '<br>existe la clave formato<br>';
					}
				}
				
				// asigno autores
				if (array_key_exists('autores', $obra)){
					foreach ($obra['autores'] as $autor) {
						$a = $this->personas[$autor];
						
						$a->addObra($o);
						$o->addArtista($a);
								
					}
					//echo 'hola';
				}
				
				//busca y agrega los generos
				if( array_key_exists('genero',$obra) ){
					foreach ($obra['genero'] as $genero) {
					$o -> addGenero($this -> generos[$genero]);
					//echo '<br>existe la clave genero<br>';
					}
				}
				// busca los metadatos
				if( array_key_exists('metadatos',$obra) ){	
				foreach ($obra['metadatos'] as $metadato) {
					//busca el metadato y lo asocia
						$met = new \BaseVideoArte\Entidades\MetadatoObra($metadato['metadato'], $metadato['tipo']);
						$o -> addMetadato($met);
						$met -> setObra($o);
					}
				}
				
				// busca las palabras clave
				/*
				 * aqui es diferente al resto. si la palabra no fue utilizada
				 * la crea y la carga en $this->palabrasClave.
				 * si ya esta , se la usa desde $this->palabrasClave
				 */
				if( array_key_exists('palabras',$obra) ){
					foreach ($obra['palabras'] as $palabra) {
						// veo si la palabra clave fue utilizada antes
						if( array_key_exists($palabra, $this->palabrasClave) ){
							echo 'la palabra ya existe  '.$palabra.' <br>';
							// $palabra es el indice para buscar las palabras clave
							$o -> addPalabrasClave($this->palabrasClave[$palabra]);
							$this->palabrasClave[$palabra] ->addObra ($o);
							
							
						} else {
							$pc = new \BaseVideoArte\Entidades\PalabraClave($palabra);
							$o -> addPalabrasClave($pc);
							$pc ->addObra ($o);
							$this->palabrasClave[$palabra] = $pc;
						}
						
						
						
					}
				}
				
						// foto ppal
				if( array_key_exists('foto',$obra) ){
					
						 echo '<br>existe la foto en obra<br>';
						 $m = new \BaseVideoArte\Entidades\Medio($obra['foto'],"foto de $obra[titulo]",'ppal');
						 $o->addMedio($m);
						 $m->addObra($o);
					 
				}
				
				// busca los medios
				if( array_key_exists('medios',$obra) ){
					foreach ($obra['medios'] as $medio) {
						//echo '<br>existe la clave medio<br>';
						$m = new \BaseVideoArte\Entidades\Medio($medio['medio'],$medio['descripcion'],$medio['tipo']);
						$o->addMedio($m);
						$m->addObra($o);
					}
				}
				
				$this -> obras[$clave] = $o;
			}
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
