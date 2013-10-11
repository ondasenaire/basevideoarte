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
	private $archivo;
	// ruta al archivo o url de un link
	/**
	 * @ManyToOne(targetEntity="TipoDeMedio")
	 * @JoinColumn(name="tipo_medio_id", referencedColumnName="id")
	 */
	private $tipo;

	private $descripcion;

	//-------------------------
	/**
	 * @ManyToMany(targetEntity="Obra", mappedBy="medios")
	 **/
	private $obras;
	/**
	 * @ManyToMany(targetEntity="Persona", mappedBy="medios")
	 **/
	private $personas;
	/**
	 * @ManyToMany(targetEntity="Evento", mappedBy="medios")
	 **/
	private $eventos;

	//---------------------------------------

	public function __construct($medio, $descripcion, $tipo) {

		$this -> archivo = $medio;
		$this -> tipo = $tipo;
		$this -> descripcion = $descripcion;

		$this -> metadato = $metadato;
		if (gettype($tipo) == 'string') {
			$ind = array_search($tipo, $this -> getTipos());
			$this -> tipo = $ind;
		} else {
			$this -> tipo = $tipo;
		}

		$this -> obras = new \Doctrine\Common\Collections\ArrayCollection();
	}

	public function getTipos() {
		return array('1' => 'imagen principal', '1' => 'galeria', '1' => 'link', '1' => 'video', '1' => 'video embebido', );
	}

}
