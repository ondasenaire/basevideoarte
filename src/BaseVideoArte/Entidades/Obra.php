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
	 */
	private $id;
	
	/**
	 * @Column(type="string")
	 */
	private $titulo;
	
	/**
	 * @Column(type="text")
	 */
	private $descripcion;
	
	/**
	 * @Column(type="string")
	 */
	private $anho;
	/**
	 * @Column(type="string")
	 */
	private $duracion;
	
	//--------------
	/**
	 * @OneToOne(targetEntity="Genero")
     * @JoinColumn(name="genero_id", referencedColumnName="id")
	 */
	private $genero;
	
	/**
	 * @OneToOne(targetEntity="Formato")
     * @JoinColumn(name="formato_id", referencedColumnName="id")
	 */
	private $formato;
	
	
	

    /**
     * Set id
     *
     * @param integer $id
     * @return Obra
     */
    public function setId($id)
    {
        $this->id = $id;
    
        return $this;
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Obra
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
     * Set genero
     *
     * @param \BaseVideoArte\Entidades\Genero $genero
     * @return Obra
     */
    public function setGenero(\BaseVideoArte\Entidades\Genero $genero = null)
    {
        $this->genero = $genero;
    
        return $this;
    }

    /**
     * Get genero
     *
     * @return \BaseVideoArte\Entidades\Genero 
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Set formato
     *
     * @param \BaseVideoArte\Entidades\Formato $formato
     * @return Obra
     */
    public function setFormato(\BaseVideoArte\Entidades\Formato $formato = null)
    {
        $this->formato = $formato;
    
        return $this;
    }

    /**
     * Get formato
     *
     * @return \BaseVideoArte\Entidades\Formato 
     */
    public function getFormato()
    {
        return $this->formato;
    }
}