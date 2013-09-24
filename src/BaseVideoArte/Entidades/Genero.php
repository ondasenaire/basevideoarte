<?php
namespace BaseVideoArte\Entidades;
/**
 * @Entity
 * @Table(name="generos")
 */
class Genero {
	/**
	 * @Id
	 *  @Column(type="integer")
	 * @GeneratedValue
	 *
	 */
	private $id;
	
	/**
	 * @Column(type="string")
	 */
	private $genero;

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
     * Set genero
     *
     * @param string $genero
     * @return Genero
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;
    
        return $this;
    }

    /**
     * Get genero
     *
     * @return string 
     */
    public function getGenero()
    {
        return $this->genero;
    }
}