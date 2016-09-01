<?php

namespace APP\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use APP\AppBundle\Entity\Venta;
use APP\AppBundle\Form\VentaType;

/**
 * Venta controller.
 *
 */
class VentaController extends Controller {

    /**
     * Lists all Venta entities.
     *
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Venta')->findAll();

        return $this->render('AppBundle:Venta:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Displays a form to create a new Venta entity.
     *
     */
    public function newAction() {
        $entity = new Venta();
        $form = $this->CreateForm(VentaType::class, $entity);

        return $this->render('AppBundle:Venta:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    
    /**
     * Creates a new Venta entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Venta();
        $form = $this->CreateForm(VentaType::class, $entity);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setFechaAlta(new \DateTime());
            $entity->setFechaMod(new \DateTime());
            $usuario = $this->get('security.token_storage')->getToken()->getUser();
            $entity->setUsuarioAlta($usuario);
            $entity->setUsuarioMod($usuario);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('venta'));
        }



        return $this->render('AppBundle:Venta:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Función para crear Venta por Ajax
     */
    public function createAjaxAction(Request $request) {
        if ($request->getMethod() == "POST") {
            $em = $this->getDoctrine()->getManager();
            $name = $request->get('name');
            $entity = new Venta();
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
     * Finds and displays a Venta entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Venta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Venta entity.');
        }

        $deleteForm = $this->createForm(VentaType::class);

        return $this->render('AppBundle:Venta:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Venta entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Venta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Venta entity.');
        }

        $editForm = $this->createForm(VentaType::class, $entity);

        return $this->render('AppBundle:Venta:edit.html.twig', array(
                    'entity' => $entity,
                    'form' => $editForm->createView()
        ));
    }

    /**
     * Edits an existing Venta entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Venta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Venta entity.');
        }

        $editForm = $this->createForm(VentaType::class, $entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            /** @var $entity Venta */
            $usuario = $this->get('security.token_storage')->getToken()->getUser();
            $entity->setFechaMod(new \DateTime());
            $entity->setUsuarioMod($usuario);

            $em->persist($entity);
            $em->flush();

            $this->setFlash('success', 'Los cambios se han realizado con éxito');
            return $this->redirect($this->generateUrl('compania_edit', array('id' => $id)));
        }

        $this->setFlash('error', 'Ha ocurrido un error');
        return $this->render('AppBundle:Venta:edit.html.twig', array(
                    'entity' => $entity,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Venta entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Venta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Venta entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('venta'));
    }

    /**
     * Creates a form to delete a Venta entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('companias_delete', array('id' => $id)))
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
