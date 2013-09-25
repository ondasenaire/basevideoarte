<?php
namespace BaseVideoArte\Entidades;
/**
 * @Entity
 * @Table(name="tipo_de_medio")
 */
class TipoDeMedio {
	/**
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */
	private $id;
	/**
	 * @Column(type="string",name="tipo_de_medio")
	 */
	private $tipoDeMedio;


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
     * Set tipoDeMedio
     *
     * @param string $tipoDeMedio
     * @return TipoDeMedio
     */
    public function setTipoDeMedio($tipoDeMedio)
    {
        $this->tipoDeMedio = $tipoDeMedio;
    
        return $this;
    }

    /**
     * Get tipoDeMedio
     *
     * @return string 
     */
    public function getTipoDeMedio()
    {
        return $this->tipoDeMedio;
    }
}