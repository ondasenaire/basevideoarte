<?php

namespace BaseVideoArte\Entidades;
//use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity
 */
class MetadatoObra extends Metadato {
	
	/**
	 * @ManyToOne(targetEntity="Obra", inversedBy="metadatos")
	 * @JoinColumn(name="obra_id", referencedColumnName="id")
	 **/
	private $obra;

	public function __construct($metadato, $tipo) {

		parent::__construct();
		$this -> metadato = $metadato;
		if (gettype($tipo) == 'string') {
			array_search($tipo, $this -> getTipos());
		} else {
			$this -> tipo = $tipo;
		}
		$this -> obra = new \Doctrine\Common\Collections\ArrayCollection();
	}

	public function getTipos() {
		return array('1' => 'titulo', '2' => 'sinopsis', '3' => 'anho', '4' => 'duracion', '5' => 'genero', '6' => 'formato', '7' => 'artistas', '8' => 'eventos');
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