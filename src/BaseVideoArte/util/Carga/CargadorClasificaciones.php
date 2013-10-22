<?php
namespace BaseVideoArte\Util\Inicializador;
/*
 * Entidades de clasificacion: paises, tipo de persona, generos, formatos.
 */
class InicializadorClasificaciones{
	
	public function cargarPaises(){
		$paises = array();
		$paises['argentina'] = new Pais('Argentina');
		$paises['brasil'] = new Pais('Brasil');
		$paises['bolivia'] = new Pais('Bolivia');
		$paises['chile'] = new Pais('Chile');
		$paises['colombia'] = new Pais('Colombia');
		$paises['cuba'] = new Pais('Cuba');
		$paises['ecuador'] = new Pais('Ecuador');
		$paises['peru'] = new Pais('Perú');
		$paises['paraguay'] = new Pais('Paraguay');
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
