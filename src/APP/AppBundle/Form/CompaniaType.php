<?php

namespace APP\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use \Symfony\Component\OptionsResolver\OptionsResolver;
use \Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use \Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CompaniaType extends AbstractType {

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
                ->add('mail', TextType::class, array('attr' => array('class' => 'form-control')))                                
                ->add('direccion', TextType::class, array('attr' => array('class' => 'form-control')))                                
                ->add('observaciones', TextareaType::class, array('attr' => array('class' => 'form-control')));                                

    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'APP\AppBundle\Entity\Compania'
        ));
    }

    public function getName() {
        return 'app_appbundle_compania';
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'APP\AppBundle\Entity\Compania',
        ));
    }

}
