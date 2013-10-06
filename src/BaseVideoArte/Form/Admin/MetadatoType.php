<?php

namespace BaseVideoArte\Form\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;



class MetadatoType extends AbstractType {
	

	private $opcionesTipo;
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
		
		$builder->add('tipo','choice',array('choices' => $this->opcionesTipo, 'required' => 'true','empty_value' => '---------', ));
		$builder -> add("metadato", "text");
		}
		
	public function setOpcionesTipo( $o){
		$this->opcionesTipo = $o;
		
	}
		
		
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BaseVideoArte\Entidades\Metadato',
        ));
    }		

	public function getName() {
		return "metadato";
	}

}
