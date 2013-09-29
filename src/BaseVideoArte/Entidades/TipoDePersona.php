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
     * @return TipoDePersona
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
}