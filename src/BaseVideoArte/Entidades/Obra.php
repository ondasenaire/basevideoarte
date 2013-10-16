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
	 * @ManyToMany(targetEntity="Persona", mappedBy="colaboraciones")
	 */
	private $colaboradores;


	/**
	 * @ManyToMany(targetEntity="Evento", mappedBy="obras")
	 */
	private $eventos;

	/**
	 * @ManyToMany(targetEntity="Medio", inversedBy="obras",cascade={"persist"})
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
     * @OneToMany(targetEntity="MetadatoObra", mappedBy="obra")
     **/
	private $metadatos;
	//-----FUNCIONES

	public function __construct($titulo,$sinopsis,$anho,$duracion) {
		
		$this->titulo = $titulo;
		$this->sinopsis = $sinopsis;
		$this->anho = $anho;
		$this->duracion = $duracion;		
		
		$this -> metadatos = new \Doctrine\Common\Collections\ArrayCollection();
		$this -> formatos = new \Doctrine\Common\Collections\ArrayCollection();
		$this -> generos = new \Doctrine\Common\Collections\ArrayCollection();
		$this -> artistas = new \Doctrine\Common\Collections\ArrayCollection();
		$this -> eventos = new \Doctrine\Common\Collections\ArrayCollection();
		$this -> medios = new \Doctrine\Common\Collections\ArrayCollection();
		$this -> palabrasClave = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set titulo
     *
     * @param string $titulo
     * @return Obra
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    
        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set sinopsis
     *
     * @param string $sinopsis
     * @return Obra
     */
    public function setSinopsis($sinopsis)
    {
        $this->sinopsis = $sinopsis;
    
        return $this;
    }

    /**
     * Get sinopsis
     *
     * @return string 
     */
    public function getSinopsis()
    {
        return $this->sinopsis;
    }

    /**
     * Set anho
     *
     * @param string $anho
     * @return Obra
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
     * Set duracion
     *
     * @param string $duracion
     * @return Obra
     */
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;
    
        return $this;
    }

    /**
     * Get duracion
     *
     * @return string 
     */
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * Add generos
     *
     * @param \BaseVideoArte\Entidades\Genero $generos
     * @return Obra
     */
    public function addGenero(\BaseVideoArte\Entidades\Genero $generos)
    {
        $this->generos[] = $generos;
    
        return $this;
    }

    /**
     * Remove generos
     *
     * @param \BaseVideoArte\Entidades\Genero $generos
     */
    public function removeGenero(\BaseVideoArte\Entidades\Genero $generos)
    {
        $this->generos->removeElement($generos);
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
     * Add formatos
     *
     * @param \BaseVideoArte\Entidades\Formato $formatos
     * @return Obra
     */
    public function addFormato(\BaseVideoArte\Entidades\Formato $formatos)
    {
        $this->formatos[] = $formatos;
    
        return $this;
    }

    /**
     * Remove formatos
     *
     * @param \BaseVideoArte\Entidades\Formato $formatos
     */
    public function removeFormato(\BaseVideoArte\Entidades\Formato $formatos)
    {
        $this->formatos->removeElement($formatos);
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

    /**
     * Add artistas
     *
     * @param \BaseVideoArte\Entidades\Persona $artistas
     * @return Obra
     */
    public function addArtista(\BaseVideoArte\Entidades\Persona $artistas)
    {
        $this->artistas[] = $artistas;
    
        return $this;
    }

    /**
     * Remove artistas
     *
     * @param \BaseVideoArte\Entidades\Persona $artistas
     */
    public function removeArtista(\BaseVideoArte\Entidades\Persona $artistas)
    {
        $this->artistas->removeElement($artistas);
    }

    /**
     * Get artistas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArtistas()
    {
        return $this->artistas;
    }

    /**
     * Add eventos
     *
     * @param \BaseVideoArte\Entidades\Evento $eventos
     * @return Obra
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
     * Add medios
     *
     * @param \BaseVideoArte\Entidades\Medio $medios
     * @return Obra
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
     * Add palabrasClave
     *
     * @param \BaseVideoArte\Entidades\PalabraClave $palabrasClave
     * @return Obra
     */
    public function addPalabrasClave(\BaseVideoArte\Entidades\PalabraClave $palabrasClave)
    {
        $this->palabrasClave[] = $palabrasClave;
    
        return $this;
    }

    /**
     * Remove palabrasClave
     *
     * @param \BaseVideoArte\Entidades\PalabraClave $palabrasClave
     */
    public function removePalabrasClave(\BaseVideoArte\Entidades\PalabraClave $palabrasClave)
    {
        $this->palabrasClave->removeElement($palabrasClave);
    }

    /**
     * Get palabrasClave
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPalabrasClave()
    {
        return $this->palabrasClave;
    }

    /**
     * Add metadatos
     *
     * @param \BaseVideoArte\Entidades\MetadatoObra $metadatos
     * @return Obra
     */
    public function addMetadato(\BaseVideoArte\Entidades\MetadatoObra $metadatos)
    {
        $this->metadatos[] = $metadatos;
    
        return $this;
    }

    /**
     * Remove metadatos
     *
     * @param \BaseVideoArte\Entidades\MetadatoObra $metadatos
     */
    public function removeMetadato(\BaseVideoArte\Entidades\MetadatoObra $metadatos)
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