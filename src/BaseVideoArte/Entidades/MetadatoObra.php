<?php

namespace BaseVideoArte\Entidades;
//use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity
 */
class MetadatoObra extends Metadato
{
   

 /**
     * @ManyToOne(targetEntity="Obra", inversedBy="metadatos")
     * @JoinColumn(name="obra_id", referencedColumnName="id")
     **/
	private $obra;
	
	public function __construct(  $metadato,$tipo){

		parent::__construct($metadato,$tipo);
		$this -> obra = new \Doctrine\Common\Collections\ArrayCollection();
	}
	
	public function getTipos(){
		return array(
					'1' => 'titulo',
					'2' => 'sinopsis', 
					'3' => 'anho', 
					'4' => 'duracion', 
					'5' => 'genero', 
					'6' => 'formato', 
					'7' => 'artistas', 
					'8' => 'eventos'
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

    /**
     * Set obra
     *
     * @param \BaseVideoArte\Entidades\Obra $obra
     * @return MetadatoObra
     */
    public function setObra(\BaseVideoArte\Entidades\Obra $obra = null)
    {
        $this->obra = $obra;
    
        return $this;
    }

    /**
     * Get obra
     *
     * @return \BaseVideoArte\Entidades\Obra 
     */
    public function getObra()
    {
        return $this->obra;
    }
}