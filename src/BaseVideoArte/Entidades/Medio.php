<?php
namespace BaseVideoArte\Entidades;
/**
 * @Entity
 * @Table(name="medios")
 */
class Medio {
	
	/**
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */
	private $id;
	
	/**
	 * @Column(type="string")
	 */
		private $archivo; // ruta al archivo
	/*
	 * @OneToOne(targetEntity="TipoDeMedio")
	 * @JoinColumn(name="tipo_medio_id", referencedColumnName="id")
	 */
	private $tipo;
}
