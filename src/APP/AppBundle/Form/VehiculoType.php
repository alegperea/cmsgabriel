<?php

namespace APP\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use \Symfony\Component\OptionsResolver\OptionsResolver;
use \Symfony\Component\Form\Extension\Core\Type\TextType;
use \Symfony\Bridge\Doctrine\Form\Type\EntityType;

class VehiculoType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('marca', TextType::class, array('attr' => array('class' => 'form-control')))
                ->add('modelo', TextType::class, array('attr' => array('class' => 'form-control')))
                ->add('patente', TextType::class, array('attr' => array('class' => 'form-control')))
                ->add('siniestro', TextType::class, array('attr' => array('class' => 'form-control')))
                ->add('categoria', EntityType::class, array(
                        'attr' => array(
                            'class' => 'form-control col-md-7 col-xs-12',
                        ),
                        'class' => 'AppBundle:Categoria',
                        'query_builder' => function(EntityRepository $er) {
                             return $er->createQueryBuilder('c')->orderBy('c.nombre', 'ASC');
                         },
                ));


        
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'APP\AppBundle\Entity\Vehiculo'
        ));
    }

    public function getName() {
        return 'app_appbundle_vehiculo';
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'APP\AppBundle\Entity\Vehiculo',
        ));
    }

}
