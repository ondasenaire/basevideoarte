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
}

//-----------HERENCIA
/**
 * @Entity
 */
class MetadatoPersona extends Metadato{
	
	 /**
     * @ManyToOne(targetEntity="Persona", inversedBy="metadatos")
     * @JoinColumn(name="entidad_id", referencedColumnName="id")
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
}

//--------------------------------------------

/**
 * @Entity
 */
class MetadatoObra extends Metadato{
	
	 /**
     * @ManyToOne(targetEntity="Obra", inversedBy="metadatos")
     * @JoinColumn(name="entidad_id", referencedColumnName="id")
     **/
	private $obra;
	
	public function __construct(){
		$this -> obra = new \Doctrine\Common\Collections\ArrayCollection();
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
}

