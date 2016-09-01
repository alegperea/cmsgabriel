<?php

namespace APP\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use APP\AppBundle\Entity\Proveedor;
use APP\AppBundle\Form\ProveedorType;

/**
 * Proveedor controller.
 *
 */
class ProveedorController extends Controller {

    /**
     * Lists all Proveedor entities.
     *
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Proveedor')->findAll();

        return $this->render('AppBundle:Proveedor:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new Proveedor entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Proveedor();
        $form = $this->CreateForm(ProveedorType::class, $entity);

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

            return $this->redirect($this->generateUrl('proveedor'));
        }



        return $this->render('AppBundle:Proveedor:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Función para crear Proveedor por Ajax
     */
    public function createAjaxAction(Request $request) {
        if ($request->getMethod() == "POST") {
            $em = $this->getDoctrine()->getManager();
            $name = $request->get('name');
            $entity = new Proveedor();
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
     * Displays a form to create a new Proveedor entity.
     *
     */
    public function newAction() {
        $entity = new Proveedor();
        $form = $this->CreateForm(ProveedorType::class, $entity);

        return $this->render('AppBundle:Proveedor:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Proveedor entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Proveedor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Proveedor entity.');
        }

        $deleteForm = $this->createForm(ProveedorType::class);

        return $this->render('AppBundle:Proveedor:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Proveedor entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Proveedor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Proveedor entity.');
        }

        $editForm = $this->createForm(ProveedorType::class, $entity);

        return $this->render('AppBundle:Proveedor:edit.html.twig', array(
                    'entity' => $entity,
                    'form' => $editForm->createView()
        ));
    }

    /**
     * Edits an existing Proveedor entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Proveedor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Proveedor entity.');
        }

        $editForm = $this->createForm(ProveedorType::class, $entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            /** @var $entity Proveedor */
            $usuario = $this->get('security.token_storage')->getToken()->getUser();
            $entity->setFechaMod(new \DateTime());
            $entity->setUsuarioMod($usuario);

            $em->persist($entity);
            $em->flush();

            $this->setFlash('success', 'Los cambios se han realizado con éxito');
            return $this->redirect($this->generateUrl('proveedor_edit', array('id' => $id)));
        }

        $this->setFlash('error', 'Ha ocurrido un error');
        return $this->render('AppBundle:Proveedor:edit.html.twig', array(
                    'entity' => $entity,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Proveedor entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Proveedor')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Proveedor entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('proveedor'));
    }

    /**
     * Creates a form to delete a Proveedor entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('proveedor_delete', array('id' => $id)))
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
