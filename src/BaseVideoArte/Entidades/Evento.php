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
     * @ManyToMany(targetEntity="Medio", inversedBy="eventos",cascade={"persist"})
     * @JoinTable(name="medios_x_evento")
     **/
	private $medios; //imagenes, videos,links ,etc
	
    /**
     * @OneToMany(targetEntity="MetadatoEvento", mappedBy="evento")
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




    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Evento
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set anho
     *
     * @param string $anho
     * @return Evento
     */
    public function setAnho($anho)
    {
        $this->anho = $anho;
    
        return $this;
    }

    /**
     * Get anho
     *
     * @return string 
     */
    public function getAnho()
    {
        return $this->anho;
    }

    /**
     * Set web
     *
     * @param string $web
     * @return Evento
     */
    public function setWeb($web)
    {
        $this->web = $web;
    
        return $this;
    }

    /**
     * Get web
     *
     * @return string 
     */
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * Set info
     *
     * @param string $info
     * @return Evento
     */
    public function setInfo($info)
    {
        $this->info = $info;
    
        return $this;
    }

    /**
     * Get info
     *
     * @return string 
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Set lugar
     *
     * @param string $lugar
     * @return Evento
     */
    public function setLugar($lugar)
    {
        $this->lugar = $lugar;
    
        return $this;
    }

    /**
     * Get lugar
     *
     * @return string 
     */
    public function getLugar()
    {
        return $this->lugar;
    }

    /**
     * Add curadores
     *
     * @param \BaseVideoArte\Entidades\Persona $curadores
     * @return Evento
     */
    public function addCurador(\BaseVideoArte\Entidades\Persona $curadores)
    {
        $this->curadores[] = $curadores;
    
        return $this;
    }

    /**
     * Remove curadores
     *
     * @param \BaseVideoArte\Entidades\Persona $curadores
     */
    public function removeCurador(\BaseVideoArte\Entidades\Persona $curadores)
    {
        $this->curadores->removeElement($curadores);
    }

    /**
     * Get curadores
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCuradores()
    {
        return $this->curadores;
    }

    /**
     * Set pais
     *
     * @param \BaseVideoArte\Entidades\Pais $pais
     * @return Evento
     */
    public function setPais(\BaseVideoArte\Entidades\Pais $pais = null)
    {
        $this->pais = $pais;
    
        return $this;
    }

    /**
     * Get pais
     *
     * @return \BaseVideoArte\Entidades\Pais 
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Add obras
     *
     * @param \BaseVideoArte\Entidades\Obra $obras
     * @return Evento
     */
    public function addObra(\BaseVideoArte\Entidades\Obra $obras)
    {
        $this->obras[] = $obras;
    
        return $this;
    }

    /**
     * Remove obras
     *
     * @param \BaseVideoArte\Entidades\Obra $obras
     */
    public function removeObra(\BaseVideoArte\Entidades\Obra $obras)
    {
        $this->obras->removeElement($obras);
    }

    /**
     * Get obras
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getObras()
    {
        return $this->obras;
    }

    /**
     * Add medios
     *
     * @param \BaseVideoArte\Entidades\Medio $medios
     * @return Evento
     */
    public function addMedio(\BaseVideoArte\Entidades\Medio $medios)
    {
        $this->medios[] = $medios;
    
        return $this;
    }

    /**
     * Remove medios
     *
     * @param \BaseVideoArte\Entidades\Medio $medios
     */
    public function removeMedio(\BaseVideoArte\Entidades\Medio $medios)
    {
        $this->medios->removeElement($medios);
    }

    /**
     * Get medios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMedios()
    {
        return $this->medios;
    }

    /**
     * Add metadatos
     *
     * @param \BaseVideoArte\Entidades\MetadatoEvento $metadatos
     * @return Evento
     */
    public function addMetadato(\BaseVideoArte\Entidades\MetadatoEvento $metadatos)
    {
        $this->metadatos[] = $metadatos;
    
        return $this;
    }

    /**
     * Remove metadatos
     *
     * @param \BaseVideoArte\Entidades\MetadatoEvento $metadatos
     */
    public function removeMetadato(\BaseVideoArte\Entidades\MetadatoEvento $metadatos)
    {
        $this->metadatos->removeElement($metadatos);
    }

    /**
     * Get metadatos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMetadatos()
    {
        return $this->metadatos;
    }
}