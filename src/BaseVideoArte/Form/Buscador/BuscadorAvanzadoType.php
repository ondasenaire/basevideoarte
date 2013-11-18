<?php

namespace BaseVideoArte\Form\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;



class PersonaType extends AbstractType {
	
	private $opcionesPais;
	private $opcionesTipo;
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
	}
	

	public function setOpcionesPais( $op){
		$this->opcionesPais = $op;
		
	}
	
	public function setOpcionesTipo( $o){
		$this->opcionesTipo = $o;
		
	}
		

	public function getName() {
		return "buscador_avanzado";
	}

}
