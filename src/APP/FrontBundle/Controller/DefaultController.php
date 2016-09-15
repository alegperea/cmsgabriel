<?php

namespace APP\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontBundle:Default:index.html.twig');
    }
    
    public function vehiculosAction()
    {
        return $this->render('FrontBundle:Default:vehiculos.html.twig');
    }
}
