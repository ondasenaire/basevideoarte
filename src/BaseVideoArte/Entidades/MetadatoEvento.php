<?php
namespace BaseVideoArte\Entidades;
/**
 * @Entity
 */
class MetadatoEvento extends Metadato{
	/**
	 * @ManyToOne(targetEntity="Evento", inversedBy="metadatos")
	 * @JoinColumn(name="evento_id", referencedColumnName="id")
	 **/
	private $evento;
	
	
	public function __construct($metadato, $tipo) {
		//acepta tipo en integer y en string
		parent::__construct();
		$this -> metadato = $metadato;
		if (gettype($tipo) == 'string') {
			$ind = array_search($tipo, $this -> getTipos());
			$this->tipo = $ind;
		} else {
			$this -> tipo = $tipo;
		}
		$this -> obra = new \Doctrine\Common\Collections\ArrayCollection();
	}

	public function getTipos() {
		return array('1' => 'nombre', 
					 '2' => 'anho',
					 '3' => 'web', 
					 '4' => 'info', 
					 '5' => 'lugar', 
					 '6' => 'curadores', 
					 '7' => 'obras', 
					 '8' => 'pais');
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

