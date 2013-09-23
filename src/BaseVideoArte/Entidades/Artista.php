<?php
// src/MyWebsite/Entity/Article.php
namespace BaseVideoArte\Entidades;
/**
 * @Entity
 * @Table(name="artistas")
 */
class Artista {

    /** 
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /** @Column(type="string") */
    private $nombre;
	
	/** @Column(type="text") */
	private $info;
	/** @Column(type="string") */
	private $inicio;
	/** @Column(type="string") */
	private $web;

	/**
	 *    
     * @OneToOne(targetEntity="Pais")
     * @JoinColumn(name="pais_id", referencedColumnName="id")
     */	 
	private $pais;
	
	

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
     * @return Artista
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
     * Set info
     *
     * @param string $info
     * @return Artista
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
     * Set inicio
     *
     * @param string $inicio
     * @return Artista
     */
    public function setInicio($inicio)
    {
        $this->inicio = $inicio;
    
        return $this;
    }

    /**
     * Get inicio
     *
     * @return string 
     */
    public function getInicio()
    {
        return $this->inicio;
    }

    /**
     * Set web
     *
     * @param string $web
     * @return Artista
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

    /**
     * Set pais
     *
     * @param \BaseVideoArte\Entidades\Pais $pais
     * @return Artista
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
}