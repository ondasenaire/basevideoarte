<?php

namespace BaseVideoArte\Form\Buscador;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;



class BuscadorPersonasType extends AbstractType {
	
	private $opcionesPais;
	private $opcionesTipo;
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add('nombre','text');
		$builder->add('pais','choice',array(
				'choices' => array('1'=>'asdas','2'=>'asdas','3'=>'asdas'),
				'multiple' => false,
				'expanded' => false
			));
		$builder->add('tipo','choice',array(
				'choices' => array('1'=>'artista','2'=>'curador/a'),
				'multiple' => true,
				'expanded' => true
			));
		$builder->add('buscar','submit');
	}
	

	public function setOpcionesPais( $op){
		$this->opcionesPais = $op;
		
	}
	
	public function setOpcionesTipo( $o){
		$this->opcionesTipo = $o;
		
	}
		

	public function getName() {
		return "buscador_personas";
	}

}
