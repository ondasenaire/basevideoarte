<?php

namespace BaseVideoArte\Form\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;



class MetadatoType extends AbstractType {
	

	private $opcionesTipo;
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
		
		$builder->add('tipo','choice',array('choices' => $this->opcionesTipo, 'required' => 'true','empty_value' => '---------', ));
		$builder -> add("metadato", "text");
		}
		
	public function setOpcionesTipo( $o){
		$this->opcionesTipo = $o;
		
	}
		

	public function getName() {
		return "metadato";
	}

}
