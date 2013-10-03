<?php

namespace BaseVideoArte\Form\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;



class PersonaType extends AbstractType {
	
	private $opcionesPais;
	private $opcionesTipo;
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder -> add("nombre", "text");
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
		$builder->add('pais','choice',array('choices' => $this->opcionesPais, 'required' => 'true','empty_value' => '---------', ));
		$builder->add('tipo','choice',array('choices' => $this->opcionesTipo, 'required' => 'true' ,'empty_value' => '---------',) );
		$builder->add( 'mostrar','checkbox',array('required' => 'false'  ) );
		// en symfony2 usar
		// $builder ->add('pais','entity', array(
			// 'class' => 'BaseVideoArte\Entidades\Pais',
			// 'property' => 'pais'
		// ));
		}
		
	

	public function setOpcionesPais( $op){
		$this->opcionesPais = $op;
		
	}
	
	public function setOpcionesTipo( $o){
		$this->opcionesTipo = $o;
		
	}
		

	public function getName() {
		return "nueva_persona";
	}

}
