<?php

namespace APP\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use \Symfony\Component\OptionsResolver\OptionsResolver;
use \Symfony\Component\Form\Extension\Core\Type\IntegerType;
use \Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use \Symfony\Component\Form\Extension\Core\Type\TextareaType;


class VentaType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('cliente', EntityType::class, array(
                    'attr' => array(
                        'class' => 'select2_single form-control col-md-7 col-xs-12',
                    ),
                    'class' => 'AppBundle:Cliente',
                    'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('c')->orderBy('c.nombre', 'ASC');
                },
                ))
                ->add('valor', IntegerType::class, array('attr' => array('class' => 'form-control')))
                ->add('observaciones', TextareaType::class, array('attr' => array('class' => 'form-control')));
                                      

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
        return 'app_appbundle_venta';
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
