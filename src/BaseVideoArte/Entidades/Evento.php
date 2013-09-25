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
	 * @Column(type="date")
	 */	
	private $fecha;
	//
	//private $curadores;
	/**
	 * @Column(type="text")
	 */	
	private $info;
	
	/**
	 * @Column(type="string")
	 */
	private $lugar;
	
	/**
	 * @ManyToOne(targetEntity="Pais")
	 * @JoinColumn(name="pais_id", referencedColumnName="id")
	 */
	private $pais;
	
	//--CAMPOS RELACIONADOS
	
	/**
	 * @ManyToMany(targetEntity="Obra", inversedBy="eventos")
	 * @JoinTable(name="obras_x_evento")
	 */
	private $obras;
	
	
	//--------------------
	    /**
     * Constructor
     */
    public function __construct()
    {
        $this->obras = new \Doctrine\Common\Collections\ArrayCollection();
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
}