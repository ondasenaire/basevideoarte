<?php
// src/MyWebsite/Entity/Persona.php
namespace BaseVideoArte\Entidades;

/**
 * @Entity
 * @Table(name="personas")
 */
class Persona {
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
	/** @Column(type="boolean")*/
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
	 * @ManyToMany(targetEntity="Evento", mappedBy="curadores")
	 *
	 */
	private $eventos;
	// eventos en los que la persona participo como curador

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

    /**
     * @OneToMany(targetEntity="Metadato", mappedBy="persona")
     **/
	private $metadatos;
	//--------CONSTRUCTOR-------
	public function __construct() {
		$this -> metadatos = new \Doctrine\Common\Collections\ArrayCollection();
		$this -> obras = new \Doctrine\Common\Collections\ArrayCollection();
		$this -> eventos = new \Doctrine\Common\Collections\ArrayCollection();
		$this -> medios = new \Doctrine\Common\Collections\ArrayCollection();
	}

	//-----------------------------

	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId() {
		return $this -> id;
	}

	/**
	 * Set nombre
	 *
	 * @param string $nombre
	 * @return Persona
	 */
	public function setNombre($nombre) {
		$this -> nombre = $nombre;

		return $this;
	}

	/**
	 * Get nombre
	 *
	 * @return string
	 */
	public function getNombre() {
		return $this -> nombre;
	}

	/**
	 * Set apellido
	 *
	 * @param string $apellido
	 * @return Persona
	 */
	public function setApellido($apellido) {
		$this -> apellido = $apellido;

		return $this;
	}

	/**
	 * Get apellido
	 *
	 * @return string
	 */
	public function getApellido() {
		return $this -> apellido;
	}

	/**
	 * Set data
	 *
	 * @param string $data
	 * @return Persona
	 */
	public function setData($data) {
		$this -> data = $data;

		return $this;
	}

	/**
	 * Get data
	 *
	 * @return string
	 */
	public function getData() {
		return $this -> data;
	}

	/**
	 * Set inicio
	 *
	 * @param string $inicio
	 * @return Persona
	 */
	public function setInicio($inicio) {
		$this -> inicio = $inicio;

		return $this;
	}

	/**
	 * Get inicio
	 *
	 * @return string
	 */
	public function getInicio() {
		return $this -> inicio;
	}

	/**
	 * Set web
	 *
	 * @param string $web
	 * @return Persona
	 */
	public function setWeb($web) {
		$this -> web = $web;

		return $this;
	}

	/**
	 * Get web
	 *
	 * @return string
	 */
	public function getWeb() {
		return $this -> web;
	}

	/**
	 * Set sexo
	 *
	 * @param string $sexo
	 * @return Persona
	 */
	public function setSexo($sexo) {
		$this -> sexo = $sexo;

		return $this;
	}

	/**
	 * Get sexo
	 *
	 * @return string
	 */
	public function getSexo() {
		return $this -> sexo;
	}

	/**
	 * Set tipo
	 *
	 * @param \BaseVideoArte\Entidades\TipoDePersona $tipo
	 * @return Persona
	 */
	public function setTipo(\BaseVideoArte\Entidades\TipoDePersona $tipo = null) {
		$this -> tipo = $tipo;

		return $this;
	}

	/**
	 * Get tipo
	 *
	 * @return \BaseVideoArte\Entidades\TipoDePersona
	 */
	public function getTipo() {
		return $this -> tipo;
	}

	/**
	 * Set pais
	 *
	 * @param \BaseVideoArte\Entidades\Pais $pais
	 * @return Persona
	 */
	public function setPais(\BaseVideoArte\Entidades\Pais $pais = null) {
		$this -> pais = $pais;

		return $this;
	}

	/**
	 * Get pais
	 *
	 * @return \BaseVideoArte\Entidades\Pais
	 */
	public function getPais() {
		return $this -> pais;
	}

	/**
	 * Add obras
	 *
	 * @param \BaseVideoArte\Entidades\Obra $obras
	 * @return Persona
	 */
	public function addObra(\BaseVideoArte\Entidades\Obra $obras) {
		$this -> obras[] = $obras;

		return $this;
	}

	/**
	 * Remove obras
	 *
	 * @param \BaseVideoArte\Entidades\Obra $obras
	 */
	public function removeObra(\BaseVideoArte\Entidades\Obra $obras) {
		$this -> obras -> removeElement($obras);
	}

	/**
	 * Get obras
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getObras() {
		return $this -> obras;
	}

	/**
	 * Add eventos
	 *
	 * @param \BaseVideoArte\Entidades\Evento $eventos
	 * @return Persona
	 */
	public function addEvento(\BaseVideoArte\Entidades\Evento $eventos) {
		$this -> eventos[] = $eventos;

		return $this;
	}

	/**
	 * Remove eventos
	 *
	 * @param \BaseVideoArte\Entidades\Evento $eventos
	 */
	public function removeEvento(\BaseVideoArte\Entidades\Evento $eventos) {
		$this -> eventos -> removeElement($eventos);
	}

	/**
	 * Get eventos
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getEventos() {
		return $this -> eventos;
	}

	/**
	 * Add medios
	 *
	 * @param \BaseVideoArte\Entidades\Medio $medios
	 * @return Persona
	 */
	public function addMedio(\BaseVideoArte\Entidades\Medio $medios) {
		$this -> medios[] = $medios;

		return $this;
	}

	/**
	 * Remove medios
	 *
	 * @param \BaseVideoArte\Entidades\Medio $medios
	 */
	public function removeMedio(\BaseVideoArte\Entidades\Medio $medios) {
		$this -> medios -> removeElement($medios);
	}

	/**
	 * Get medios
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getMedios() {
		return $this -> medios;
	}

	/**
	 * Set mostrar
	 *
	 * @param boolean $mostrar
	 * @return Persona
	 */
	public function setMostrar($mostrar) {
		$this -> mostrar = $mostrar;

		return $this;
	}

	/**
	 * Get mostrar
	 *
	 * @return boolean
	 */
	public function getMostrar() {
		return $this -> mostrar;
	}


    /**
     * Add metadatos
     *
     * @param \BaseVideoArte\Entidades\Metadato $metadatos
     * @return Persona
     */
    public function addMetadato(\BaseVideoArte\Entidades\Metadato $metadatos)
    {
        $this->metadatos[] = $metadatos;
    
        return $this;
    }

    /**
     * Remove metadatos
     *
     * @param \BaseVideoArte\Entidades\Metadato $metadatos
     */
    public function removeMetadato(\BaseVideoArte\Entidades\Metadato $metadatos)
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