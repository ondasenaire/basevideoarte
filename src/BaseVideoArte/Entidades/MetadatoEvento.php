<?php
namespace BaseVideoArte\Entidades;
/**
 * @Entity
 */
class MetadatoEvento extends Metadato{
	/**
	 * @ManyToOne(targetEntity="Evento", inversedBy="metadatos")
	 * @JoinColumn(name="evento_id", referencedColumnName="id")
	 **/
	private $evento;
	
	
	public function __construct($metadato, $tipo) {
		//acepta tipo en integer y en string
		parent::__construct();
		$this -> metadato = $metadato;
		if (gettype($tipo) == 'string') {
			$ind = array_search($tipo, $this -> getTipos());
			$this->tipo = $ind;
		} else {
			$this -> tipo = $tipo;
		}
		$this -> obra = new \Doctrine\Common\Collections\ArrayCollection();
	}

	public function getTipos() {
		return array('1' => 'nombre', 
					 '2' => 'anho',
					 '3' => 'web', 
					 '4' => 'info', 
					 '5' => 'lugar', 
					 '6' => 'curadores', 
					 '7' => 'obras', 
					 '8' => 'pais');
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
     * @return MetadatoEvento
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
     * @return MetadatoEvento
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
     * Set evento
     *
     * @param \BaseVideoArte\Entidades\Evento $evento
     * @return MetadatoEvento
     */
    public function setEvento(\BaseVideoArte\Entidades\Evento $evento = null)
    {
        $this->evento = $evento;
    
        return $this;
    }

    /**
     * Get evento
     *
     * @return \BaseVideoArte\Entidades\Evento 
     */
    public function getEvento()
    {
        return $this->evento;
    }
}