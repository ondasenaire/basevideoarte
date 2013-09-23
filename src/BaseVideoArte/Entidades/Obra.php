<?php
namespace BaseVideoArte\Entidades;
/**
 * @Entity
 * @Table(name="obras")
 */
class Obra {
	/**
	 * @Id
	 * @Column(type"integer")
	 */
	private $id;
	
	/**
	 * @Column(type="string")
	 */
	private $titulo;
	
	/**
	 * @Column(type="text")
	 */
	private $descripcion;
	
	/**
	 * @Column(type="string")
	 */
	private $anho;
	/**
	 * @Column(type="string")
	 */
	private $duracion;
	
	//--------------
	/**
	 * @OneToOne(targetEntity="Genero")
     * @JoinColumn(name="genero_id", referencedColumnName="id")
	 */
	private $genero;
	
	/**
	 * @OneToOne(targetEntity="Formato")
     * @JoinColumn(name="formato_id", referencedColumnName="id")
	 */
	private $formato;
	
	
	
}
