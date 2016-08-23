<?php

namespace APP\UsuarioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use \Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use \Symfony\Component\OptionsResolver\OptionsResolver;

class PerfilType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre', TextType::class, array(
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                        'placeholder' => 'Nombre'
                    )
                ))
                ->add('descripcion', TextareaType::class, array(
                    'attr' => array(),
                    'required' => false
                ))
                ->add('pagina_inicio_default', null, array(
                    'required' => true,
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                    )
                ))
                ->add('roles', null, array(
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                    )
                ))
        ;
    }

    public function getName() {
        return 'pac_usuariobundle_perfiltype';
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'APP\UsuarioBundle\Entity\Perfil',
        ));
    }

}
