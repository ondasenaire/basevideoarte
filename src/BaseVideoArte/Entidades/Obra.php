<?php
namespace BaseVideoArte\Entidades;
/**
 * @Entity
 * @Table(name="obras")
 */
class Obra {
	/**
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */
	private $id;

	/**
	 * @Column(type="string")
	 */
	private $titulo;

	/**  @Column(type="text")*/
	private $sinopsis;

	/** @Column(type="string") */
	private $anho;
	/**
	 * @Column(type="string")
	 */
	private $duracion;

	//---CAMPOS RELACIONADOS
	/**
	 * @ManyToMany(targetEntity="Genero", inversedBy="obras")
	 * @JoinTable(name="generos_x_obra")
	 */
	private $generos;

	/**
	 * @ManyToMany(targetEntity="Formato", inversedBy="obras")
	 * @JoinTable(name="formatos_x_obra")
	 */
	private $formatos;

	/**
	 * @ManyToMany(targetEntity="Persona", mappedBy="obras")
	 */
	private $artistas;

	/**
	 * @ManyToMany(targetEntity="Evento", mappedBy="obras")
	 */
	private $eventos;

	/**
	 * @ManyToMany(targetEntity="Medio", inversedBy="obras")
	 * @JoinTable(name="medios_x_obra")
	 */
	private $medios;
	//imagenes, videos,links ,etc

	/**
	 * @ManyToMany(targetEntity="PalabraClave", inversedBy="obras")
	 * @JoinTable(name="palabras_x_obra")
	 */
	private $palabrasClave;

    /**
     * @OneToMany(targetEntity="Metadato", mappedBy="obra")
     **/
	private $metadatos;
	//-----FUNCIONES

