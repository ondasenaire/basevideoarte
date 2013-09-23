<?php
namespace BaseVideoArte\Entidades;
/**
 * @Entity
 * @Table(name="medios")
 */
class Medio {
	
	/**
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */
	private $id;
	
	/**
	 * @Column(type="string")
	 */
		private $archivo; // ruta al archivo
	/*
	 * @OneToOne(targetEntity="TipoDeMedio")
	 * @JoinColumn(name="tipo_medio_id", referencedColumnName="id")
	 */
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
     * Set archivo
     *
     * @param string $archivo
     * @return Medio
     */
    public function setArchivo($archivo)
    {
        $this->archivo = $archivo;
    
        return $this;
    }

    /**
     * Get archivo
     *
     * @return string 
     */
    public function getArchivo()
    {
        return $this->archivo;
    }
}