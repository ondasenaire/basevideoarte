<?php
namespace BaseVideoArte\Entidades;
/**
 * @Entity
 * @Table(name="formatos")
 */
class Formato {
	 /** 
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
	private $id;
	/**
	 * @Column(type="string")
	 */
	private $formato;
	
	/**
	 * @ManyToMany(targetEntity="Obra", mappedBy="formatos")
	 */
	private $obras;


//---------------------------------------



	public function __construct($formato){
		$this->formato = $formato;
		$this->obras = new \Doctrine\Common\Collections\ArrayCollection();
	}
  
}