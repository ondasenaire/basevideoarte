<?php
namespace BaseVideoArte\Util\Manejador;
class ManejadorEventos implements ManejadorInterface{
	
	private $evento;
	
	public function asociarObra($obra ){
		$this->evento->addObra($obra);
		$obra->addEvento($this->evento);
	}
	
	public function asociarCurador($persona){
		$this->evento->addCurador($persona);
		$persona->addEvento($this->evento); 
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
