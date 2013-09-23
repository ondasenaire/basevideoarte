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
}