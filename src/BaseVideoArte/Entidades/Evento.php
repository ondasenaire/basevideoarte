<?php
namespace BaseVideoArte\Entidades;
/**
 * @Entity
 * @Table(name="eventos")
 */
class Obra {
	private $nombre;
	private $fecha;
	private $artistas;
	private $curadores;
	private $info;
}
