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
	 * @Column(type="string")
	 */		
	private $nombre;
	/**
	 * @Column(type="string")
	 */	
	private $anho;
	
	/**
	 * @Column(type="string")
	 */
	private $web;
	 
	/**
	 * @Column(type="text")
	 */	
	private $info;
	
	/**
	 * @Column(type="string")
	 */
	private $lugar;
	
	
	
	//--CAMPOS RELACIONADOS
    /**
     * @ManyToMany(targetEntity="Persona", inversedBy="curadores")
     * @JoinTable(name="curadores_x_evento")
     **/
	private $curadores;
	/**
	 * @ManyToOne(targetEntity="Pais")
	 * @JoinColumn(name="pais_id", referencedColumnName="id")
	 */
	private $pais;
	/**
	 * @ManyToMany(targetEntity="Obra", inversedBy="eventos")
	 * @JoinTable(name="obras_x_evento")
	 */
	private $obras;
	
	
		/**
	 * 
	 * muchos a muchos unidireccional
	 * @ManyToMany(targetEntity="Medio")
	 * @JoinTable(name="medios_x_evento", 
	 * 		joinColumns={@JoinColumn(name="evento_id", referencedColumnName="id")},
	 * 		inverseJoinColumns={@JoinColumn(name="medio_id",referencedColumnName="id",
	 * 		unique=true)}
	 * 		)
	 */
	private $medios; //imagenes, videos,links ,etc
	
	 /**
     * @OneToMany(targetEntity="Metadato", mappedBy="evento")
     **/
	private $metadatos;
	
	//--------------------
	 /**
     * Constructor
     */
    public function __construct( $nombre,$anho,$web,$info,$lugar)    {
    	
		$this->nombre = $nombre;
		$this->anho = $anho;
		$this->web = $web;
		$this->info = $info;
		$this->lugar = $lugar;
		
    	$this->metadatos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->obras = new \Doctrine\Common\Collections\ArrayCollection();
		$this->curadores = new \Doctrine\Common\Collections\ArrayCollection();
		$this -> medios = new \Doctrine\Common\Collections\ArrayCollection();
    }


}