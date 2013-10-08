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
    public function __construct()
    {
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Evento
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
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
     * Add curadores
     *
     * @param \BaseVideoArte\Entidades\Persona $curadores
     * @return Evento
     */
    public function addCuradore(\BaseVideoArte\Entidades\Persona $curadores)
    {
        $this->curadores[] = $curadores;
    
        return $this;
    }

    /**
     * Remove curadores
     *
     * @param \BaseVideoArte\Entidades\Persona $curadores
     */
    public function removeCuradore(\BaseVideoArte\Entidades\Persona $curadores)
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
}