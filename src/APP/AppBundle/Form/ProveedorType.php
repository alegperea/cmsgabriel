<?php

namespace APP\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use \Symfony\Component\OptionsResolver\OptionsResolver;
use \Symfony\Component\Form\Extension\Core\Type\TextType;
use \Symfony\Component\Form\Extension\Core\Type\TextareaType;
use \Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ProveedorType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre', TextType::class, array('attr' => array('class' => 'form-control')))
                ->add('telefono', TextType::class, array('attr' => array('class' => 'form-control')))                                
                ->add('celular', TextType::class, array('attr' => array('class' => 'form-control')))                                
                ->add('cuit', TextType::class, array('attr' => array('class' => 'form-control')))                                
                ->add('email', TextType::class, array('attr' => array('class' => 'form-control')))                                
                ->add('direccion', TextType::class, array('attr' => array('class' => 'form-control')))                                
                ->add('observaciones', TextareaType::class, array('attr' => array('class' => 'form-control')))
                ->add('estado', CheckboxType::class, array('attr' => array('class' => 'form-control')));                                

    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'APP\AppBundle\Entity\Proveedor'
        ));
    }

    public function getName() {
        return 'app_appbundle_proveedor';
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'APP\AppBundle\Entity\Proveedor',
        ));
    }

}
