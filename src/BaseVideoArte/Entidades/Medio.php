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
	private $archivo;
	// ruta al archivo o url de un link
	
	 //* @ManyToOne(targetEntity="TipoDeMedio")
	//@JoinColumn(name="tipo_medio_id", referencedColumnName="id")
	 /**
	  * @Column(type="integer")
	  */
	private $tipo;

	/**
	 * @Column(type="string")
	 */
	private $descripcion;

	//-------------------------
	/**
	 * @ManyToMany(targetEntity="Obra", mappedBy="medios")
	 **/
	private $obras;
	/**
	 * @ManyToMany(targetEntity="Persona", mappedBy="medios")
	 **/
	private $personas;
	/**
	 * @ManyToMany(targetEntity="Evento", mappedBy="medios")
	 **/
	private $eventos;

	//---------------------------------------

	public function __construct($medio, $descripcion, $tipo) {

		$this -> archivo = $medio;
		$this -> tipo = $tipo;
		$this -> descripcion = $descripcion;

		
		if (gettype($tipo) == 'string') {
			$ind = array_search($tipo, $this -> getTipos());
			$this -> tipo = $ind;
		} else {
			$this -> tipo = $tipo;
		}

		$this -> obras = new \Doctrine\Common\Collections\ArrayCollection();
	}

	public function getTipos() {
		return array('1' => 'imagen principal', '2' => 'galeria', '3' => 'link', '4' => 'video', '5' => 'video embebido', );
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
     * Set archivo
     *
     * @param string $archivo
     * @return Medio
     */
    public function setArchivo($archivo)
    {
        $this->archivo = $archivo;
    
        return $this;
    }

    /**
     * Get archivo
     *
     * @return string 
     */
    public function getArchivo()
    {
        return $this->archivo;
    }

    /**
     * Set tipo
     *
     * @param \BaseVideoArte\Entidades\TipoDeMedio $tipo
     * @return Medio
     */
    public function setTipo(\BaseVideoArte\Entidades\TipoDeMedio $tipo = null)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return \BaseVideoArte\Entidades\TipoDeMedio 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Add obras
     *
     * @param \BaseVideoArte\Entidades\Obra $obras
     * @return Medio
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
     * Add personas
     *
     * @param \BaseVideoArte\Entidades\Persona $personas
     * @return Medio
     */
    public function addPersona(\BaseVideoArte\Entidades\Persona $personas)
    {
        $this->personas[] = $personas;
    
        return $this;
    }

    /**
     * Remove personas
     *
     * @param \BaseVideoArte\Entidades\Persona $personas
     */
    public function removePersona(\BaseVideoArte\Entidades\Persona $personas)
    {
        $this->personas->removeElement($personas);
    }

    /**
     * Get personas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPersonas()
    {
        return $this->personas;
    }

    /**
     * Add eventos
     *
     * @param \BaseVideoArte\Entidades\Evento $eventos
     * @return Medio
     */
    public function addEvento(\BaseVideoArte\Entidades\Evento $eventos)
    {
        $this->eventos[] = $eventos;
    
        return $this;
    }

    /**
     * Remove eventos
     *
     * @param \BaseVideoArte\Entidades\Evento $eventos
     */
    public function removeEvento(\BaseVideoArte\Entidades\Evento $eventos)
    {
        $this->eventos->removeElement($eventos);
    }

    /**
     * Get eventos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEventos()
    {
        return $this->eventos;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Medio
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
}