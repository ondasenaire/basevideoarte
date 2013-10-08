<?php
namespace BaseVideoArte\Entidades;
/**
 * @Entity
 * @InheritanceType("SINGLE_TABLE")
 * @DiscriminatorColumn(name="discr", type="string")
 * @DiscriminatorMap({"per" = "MetadatoPersona", "obr" = "MetadatoObra"})
 */
class Metadato {
	/**
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */
	private $id;
	/**
	 * @Column(type="string")
	 */
	private $metadato;
	/**
	 * @Column(type="integer")
	 */
	private $tipo;	

//-------------------------------------------
//-------------------
	 public function __construct(){
		
	 }

	public function setTipo($t) {
		$this -> tipo = $t;
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
     * Set metadato
     *
     * @param string $metadato
     * @return Metadato
     */
    public function setMetadato($metadato)
    {
        $this->metadato = $metadato;
    
        return $this;
    }

    /**
     * Get metadato
     *
     * @return string 
     */
    public function getMetadato()
    {
        return $this->metadato;
    }

    /**
     * Get tipo
     *
     * @return integer 
     */
    public function getTipo()
    {
        return $this->tipo;
    }
}