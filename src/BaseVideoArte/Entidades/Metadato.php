<?php
namespace BaseVideoArte\Entidades;
/**
 * @Entity
 * @InheritanceType("SINGLE_TABLE")
 * @DiscriminatorColumn(name="discr", type="string")
 * @DiscriminatorMap({"per" = "MetadatoPersona", "obr" = "MetadatoObra"})
 */
abstract class Metadato {
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
	 public function __construct(){

	 }

}