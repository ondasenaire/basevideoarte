<?php

namespace BaseVideoArte\Entidades;

use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity
 * @Table(name="palabras_clave")
 */
class PalabraClave {
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
	 * @ManyToMany(targetEntity="Obra", mappedBy="palabrasClave")
	 */
	private $obras;
	//---------------------------------------

	public function __construct($palabra) {
		$this->palabra = $palabra;
		$this -> obras = new \Doctrine\Common\Collections\ArrayCollection();
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
	 * Set palabra
	 *
	 * @param string $palabra
	 * @return PalabraClave
	 */
	public function setPalabra($palabra) {
		$this -> palabra = $palabra;

		return $this;
	}

	/**
	 * Get palabra
	 *
	 * @return string
	 */
	public function getPalabra() {
		return $this -> palabra;
	}


    /**
     * Add obras
     *
     * @param \BaseVideoArte\Entidades\Obras $obras
     * @return PalabraClave
     */
    public function addObra(\BaseVideoArte\Entidades\Obras $obras)
    {
        $this->obras[] = $obras;
    
        return $this;
    }

    /**
     * Remove obras
     *
     * @param \BaseVideoArte\Entidades\Obras $obras
     */
    public function removeObra(\BaseVideoArte\Entidades\Obras $obras)
    {
        $this->obras->removeElement($obras);
    }

    /**
     * Get obras
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getObras()
    {
        return $this->obras;
    }
}