<?php

namespace BaseVideoArte\Entidades;

//use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity
 */
class MetadatoPersona extends Metadato
{
   /**
     * @ManyToOne(targetEntity="Persona", inversedBy="metadatos", cascade={"persist", "remove"})
     * @JoinColumn(name="persona_id", referencedColumnName="id")
     **/
	private $persona;
	
	
	public function __construct(){
		$this -> persona = new \Doctrine\Common\Collections\ArrayCollection();
	}
	public function getTipos(){
		return array(
					'1' => 'nombre',
					'2' => 'apellido', 
					'3' => 'pais', 
					'4' => 'web', 
					'5' => 'inicio', 
					'6' => 'formato', 
					'7' => 'titulo', 
					);
	}
	public function getSTipo(){
				$s = "";
		if (isset($this -> tipo)) {
			$s = $this -> getTipos();
			$s = $s[$this -> tipo];
		}

		return $s;
	}

    /**
     * Set persona
     *
     * @param \BaseVideoArte\Entidades\Persona $persona
     * @return MetadatoPersona
     */
    public function setPersona(\BaseVideoArte\Entidades\Persona $persona = null)
    {
        $this->persona = $persona;
    
        return $this;
    }

    /**
     * Get persona
     *
     * @return \BaseVideoArte\Entidades\Persona 
     */
    public function getPersona()
    {
        return $this->persona;
    }
}