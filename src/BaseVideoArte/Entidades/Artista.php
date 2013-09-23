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
}