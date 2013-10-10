<?php
namespace BaseVideoArte\Entidades;
/**
 * @Entity
 * @InheritanceType("SINGLE_TABLE")
 * @DiscriminatorColumn(name="discr", type="string")
 * @DiscriminatorMap({"per" = "MetadatoPersona", "obr" = "MetadatoObra"})
 */
class Metadato {
	/**
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */
	protected $id;
	/**
	 * @Column(type="string")
	 */
	protected $metadato;
	/**
	 * @Column(type="integer")
	 */
	protected $tipo;	

//-------------------------------------------
//-------------------
	 public function __construct($metadato,$tipo){
		$this->metadato = $metadato;
		if( gettype($tipo) == 'string' ){
			array_search($tipo, $this->getTipos());
		}else{
			$this->tipo = $tipo;
		}
	 }

	abstract protected function getTipos();
	abstract protected function getSTipo();

}