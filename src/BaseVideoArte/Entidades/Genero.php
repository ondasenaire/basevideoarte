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
	 * @ManyToMany(targetEntity="Obra", mappedBy="generos")
	 */

	private $obras;

//------------------------------------------------------------
	public function __construct($genero ){
		$this->genero = $genero;
		$this->obras = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Add obras
     *
     * @param \BaseVideoArte\Entidades\Obra $obras
     * @return Genero
     */
    public function addObra(\BaseVideoArte\Entidades\Obra $obras)
    {
        $this->obras[] = $obras;
    
        return $this;
    }

    /**
     * Remove obras
     *
     * @param \BaseVideoArte\Entidades\Obra $obras
     */
    public function removeObra(\BaseVideoArte\Entidades\Obra $obras)
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