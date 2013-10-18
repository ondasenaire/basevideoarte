<?php
namespace BaseVideoArte\Entidades;
/**
 * @Entity
 * @Table(name="tipo_de_persona")
 */
 class TipoDePersona{
 	/**
	 * @Id @Column(type="integer") @GeneratedValue
	 */
	private $id;
	/** @Column(type="string") */
	private $tipo;
	
	/**
     * @ManyToMany(targetEntity="Persona", mappedBy="tipos")
     */
	private $personas;
	//--------
 
 
 	public function __construct($tipo){
 		$this->tipo = $tipo;
		$this->personas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set tipo
     *
     * @param string $tipo
     * @return Tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Add personas
     *
     * @param \BaseVideoArte\Entidades\Persona $personas
     * @return Tipo
     */
    public function addPersona(\BaseVideoArte\Entidades\Persona $personas)
    {
        $this->personas[] = $personas;
    
        return $this;
    }

    /**
     * Remove personas
     *
     * @param \BaseVideoArte\Entidades\Persona $personas
     */
    public function removePersona(\BaseVideoArte\Entidades\Persona $personas)
    {
        $this->personas->removeElement($personas);
    }

    /**
     * Get personas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPersonas()
    {
        return $this->personas;
    }
}