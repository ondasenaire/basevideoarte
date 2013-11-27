<?php

namespace BaseVideoArte\Form\Buscador;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class BuscadorGeneralType extends AbstractType {
	
	
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder -> add("consulta", "text");
		$builder -> add("buscar", "submit");
		
	}
	

	   public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            // una clave única para ayudar generar el token
            'intention'       => 'a',
        ));
    }
		

	public function getName() {
		return "buscador_general";
	}

}
