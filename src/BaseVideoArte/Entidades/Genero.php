<?php
namespace BaseVideoArte\Entidades;
/**
 * @Entity
 * @Table(name="generos")
 */
class Genero {
	/**
	 * @Id
	 *  @Column(type="integer")
	 * @GeneratedValue
	 *
	 */
	private $id;
	
	/**
	 * Column(type="string")
	 */
	private $genero;
}
