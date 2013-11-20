<?php

namespace BaseVideoArte\Form\Buscador;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;



class BuscadorObrasType extends AbstractType {
	
	private $opcionesFormato;
	private $opcionesPalabra;
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add('titulo','text',array(
				'required'=> false,
				'label'=> 'Título: ',
				));
		
		//GENERO NO VA EN LA PRIMERA ETAPA	
		// $builder->add('genero','choice',array(
				// 'choices' => array('1'=>'Documental','2'=>'Experimental'),
				// 'multiple' => false,
				// 'expanded' => false
			// ));
			
		$builder->add('formato','choice',array(
				'choices' => $this->opcionesFormato,
				'required'=> false,
				'label'=> 'Formato: ',
				'multiple' => false,
				'expanded' => false
		));	
		$builder->add('palabras','choice',array(
				'choices' => $this->opcionesPalabra,
				'required'=> false,
				'label'=> 'Palabra Clave: ',
				'multiple' => false,
				'expanded' => false
		));	
		
		$builder->add('buscar','submit');
	}
	

	public function setOpcionesFormato( $op){
		$this->opcionesFormato = $op;
		
	}
	
	public function setOpcionesPalabra( $o){
		$this->opcionesPalabra = $o;
		
	}
		

	public function getName() {
		return "buscador_obras";
	}

}