<?php
namespace BaseVideoArte\Entidades;
/**
 * @Entity
 * @Table(name="metadatos")
 */
class Metadato {
	/**
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */
	private $id;
	/**
	 * @Column(type="string")
	 */
	private $metadato;

	/**
	 * @Column(type="integer")
	 */
	private $tipo;
	
	
	/**
	 * @Column(type="integer")
	 */
	private $categoria;
	

//-------------------------------------------

    /**
     * @ManyToOne(targetEntity="Persona", inversedBy="metadatos")
     * @JoinColumn(name="entidad_id", referencedColumnName="id")
     **/
	private $persona;
    /**
     * @ManyToOne(targetEntity="Obra", inversedBy="metadatos")
     * @JoinColumn(name="entidad_id", referencedColumnName="id")
     **/
	private $obra;
    /**
     * @ManyToOne(targetEntity="Evento", inversedBy="metadatos")
     * @JoinColumn(name="entidad_id", referencedColumnName="id")
     **/
	private $evento;
	
	
	

	//-------------------
	 public function __construct(){
		
	 }
	//porobando pra reducir cantidad de entidades
	public function getTipos($cat) {// retorno array para opciones

		$tipos = array(
			'evento' => array(), 
			'obra' => array(), 
			'persona' => array(
					'1' => 'nombre',
					'2' => 'apellido', 
					'3' => 'pais', 
					'4' => 'web', 
					'5' => 'inicio', 
					'6' => 'formato', 
					'7' => 'titulo', 
					),
			);

		return $tipos[$cat];
	}

	public function setTipo($t) {
		$this -> tipo = $t;
	}

	/* VER ESTO*/
	public function getSTipo($cat) {
		$s = "";
		if (isset($this -> tipo)) {
			$s = $this -> getTipos($cat);
			$s = $s[$this -> tipo];
		}

		return $s;
	}

	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId() {
		return $this -> id;
	}

	/**
	 * Set metadato
	 *
	 * @param string $metadato
	 * @return Metadato
	 */
	public function setMetadato($metadato) {
		$this -> metadato = $metadato;

		return $this;
	}

	/**
	 * Get metadato
	 *
	 * @return string
	 */
	public function getMetadato() {
		return $this -> metadato;
	}

	/**
	 * Get tipo
	 *
	 * @return integer
	 */
	public function getTipo() {
		return $this -> tipo;
	}


    /**
     * Set categoria
     *
     * @param integer $categoria
     * @return Metadato
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    
        return $this;
    }

    /**
     * Get categoria
     *
     * @return integer 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set persona
     *
     * @param \BaseVideoArte\Entidades\Persona $persona
     * @return Metadato
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

    /**
     * Set obra
     *
     * @param \BaseVideoArte\Entidades\Obra $obra
     * @return Metadato
     */
    public function setObra(\BaseVideoArte\Entidades\Obra $obra = null)
    {
        $this->obra = $obra;
    
        return $this;
    }

    /**
     * Get obra
     *
     * @return \BaseVideoArte\Entidades\Obra 
     */
    public function getObra()
    {
        return $this->obra;
    }

    /**
     * Set evento
     *
     * @param \BaseVideoArte\Entidades\Evento $evento
     * @return Metadato
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