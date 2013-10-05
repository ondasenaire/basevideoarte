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
	
	/**
	 * @Column(type="integer")
	 */
	private $tipo;
	
	private $tipos; // array con las categorias
	
	
	//-------------------
	public function __construct(){
		$this->tipos =array(
			'1' => 'nombre',
			'2' => 'apellido',
			'3' => 'pais',
			'4' => 'web',
			'5' => 'inicio',
			'6' => 'formato',
			'7' => 'titulo',
		
		);
	}
	//porobando pra reducir cantidad de entidades
	public function getTipos(){
		return $this->tipos; 
	}	
	public function setTipo($t){
		$this->tipo = $t;
	}	
			
	
	
	
}
