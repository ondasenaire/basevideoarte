<?php

namespace BaseVideoArte\Form\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;



class PersonaType extends AbstractType {
	public function buildForm(FormBuilderInterface $builder, array $options) {
		//$builder -> add("nombre", "text");
		$builder ->add('apellido','text');
		$builder ->add('data','textarea');
		$builder ->add('inicio','text');
		$builder ->add('sexo','choice' , array(
			'choices' => array(
				'h' => 'hombre',
				'm' => 'mujer',
				'o' => 'otro'
			),
			'required' => 'false',
			
		
		));
		$builder ->add('web','text');
		// $builder ->add('pais','entity', array(
			// 'class' => 'BaseVideoArte\Entidades\Pais',
			// 'property' => 'pais'
		// ));
		
		
	}



	public function getName() {
		return "nueva_persona";
	}

}
