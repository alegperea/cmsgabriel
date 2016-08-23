<?php

namespace APP\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use APP\AppBundle\Entity\Proyecto;
use \APP\AppBundle\Form\ProyectoType;

/**
 * Proyecto controller.
 *
 */
class ProyectoController extends Controller {

    /**
     * Lists all Proyectos entities.
     *
     */
    public function indexAction(Request $request) {

        $busqueda = null;
        $em = $this->getDoctrine()->getManager();
        $session = new Session();

        //ld($request->request->has('simple_search'));
        
        if ($request->request->has('simple_search')) {
            $session->set('simple_search', $request->get('simple_search'));
            $busqueda = $request->get('simple_search');         
            
        } else
        if ($session->get('simple_search')) {
            $busqueda = $this->get('session')->get('simple_search');
        }

        $entities = $em->getRepository('AppBundle:Proyecto')->findProyectos($busqueda);
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $entities, $request->query->getInt('page', 1)/* page number */, 5/* limit per page */, array('pageParameterName' => 'page') /* options */
        );

        return $this->render('AppBundle:Proyecto:index.html.twig', array(
                    'pagination' => $pagination,
        ));
    }

    /**
     * Creates a new Proyecto entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Proyecto();
        $form = $this->CreateForm(ProyectoType::class, $entity);

        $form->handleRequest($request);
        $data = $form->getData('app_appbundle_proyecto')->getUsuarios()->toArray();

        if ($form->isValid()) {
            if (count($entity->getUsuariosArray()) == 0) {
                $this->setFlash('error', 'Debe elegir por lo menos un Usuario');
                return $this->render('AppBundle:Proyecyo:new.html.twig', array(
                            'entity' => $entity,
                            'form' => $form->createView()
                ));
            }
            if (array_key_exists('usuarios', $data)) {
                $usuarios_seleccionados = $data['usuarios'];
                if (!$this->pagInicioDefaultValid($usuarios_seleccionados)) {
                    $this->setFlash('error', 'Debe elegir una página inicio default que esté relacionada con el Rol');
                    return $this->render('AppBundle:Proyecto:new.html.twig', array(
                                'entity' => $entity,
                                'form' => $form->createView()
                    ));
                }
            }
            $em = $this->getDoctrine()->getManager();
            $entity->setFechaAlta(new \DateTime());
            $usuarioAlta = $this->get('security.token_storage')->getToken()->getUser();
            $entity->setUsuarioAlta($usuarioAlta);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('proyecto'));
        }



        return $this->render('AppBundle:Proyecto:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Función para crear proyectos por Ajax
     */
    public function createAjaxAction(Request $request) {
        if ($request->getMethod() == "POST") {
            $em = $this->getDoctrine()->getManager();
            $name = $request->get('name');
            $entity = new \APP\AppBundle\Entity\Proyecto();
            $entity->setNombre($name);
            $usuarioAlta = $this->get('security.token_storage')->getToken()->getUser();
            $entity->setUsuarioAlta($usuarioAlta);
            $em->persist($entity);
            $em->flush();
        }

        return $this->render("AppBundle:Default:_newOptionEntity.html.twig", array(
                    'entity' => $entity
        ));
    }

    /**
     * Displays a form to create a new Proyecto entity.
     *
     */
    public function newAction() {
        $entity = new Proyecto();
        $form = $this->CreateForm(ProyectoType::class, $entity);

        return $this->render('AppBundle:Proyecto:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Proyecto entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Proyecto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Proyecto entity.');
        }

        $deleteForm = $this->createForm(ProyectoType::class);

        return $this->render('AppBundle:Proyecto:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Proyecto entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Proyecto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Proyecto entity.');
        }

        $editForm = $this->createForm(ProyectoType::class, $entity);

        return $this->render('AppBundle:Proyecto:edit.html.twig', array(
                    'entity' => $entity,
                    'form' => $editForm->createView()
        ));
    }

    /**
     * Edits an existing Proyecto entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Proyecto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Proyecto entity.');
        }

        $editForm = $this->createForm(ProyectoType::class, $entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            /** @var $entity Proyecto */
            $usuario = $this->get('security.token_storage')->getToken()->getUser();
            $em->persist($entity);
            $em->flush();

            $this->setFlash('success', 'Los cambios se han realizado con éxito');
            return $this->redirect($this->generateUrl('proyecto_edit', array('id' => $id)));
        }

        $this->setFlash('error', 'Ha ocurrido un error');
        return $this->render('AppBundle:Proyecto:edit.html.twig', array(
                    'entity' => $entity,
                    'form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Proyecto entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CarrerasBundle:Proyecto')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Proyecto entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('proyecto'));
    }

    /**
     * Creates a form to delete a Proyecto entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('proyectos_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

    private function setFlash($index, $message) {
        $this->get('session')->getFlashBag()->clear();
        $this->get('session')->getFlashBag()->add($index, $message);
    }

}
