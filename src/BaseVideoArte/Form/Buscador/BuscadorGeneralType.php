<?php

namespace BaseVideoArte\Form\Buscador;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;



class BuscadorGeneralType extends AbstractType {
	
	
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder -> add("consulta", "text");
		$builder -> add("buscar", "submit");
	}
	

	
		

	public function getName() {
		return "buscador_general";
	}

}
