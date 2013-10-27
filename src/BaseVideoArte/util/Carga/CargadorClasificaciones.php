<?php
namespace BaseVideoArte\Util\Inicializador;
/*
 * Entidades de clasificacion: paises, tipo de persona, generos, formatos.
 */
class InicializadorClasificaciones{
	

	
	
	public function cargarTiposDePersona(){
		$tipos	=  array();
		$tipos['artista'] = new TipoDePersona('artista');
		$tipos['curador'] = new TipoDePersona('curador');
		return $tipos;
	}
}
