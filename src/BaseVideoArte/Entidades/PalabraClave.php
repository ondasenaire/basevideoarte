<?php

namespace BaseVideoArte\Entidades;

use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity
 * @Table(name="palabras_clave")
 */
class PalabraClave
{
	/**
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */
	private $id;
	/**
	 * @Column(type="string")
	 */
	private $palabra;
	
	


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
     * Set palabra
     *
     * @param string $palabra
     * @return PalabraClave
     */
    public function setPalabra($palabra)
    {
        $this->palabra = $palabra;
    
        return $this;
    }

    /**
     * Get palabra
     *
     * @return string 
     */
    public function getPalabra()
    {
        return $this->palabra;
    }
}