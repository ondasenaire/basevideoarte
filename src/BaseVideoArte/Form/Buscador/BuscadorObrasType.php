<?php

namespace BaseVideoArte\Form\Buscador;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;



class BuscadorObrasType extends AbstractType {
	
	private $opcionesPais;
	private $opcionesTipo;
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add('nombre','text');
		$builder->add('pais','choice',array(
				'choices' => array('1'=>'arg','2'=>'brasil','3'=>'chile'),
				'multiple' => false,
				'expanded' => false
			));
		$builder->add('genero','choice',array(
				'choices' => array('1'=>'Documental','2'=>'Experimental'),
				'multiple' => false,
				'expanded' => false
			));
			
		$builder->add('formato','choice',array(
				'choices' => array('1'=>'16mm','2'=>'35mm'),
				'multiple' => false,
				'expanded' => false
		));	
		$builder->add('palabra','choice',array(
				'choices' => array('1'=>'inmigracion','2'=>'palestina'),
				'multiple' => false,
				'expanded' => false
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
		return "buscador_obras";
	}

}