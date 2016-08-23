<?php

namespace APP\UsuarioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use \Symfony\Component\Form\Extension\Core\Type\EmailType;
use \Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use \Symfony\Bridge\Doctrine\Form\Type\EntityType;
use \Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use \Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class UsuarioType extends AbstractType {


    private $usuario; 

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $this->usuario = $options['usuario'];
        
            $builder
                    ->add('username', TextType::class, array(
                        'attr' => array(
                            'class' => 'form-control col-md-7 col-xs-12',
                            'placeholder' => 'Nombre de Usuario'
                        )
                    ))
                    ->add('password', RepeatedType::class, array(
                        'type' => \Symfony\Component\Form\Extension\Core\Type\PasswordType::class,
                        'invalid_message' => 'Las dos contraseñas deben coincidir',
                        'first_options' => array('label' => 'Contraseña', 'attr' => array(
                                'class' => 'form-control col-md-7 col-xs-12',
                            )),
                        'second_options' => array('label' => 'Repetir Contraseña', 'attr' => array(
                                'class' => 'form-control col-md-7 col-xs-12',
                            )),
                    ))
                    ->add('enviar_mail', CheckboxType::class, array(
                        'label' => 'Enviar al mail la contraseña ingresada?',
                        'required' => false,
                        'mapped' => false,
                        'label_attr' => array('colsm' => 'col-sm-4')
                    ))
            ;
        
        $builder
                ->add('nombre', TextType::class, array(
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                        'placeholder' => 'Nombre'
                    )
                ))
                ->add('apellido', TextType::class, array(
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                        'placeholder' => 'Apellido'
                    )
                ))
                ->add('tipo_documento', ChoiceType::class, array(
                    'choices' => array(
                        'DNI' => 'DNI',
                        'CI' => 'CI',
                        'PA' => 'PASAPORTE',
                        'LE' => 'LIBRETA DE ENROLAMIENTO',
                        'LC' => 'LIBRETA CIVICA',
                    ),
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                    )
                ))
                ->add('numero_documento', TextType::class, array(
                    'required' => false,
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                        'placeholder' => 'Número de Documento'
                    )
                ))
                ->add('email', EmailType::class, array(
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                        'placeholder' => 'E-mail'
                    )
                ))
                ->add('telefono', TextType::class, array(
                    'required' => false,
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                        'placeholder' => 'Télefono'
                    )
                ))
                ->add('telefonoAlternativo', TextType::class, array(
                    'attr' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                        'placeholder' => 'Télefono Alternativo'
                    ),
                    'required' => false
        ));
        $perfil_id = $this->usuario->getPerfil()->getId();
        $builder->add('perfil', EntityType::class, array(
            'attr' => array(
                'class' => 'form-control col-md-7 col-xs-12',
            ),
            'class' => 'UsuarioBundle:Perfil',
            'query_builder' => function(EntityRepository $er) {
        return $er->createQueryBuilder('u')
                        ->orderBy('u.nombre', 'ASC')
        ;
    },
        ));
    }

    public function getName() {
        return 'pac_usuariobundle_usuariotype';
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(\Symfony\Component\OptionsResolver\OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'APP\UsuarioBundle\Entity\usuario',
            'usuario' => null,          
        ));
    }

}
