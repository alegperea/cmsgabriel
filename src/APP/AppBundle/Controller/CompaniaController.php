<?php

namespace APP\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use APP\AppBundle\Entity\Compania;
use APP\AppBundle\Form\CompaniaType;

/**
 * Compania controller.
 *
 */
class CompaniaController extends Controller {

    /**
     * Lists all Compania entities.
     *
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Compania')->findAll();

        return $this->render('AppBundle:Compania:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new Compania entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Compania();
        $form = $this->CreateForm(CompaniaType::class, $entity);

        $form->handleRequest($request);

        if ($form->isValid()) {                  
            $em = $this->getDoctrine()->getManager();
            $entity->setEstado(1);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('compania'));
        }



        return $this->render('AppBundle:Compania:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Función para crear Compania por Ajax
     */
    public function createAjaxAction(Request $request) {
        if ($request->getMethod() == "POST") {
            $em = $this->getDoctrine()->getManager();
            $name = $request->get('name');
            $entity = new Compania();
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
     * Displays a form to create a new Compania entity.
     *
     */
    public function newAction() {
        $entity = new Compania();
        $form = $this->CreateForm(CompaniaType::class, $entity);

        return $this->render('AppBundle:Compania:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Compania entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Compania')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Compania entity.');
        }

        $deleteForm = $this->createForm(CompaniaType::class);

        return $this->render('AppBundle:Compania:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Compania entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Compania')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Compania entity.');
        }

        $editForm = $this->createForm(CompaniaType::class, $entity);

        return $this->render('AppBundle:Compania:edit.html.twig', array(
                    'entity' => $entity,
                    'form' => $editForm->createView()
        ));
    }

    /**
     * Edits an existing Compania entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Compania')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Compania entity.');
        }

        $editForm = $this->createForm(CompaniaType::class, $entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            /** @var $entity Compania */
            $usuario = $this->get('security.token_storage')->getToken()->getUser();
            $em->persist($entity);
            $em->flush();

            $this->setFlash('success', 'Los cambios se han realizado con éxito');
            return $this->redirect($this->generateUrl('compania_edit', array('id' => $id)));
        }

        $this->setFlash('error', 'Ha ocurrido un error');
        return $this->render('AppBundle:Compania:edit.html.twig', array(
                    'entity' => $entity,
                    'form' => $editForm->createView(),                   
        ));
    }

    /**
     * Deletes a Compania entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Compania')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Compania entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('compania'));
    }

    /**
     * Creates a form to delete a Compania entity by id.
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
