<?php
namespace BaseVideoArte\Form\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class MultipleType extends AbstractType {
	


	private $meta;
	
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
		
		
		$builder ->add('titulo','text');
		$builder -> add("metadatos", "collection",array(
			'type' => $this->meta,
			'allow_add' => true,
            'allow_delete' => true,
			'by_reference' => false,
            'prototype' => true,
            'prototype_name' => 'meta__name__'
		
		));
		}
		
		
    // public function setDefaultOptions(OptionsResolverInterface $resolver)
    // {
        // $resolver->setDefaults(array(
            // 'data_class' => 'BaseVideoArte\\Entity\Task',
        // ));
    // }
		
	public function setOpciones($o){
		$this->meta = $o;
	}

	public function getName() {
		return "multiple";
	}

}
