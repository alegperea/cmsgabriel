<?php

namespace APP\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use APP\AppBundle\Entity\Cliente;
use APP\AppBundle\Form\ClienteType;

/**
 * Cliente controller.
 *
 */
class ClienteController extends Controller {

    /**
     * Lists all Cliente entities.
     *
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Cliente')->findAll();

        return $this->render('AppBundle:Cliente:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new Cliente entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Cliente();
        $form = $this->CreateForm(ClienteType::class, $entity);

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

            return $this->redirect($this->generateUrl('cliente'));
        }



        return $this->render('AppBundle:Cliente:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Función para crear Cliente por Ajax
     */
    public function createAjaxAction(Request $request) {
        if ($request->getMethod() == "POST") {
            $em = $this->getDoctrine()->getManager();
            $name = $request->get('name');
            $entity = new Cliente();
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
     * Displays a form to create a new Cliente entity.
     *
     */
    public function newAction() {
        $entity = new Cliente();
        $form = $this->CreateForm(ClienteType::class, $entity);

        return $this->render('AppBundle:Cliente:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Cliente entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Cliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cliente entity.');
        }

        $deleteForm = $this->createForm(ClienteType::class);

        return $this->render('AppBundle:Cliente:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Cliente entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Cliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cliente entity.');
        }

        $editForm = $this->createForm(ClienteType::class, $entity);

        return $this->render('AppBundle:Cliente:edit.html.twig', array(
                    'entity' => $entity,
                    'form' => $editForm->createView()
        ));
    }

    /**
     * Edits an existing Cliente entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Cliente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cliente entity.');
        }

        $editForm = $this->createForm(ClienteType::class, $entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            /** @var $entity Cliente */
            $usuario = $this->get('security.token_storage')->getToken()->getUser();
            $entity->setFechaMod(new \DateTime());
            $entity->setUsuarioMod($usuario);

            $em->persist($entity);
            $em->flush();

            $this->setFlash('success', 'Los cambios se han realizado con éxito');
            return $this->redirect($this->generateUrl('compania_edit', array('id' => $id)));
        }

        $this->setFlash('error', 'Ha ocurrido un error');
        return $this->render('AppBundle:Cliente:edit.html.twig', array(
                    'entity' => $entity,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Cliente entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Cliente')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cliente entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cliente'));
    }

    /**
     * Creates a form to delete a Cliente entity by id.
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
