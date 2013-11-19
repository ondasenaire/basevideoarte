<?php

namespace BaseVideoArte\Form\Buscador;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;



class BuscadorPersonasType extends AbstractType {
	
	private $opcionesPais;
	private $opcionesTipo;
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add('nombre','text', array(
				'label'=> 'Nombre o Apellido: ',
				'required' => false														
			) );
		$builder->add('pais','choice',array(
				'choices' => $this->opcionesPais,
				'label' => 'Pais: ',
				'multiple' => false,
				'expanded' => false,
				'required' =>false
			));
		$builder->add('tipo','choice',array(
				'label' => 'Actividad: ',
				'required' => false,
				'choices' => $this->opcionesTipo,
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
