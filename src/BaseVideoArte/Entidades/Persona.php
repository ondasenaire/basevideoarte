<?php
// src/MyWebsite/Entity/Persona.php
namespace BaseVideoArte\Entidades;

 /**
 * @Entity
 * @Table(name="personas")
 */
class Persona{
	 /** 
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /** @Column(type="string") */
    private $nombre;
	    /** @Column(type="string") */
    private $apellido;	
	/** @Column(type="text") */
	private $data;
	/** @Column(type="string") */
	private $inicio;
	/** @Column(type="string") */
	private $web;
	/**  @Column(type="string") */
	private $sexo;
	/**@Column(type="boolean")*/
	private $mostrar;
	
		
	// CAMPOS RELACIONADOS
	/**
	 * @ManyToOne(targetEntity="TipoDePersona")
     * @JoinColumn(name="tipo_id", referencedColumnName="id")
     */	
	private $tipo;
	
	//Many-To-One, Unidirectional
	/**
	 * @ManyToOne(targetEntity="Pais")
     * @JoinColumn(name="pais_id", referencedColumnName="id")
     */	 
	private $pais;
	
	
	/**
	* @ManyToMany(targetEntity="Obra", inversedBy="artistas")
	* @JoinTable(name="obras_x_artista")
	*/
	private $obras;
		
	/**
	* @ManyToMany(targetEntity="Evento", inversedBy="curadores")
	* 
	*/	
	private $eventos; // eventos en los que la persona participo como curador
	
	
	/**
	 * 
	 * muchos a muchos unidireccional
	 * @ManyToMany(targetEntity="Medio")
	 * @JoinTable(name="medios_x_persona", 
	 * 		joinColumns={@JoinColumn(name="persona_id", referencedColumnName="id")},
	 * 		inverseJoinColumns={@JoinColumn(name="medio_id",referencedColumnName="id",
	 * 		unique=true)}
	 * 		)
	 */
	private $medios;
	//--------CONSTRUCTOR-------
		public function __construct(){
		$this->obras = new \Doctrine\Common\Collections\ArrayCollection();
		$this->eventos = new \Doctrine\Common\Collections\ArrayCollection();
		$this->medios = new \Doctrine\Common\Collections\ArrayCollection();
	}
	//-----------------------------
	
	
}