	public function __construct() {
		$this -> metadatos = new \Doctrine\Common\Collections\ArrayCollection();
		$this -> formatos = new \Doctrine\Common\Collections\ArrayCollection();
		$this -> generos = new \Doctrine\Common\Collections\ArrayCollection();
		$this -> artistas = new \Doctrine\Common\Collections\ArrayCollection();
		$this -> eventos = new \Doctrine\Common\Collections\ArrayCollection();
		$this -> medios = new \Doctrine\Common\Collections\ArrayCollection();
		$this -> palabrasClave = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Set id
	 *
	 * @param integer $id
	 * @return Obra
	 */
	public function setId($id) {
		$this -> id = $id;

		return $this;
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
	 * Set titulo
	 *
	 * @param string $titulo
	 * @return Obra
	 */
	public function setTitulo($titulo) {
		$this -> titulo = $titulo;

		return $this;
	}

	/**
	 * Get titulo
	 *
	 * @return string
	 */
	public function getTitulo() {
		return $this -> titulo;
	}

	/**
	 * Set descripcion
	 *
	 * @param string $descripcion
	 * @return Obra
	 */
	public function setDescripcion($descripcion) {
		$this -> descripcion = $descripcion;

		return $this;
	}

	/**
	 * Get descripcion
	 *
	 * @return string
	 */
	public function getDescripcion() {
		return $this -> descripcion;
	}

	/**
	 * Set anho
	 *
	 * @param string $anho
	 * @return Obra
	 */
	public function setAnho($anho) {
		$this -> anho = $anho;

		return $this;
	}

	/**
	 * Get anho
	 *
	 * @return string
	 */
	public function getAnho() {
		return $this -> anho;
	}

	/**
	 * Set duracion
	 *
	 * @param string $duracion
	 * @return Obra
	 */
	public function setDuracion($duracion) {
		$this -> duracion = $duracion;

		return $this;
	}

	/**
	 * Get duracion
	 *
	 * @return string
	 */
	public function getDuracion() {
		return $this -> duracion;
	}

	/**
	 * Set genero
	 *
	 * @param \BaseVideoArte\Entidades\Genero $genero
	 * @return Obra
	 */
	public function setGenero(\BaseVideoArte\Entidades\Genero $genero = null) {
		$this -> genero = $genero;

		return $this;
	}

	/**
	 * Get genero
	 *
	 * @return \BaseVideoArte\Entidades\Genero
	 */
	public function getGenero() {
		return $this -> genero;
	}

	/**
	 * Set formato
	 *
	 * @param \BaseVideoArte\Entidades\Formato $formato
	 * @return Obra
	 */
	public function setFormato(\BaseVideoArte\Entidades\Formato $formato = null) {
		$this -> formato = $formato;

		return $this;
	}

	/**
	 * Get formato
	 *
	 * @return \BaseVideoArte\Entidades\Formato
	 */
	public function getFormato() {
		return $this -> formato;
	}

	/**
	 * Add artistas
	 *
	 * @param \BaseVideoArte\Entidades\Artista $artistas
	 * @return Obra
	 */
	public function addArtista(\BaseVideoArte\Entidades\Artista $artistas) {
		$this -> artistas[] = $artistas;

		return $this;
	}

	/**
	 * Remove artistas
	 *
	 * @param \BaseVideoArte\Entidades\Artista $artistas
	 */
	public function removeArtista(\BaseVideoArte\Entidades\Artista $artistas) {
		$this -> artistas -> removeElement($artistas);
	}

	/**
	 * Get artistas
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getArtistas() {
		return $this -> artistas;
	}

	/**
	 * Add eventos
	 *
	 * @param \BaseVideoArte\Entidades\Evento $eventos
	 * @return Obra
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
	 * @return Obra
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
	 * Set sinopsis
	 *
	 * @param string $sinopsis
	 * @return Obra
	 */
	public function setSinopsis($sinopsis) {
		$this -> sinopsis = $sinopsis;

		return $this;
	}

	/**
	 * Get sinopsis
	 *
	 * @return string
	 */
	public function getSinopsis() {
		return $this -> sinopsis;
	}

	/**
	 * Add genero
	 *
	 * @param \BaseVideoArte\Entidades\Genero $genero
	 * @return Obra
	 */
	public function addGenero(\BaseVideoArte\Entidades\Genero $genero) {
		$this -> genero[] = $genero;

		return $this;
	}

	/**
	 * Remove genero
	 *
	 * @param \BaseVideoArte\Entidades\Genero $genero
	 */
	public function removeGenero(\BaseVideoArte\Entidades\Genero $genero) {
		$this -> genero -> removeElement($genero);
	}

	/**
	 * Add formato
	 *
	 * @param \BaseVideoArte\Entidades\Formato $formato
	 * @return Obra
	 */
	public function addFormato(\BaseVideoArte\Entidades\Formato $formato) {
		$this -> formato[] = $formato;

		return $this;
	}

	/**
	 * Remove formato
	 *
	 * @param \BaseVideoArte\Entidades\Formato $formato
	 */
	public function removeFormato(\BaseVideoArte\Entidades\Formato $formato) {
		$this -> formato -> removeElement($formato);
	}

	/**
	 * Add palabrasClave
	 *
	 * @param \BaseVideoArte\Entidades\PalabraClave $palabrasClave
	 * @return Obra
	 */
	public function addPalabrasClave(\BaseVideoArte\Entidades\PalabraClave $palabrasClave) {
		$this -> palabrasClave[] = $palabrasClave;

		return $this;
	}

	/**
	 * Remove palabrasClave
	 *
	 * @param \BaseVideoArte\Entidades\PalabraClave $palabrasClave
	 */
	public function removePalabrasClave(\BaseVideoArte\Entidades\PalabraClave $palabrasClave) {
		$this -> palabrasClave -> removeElement($palabrasClave);
	}

	/**
	 * Get palabrasClave
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getPalabrasClave() {
		return $this -> palabrasClave;
	}


    /**
     * Get generos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGeneros()
    {
        return $this->generos;
    }

    /**
     * Get formatos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFormatos()
    {
        return $this->formatos;
    }
}