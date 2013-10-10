<?php

namespace BaseVideoArte\Entidades;

//use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity
 */
class MetadatoPersona extends Metadato {
	/**
	 * @ManyToOne(targetEntity="Persona", inversedBy="metadatos", cascade={"persist", "remove"})
	 * @JoinColumn(name="persona_id", referencedColumnName="id")
	 **/
	private $persona;
	
	
	    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $metadato;

    /**
     * @var integer
     */
    protected $tipo;
	

	public function __construct($metadato, $tipo) {
		parent::__construct();
		$this -> metadato = $metadato;
		if (gettype($tipo) == 'string') {
			$ind = array_search($tipo, $this -> getTipos());
			$this->tipo = $ind;
		} else {
			$this -> tipo = $tipo;
		}
		$this -> persona = new \Doctrine\Common\Collections\ArrayCollection();
	}

	public function getTipos() {
		return array('1' => 'nombre', '2' => 'apellido', '3' => 'pais', '4' => 'web', '5' => 'inicio', '6' => 'obras', '7' => 'eventos');
	}

	public function getSTipo() {
		$s = "";
		if (isset($this -> tipo)) {
			$s = $this -> getTipos();
			$s = $s[$this -> tipo];
		}

		return $s;
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
     * Set metadato
     *
     * @param string $metadato
     * @return MetadatoPersona
     */
    public function setMetadato($metadato)
    {
        $this->metadato = $metadato;
    
        return $this;
    }

    /**
     * Get metadato
     *
     * @return string 
     */
    public function getMetadato()
    {
        return $this->metadato;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     * @return MetadatoPersona
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set persona
     *
     * @param \BaseVideoArte\Entidades\Persona $persona
     * @return MetadatoPersona
     */
    public function setPersona(\BaseVideoArte\Entidades\Persona $persona = null)
    {
        $this->persona = $persona;
    
        return $this;
    }

    /**
     * Get persona
     *
     * @return \BaseVideoArte\Entidades\Persona 
     */
    public function getPersona()
    {
        return $this->persona;
    }
}