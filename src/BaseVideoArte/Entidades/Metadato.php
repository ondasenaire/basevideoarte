<?php
namespace BaseVideoArte\Entidades;
/**
 * @Entity
 * @Table(name="tipo_de_metadato")
 */
class Metadato{
	/**
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */
	private $id;
	/**
	 * @Column(type="string")
	 */
	private $metadato;
	

	private $tipo;
	
	
	//-------------------
	
	//porobando pra reducir cantidad de entidades
	public function getTipos(){
		$tipos = array(
			'1' => 'nombre',
			'2' => 'apellido',
			'3' => 'pais',
			'4' => 'web',
			'5' => 'inicio',
			'6' => 'formato',
			'7' => 'titulo',
		
		);
	}	
	public function setTipo(){
		
	}	
			
	
	
	
}
