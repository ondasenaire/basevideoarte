<?php
namespace BaseVideoArte\Entidades;
/**
 * @Entity
 * @Table(name="formatos")
 */
class Formato {
	 /** 
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
	private $id;
	/**
	 * @Column(type="string")
	 */
	private $formato;
	
	/**
	 * @ManyToMany(targetEntity="Obra", mappedBy="obras")
	 */
	private $obras;


//---------------------------------------



	public function __construct($formato){
		$this->formato = $formato;
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
     * Set formato
     *
     * @param string $formato
     * @return Formato
     */
    public function setFormato($formato)
    {
        $this->formato = $formato;
    
        return $this;
    }

    /**
     * Get formato
     *
     * @return string 
     */
    public function getFormato()
    {
        return $this->formato;
    }

    /**
     * Add obras
     *
     * @param \BaseVideoArte\Entidades\Obra $obras
     * @return Formato
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