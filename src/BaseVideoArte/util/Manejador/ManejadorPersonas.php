<?php
namespace BaseVideoArte\Util\Manejador;
class ManejadorEventos implements ManejadorInterface{
	
	private $persona;
	
	public function asociarObra($obra ){
		$this->persona->addObra($obra);
		$obra->addArtista($this->persona);
	}
	
	public function __construct($persona){
		$this->persona = $persona;
	}
	//implementa
	
	public function procesar(){
		
	}
	
	public function eliminar(){
		
	}
	
	public function asociarMedio(){
		
	}
	public function asociarMetadato(){
		
	
	}
	
	
}
