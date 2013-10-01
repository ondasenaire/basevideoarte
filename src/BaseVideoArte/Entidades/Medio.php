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
	/**
	 * @ManyToOne(targetEntity="TipoDeMedio")
	 * @JoinColumn(name="tipo_medio_id", referencedColumnName="id")
	 */
	private $tipo;


	/**
	 * @ManyToMany(targetEntity="Obras", mappedBy="medios")
	 */
	private $obras;
	
	
	
	
//---------------------------------------



	public function __construct(){
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

    /**
     * Set tipo
     *
     * @param \BaseVideoArte\Entidades\TipoDeMedio $tipo
     * @return Medio
     */
    public function setTipo(\BaseVideoArte\Entidades\TipoDeMedio $tipo = null)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return \BaseVideoArte\Entidades\TipoDeMedio 
     */
    public function getTipo()
    {
        return $this->tipo;
    }
}