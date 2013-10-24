<?php
namespace BaseVideoArte\Util\Inicializador;
/*
 * Entidades de clasificacion: paises, tipo de persona, generos, formatos.
 */
class InicializadorClasificaciones{
	
	public function cargarPaises(){
		$paises = array();
		$paises['argentina'] = new Pais('Argentina');
		$paises['belice'] = new Pais('bélice');
		$paises['brasil'] = new Pais('Brasil');
		$paises['bolivia'] = new Pais('Bolivia');
		$paises['chile'] = new Pais('Chile');
		$paises['colombia'] = new Pais('Colombia');
		$paises['costa_rica'] = new Pais('Costa Rica');
		$paises['cuba'] = new Pais('Cuba');
		$paises['republica_dominicana'] = new Pais('República Dominicana');
		$paises['ecuador'] = new Pais('Ecuador');
		$paises['el_salvador'] = new Pais('El Salvador');
		$paises['guatemala'] = new Pais('Guatemala');
		$paises['guayana_francesa'] = new Pais('Guayana Francesa');
		$paises['haiti'] = new Pais('Haití');
		$paises['honduras'] = new Pais('Honduras');
		$paises['mexico'] = new Pais('México');
		$paises['nicaragua'] = new Pais('Nicaragua');
		$paises['panama'] = new Pais('Panamá');
		$paises['paraguay'] = new Pais('Paraguay');
		$paises['peru'] = new Pais('Perú');
		$paises['puerto_rico'] = new Pais('Puerto Rico');
		$paises['venezuela'] = new Pais('Venezuela');
		$paises['uruguay'] = new Pais('Uruguay');
		return $paises;
	}
	
	
	public function cargarTiposDePersona(){
		$tipos	=  array();
		$tipos['artista'] = new TipoDePersona('artista');
		$tipos['curador'] = new TipoDePersona('curador');
		return $tipos;
	}
}
