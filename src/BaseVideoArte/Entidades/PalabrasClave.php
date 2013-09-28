<?php
namespace BaseVideoArte\Entidades;
/**
 * @Entity
 * @Table(name="palabras_clave")
 */
 
class PalabraClave{
	/**
	 *@Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */
	private $id;
	
	/**
	 * @Column(type="string")
	 */
	private $palabra;	
	
}
