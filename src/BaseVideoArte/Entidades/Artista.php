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
	private $info;
	private $inicio;
	private $web;


	//

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