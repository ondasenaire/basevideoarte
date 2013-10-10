<?php

namespace BaseVideoArte\Entidades;

//use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity
 */
class MetadatoPersona extends Metadato {
	/**
	 * @ManyToOne(targetEntity="Persona", inversedBy="metadatos", cascade={"persist", "remove"})
	 * @JoinColumn(name="persona_id", referencedColumnName="id")
	 **/
	private $persona;

	public function __construct($metadato, $tipo) {
		parent::__construct();
		$this -> metadato = $metadato;
		if (gettype($tipo) == 'string') {
			array_search($tipo, $this -> getTipos());
		} else {
			$this -> tipo = $tipo;
		}
		$this -> persona = new \Doctrine\Common\Collections\ArrayCollection();
	}

	public function getTipos() {
		return array('1' => 'nombre', '2' => 'apellido', '3' => 'pais', '4' => 'web', '5' => 'inicio', '6' => 'obras', '7' => 'eventos');
	}

	public function getSTipo() {
		$s = "";
		if (isset($this -> tipo)) {
			$s = $this -> getTipos();
			$s = $s[$this -> tipo];
		}

		return $s;
	}


}