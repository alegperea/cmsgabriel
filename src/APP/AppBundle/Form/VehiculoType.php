<?php

namespace APP\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use \Symfony\Component\OptionsResolver\OptionsResolver;
use \Symfony\Component\Form\Extension\Core\Type\TextType;
use \Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use \Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use \Symfony\Component\Form\Extension\Core\Type\TextareaType;
use \Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class VehiculoType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('marca', EntityType::class, array(
                    'attr' => array(
                        'class' => 'select2_single form-control col-md-7 col-xs-12',
                    ),
                    'class' => 'AppBundle:Marca',
                    'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('c')->orderBy('c.nombre', 'ASC');
            },
                ))
                ->add('modelo', TextType::class, array('attr' => array('class' => 'form-control')))
                ->add('codProd', TextType::class, array('attr' => array('class' => 'form-control')))
                ->add('patente', TextType::class, array('attr' => array('class' => 'form-control')))
                ->add('siniestro', TextType::class, array('attr' => array('class' => 'form-control')))
                ->add('combustible', ChoiceType::class, array(
                    'label' => 'Combustible',
                    'choices' => array('Nafta' => '1', 'Diesel' => '2'),
                    'attr' => array('class' => 'select2_single form-control col-md-7 col-xs-12',),
                ))
                ->add('categoria', EntityType::class, array(
                    'attr' => array(
                        'class' => 'form-control select2_single col-md-7 col-xs-12',
                    ),
                    'class' => 'AppBundle:Categoria',
                    'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('c')->orderBy('c.nombre', 'ASC');
            },
                ))
                ->add('compania', EntityType::class, array(
                    'attr' => array(
                        'class' => 'select2_single form-control col-md-7 col-xs-12',
                    ),
                    'class' => 'AppBundle:Compania',
                    'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('c')->orderBy('c.nombre', 'ASC');
            },
                ))
                ->add('valor', IntegerType::class, array('attr' => array('class' => 'form-control')))
                ->add('estado', CheckboxType::class, array(
                    'attr' => array('class' => 'js-switch form-control',
                        'data-switchery' => "true"),
                    'label' => 'En venta'))
                ->add('publicado', CheckboxType::class, array(
                    'attr' => array('class' => 'js-switch form-control',
                        'data-switchery' => "true"),
                ))
                ->add('descripcion', TextareaType::class, array('attr' => array('class' => 'form-control')))
                ->add('notas', TextareaType::class, array('attr' => array('class' => 'form-control')));
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
