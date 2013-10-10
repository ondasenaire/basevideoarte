<?php
namespace BaseVideoArte\Entidades;
/**
 * @Entity
 * Table(name="metadatos")
 * @InheritanceType("SINGLE_TABLE")
 * @DiscriminatorColumn(name="discr", type="string")
 * @DiscriminatorMap({"per" = "MetadatoPersona", "obr" = "MetadatoObra"})
 */
abstract class Metadato {
	/**
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @Column(type="string")
	 */
	protected $metadato;
	/**
	 * @Column(type="integer")
	 */
	protected $tipo;	

//-------------------------------------------
//-------------------
	 public function __construct(){

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
     * Set tipo
     *
     * @param integer $tipo
     * @return Metadato
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    
        return $this;
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