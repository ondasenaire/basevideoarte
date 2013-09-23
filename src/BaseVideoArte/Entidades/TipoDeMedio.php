<?php
namespace BaseVideoArte\Entidades;
/**
 * @Entity
 * @Table(name="tipo_de_medio")
 */
class TipoDeMedio {
	/**
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */
	private $id;
	/**
	 * @Column(type="string",name="tipo_de_medio")
	 */
	private $tipoDeMedio;

}
