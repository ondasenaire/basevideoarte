<?php
namespace BaseVideoArte\Entidades;
/**
 * @Entity
 * @Table(name="paises")
 */
class Pais {
	/**
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */
	private $id;
	/**
	 * @Column(type="string")
	 */
	private $pais;
}
