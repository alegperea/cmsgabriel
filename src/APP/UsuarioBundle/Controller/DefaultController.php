<?php

namespace APP\UsuarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use APP\UsuarioBundle\Entity\Usuario;
use APP\UsuarioBundle\Form\Frontend\UsuarioType;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class DefaultController extends Controller
{

    public function registroAction()
    {
        $peticion = $this->getRequest();
        
        $usuario = new Usuario();
        
        $formulario = $this->createForm(new UsuarioType(),$usuario);
        
        if ($peticion->getMethod() == 'POST')
        {
            $formulario->submit($peticion);
            
            if ($formulario->isValid())
            {
                $encoder = $this->get('security.encoder_factory')
                        ->getEncoder($usuario);
                $usuario->setSalt(md5(time()));
                $passwordCodificado = $encoder->encodePassword(
                        $usuario->getPassword(),
                        $usuario->getSalt()
                );
                $usuario->setPassword($passwordCodificado);
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($usuario);
                $em->flush();
                
                $this->setFlash('info',
                        'Te registraste correctamente!!!'
                        );
                
                //LOGUEAR AL USUARIO
                
                $token = new UsernamePasswordToken(
                        $usuario, $usuario->getPassword(),
                        'usuarios',$usuario->getRoles()
                        );
                
                $this->container->get('security.context')->setToken($token);
                
                return $this->redirect($this->generateUrl('portada',
                        array(
                            'ciudad' => $usuario->getCiudad()->getSlug()
                        )
                        ));
                
            }
        }
        
        return $this->render('UsuarioBundle:Default:registro.html.twig',
                array (
                    'formulario' => $formulario->createView()
                )
                );
    }
    
    public function indexAction($name)
    {
        return $this->render('UsuarioBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function perfilAction()
    {
        $usuario = $this->get('security.context')->getToken()->getUser();
        $formulario = $this->createForm(new UsuarioType(),$usuario);
        
        $peticion = $this->getRequest();
        
        if ($peticion->getMethod() == 'POST')
        {
            $passwordOriginal = $formulario->getData()->getPassword();
            
            $formulario->submit($peticion);
            
            if ($formulario->isValid())
            {
                if (null == $usuario->getPassword())
                {
                    $usuario->setPassword($passwordOriginal);
                }
                $em = $this->getDoctrine()->getManager();
                $em->persist($usuario);
                $em->flush();
                $this->setFlash('info',
                        'Los datos de tu perfil se han actualizado correctamente'
                        );
                return $this->redirect($this->generateUrl('usuario_perfil'));
            }
        }
        
        return $this->render('UsuarioBundle:Default:perfil.html.twig',
                Array(
                    'usuario' => $usuario,
                    'formulario' => $formulario->createView()
                )
           );
    }
    
   public function loginAction()
    {
        $helper = $this->get('security.authentication_utils');
        $session = $this->getRequest()->getSession();
           if ($session->has('login')) {
               return $this->redirect($this->generateUrl('app_index'));
           }else {
               exit();
           }
        return $this->render('UsuarioBundle:Default:login.html.twig', [
            // last username entered by the user (if any)
            'last_username' => $helper->getLastUsername(),
            // last authentication error (if any)
            'error' => $helper->getLastAuthenticationError(),
        ]);
    }
    
    private function setFlash($index,$message)
    {
        $this->get('session')->getFlashBag()->clear();
        $this->get('session')->getFlashBag()->add($index,$message);
    }
    
}
