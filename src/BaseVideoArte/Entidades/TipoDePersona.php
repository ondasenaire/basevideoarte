<?php
namespace BaseVideoArte\Entidades;
/**
 * @Entity
 * @Table(name="tipo_de_persona")
 */
 class TipoDePersona{
 	/**
	 * @Id @Column(type="integer") @GeneratedValue
	 */
	private $id;
	/**@Column(type="string")*/
	private $tipo;
	
 }
