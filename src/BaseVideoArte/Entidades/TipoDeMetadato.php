<?php
namespace BaseVideoArte\Entidades;
/**
 * @Entity
 * @Table(name="tipo_de_metadato")
 */
class TipoDeMetadato{
	/**
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */
	private $id;
	/**
	 * @Column(type="string")
	 */
	private $tipo;
}
