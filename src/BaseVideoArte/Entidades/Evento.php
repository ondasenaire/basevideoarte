<?php
namespace BaseVideoArte\Entidades;
/**
 * @Entity
 * @Table(name="eventos")
 */
class Evento {
	/**
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */
	private $id;
	/**
	 * @Column(type"string")
	 */		
	private $nombre;
	/**
	 * @Column(type"date")
	 */	
	private $fecha;
	//private $artistas;
	//private $curadores;
	/**
	 * @Column(type"text")
	 */	
	private $info;
}
