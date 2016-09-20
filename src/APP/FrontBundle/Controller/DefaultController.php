<?php

namespace APP\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
        return $this->render('FrontBundle:Default:index.html.twig');
    }

    public function vehiculosAction() {
        
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Vehiculo')->vehiculosPublicados();

        return $this->render('FrontBundle:Default:vehiculos.html.twig', array(
                    'entities' => $entities,
        ));
    }

}
