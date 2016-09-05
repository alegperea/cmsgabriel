<?php

namespace APP\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use APP\AppBundle\Entity\Vehiculo;
use APP\AppBundle\Form\VehiculoType;
use APP\AppBundle\Form\VentaType;
use APP\AppBundle\Entity\Venta;

/**
 * Vehiculo controller.
 *
 */
class VehiculoController extends Controller {

    /**
     * Lists all Vehiculos entities.
     *
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Vehiculo')->findAll();

        return $this->render('AppBundle:Vehiculo:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new Vehiculo entity.
     *
     */
    public function venderAction($id, Request $request) {

        $em = $this->getDoctrine()->getManager();
        $vehiculo = $em->getRepository('AppBundle:Vehiculo')->find($id);
        $entity = new Venta();
        $form = $this->CreateForm(VentaType::class, $entity);
        if ($request->getMethod() == 'POST') {

            $form->handleRequest($request);
            $entity = new Venta();
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $entity->setFechaAlta(new \DateTime());
                $usuario = $this->get('security.token_storage')->getToken()->getUser();

                $entity->setUsuarioAlta($usuario);
                $entity->setUsuarioMod($usuario);
                $entity->setFechaAlta(new \DateTime());
                $entity->setFechaMod(new \DateTime());
                $entity->setVehiculo($vehiculo);
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('vehiculo'));
            }
        }
        return $this->render('AppBundle:Vehiculo:vender.html.twig', array(
                    'entity' => $vehiculo,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new Vehiculo entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Vehiculo();
        $form = $this->CreateForm(VehiculoType::class, $entity);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setFechaAlta(new \DateTime());
            $usuario = $this->get('security.token_storage')->getToken()->getUser();
            $entity->setUsuarioAlta($usuario);
            $entity->setUsuarioMod($usuario);
            $entity->setFechaAlta(new \DateTime());
            $entity->setFechaMod(new \DateTime());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('vehiculo'));
        }



        return $this->render('AppBundle:Vehiculo:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Función para crear Vehiculos por Ajax
     */
    public function createAjaxAction(Request $request) {
        if ($request->getMethod() == "POST") {
            $em = $this->getDoctrine()->getManager();
            $name = $request->get('name');
            $entity = new Vehiculo();
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
     * Displays a form to create a new Vehiculo entity.
     *
     */
    public function newAction() {
        $entity = new Vehiculo();
        $form = $this->CreateForm(VehiculoType::class, $entity);

        return $this->render('AppBundle:Vehiculo:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Vehiculo entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Vehiculo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vehiculo entity.');
        }

        $deleteForm = $this->createForm(VehiculoType::class);

        return $this->render('AppBundle:Vehiculo:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Vehiculo entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Vehiculo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vehiculo entity.');
        }

        $editForm = $this->createForm(VehiculoType::class, $entity);

        return $this->render('AppBundle:Vehiculo:edit.html.twig', array(
                    'entity' => $entity,
                    'form' => $editForm->createView()
        ));
    }

    /**
     * Edits an existing Vehiculo entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Vehiculo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vehiculo entity.');
        }

        $editForm = $this->createForm(VehiculoType::class, $entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            /** @var $entity Vehiculo */
            $usuario = $this->get('security.token_storage')->getToken()->getUser();
            $entity->setFechaMod(new \DateTime());
            $entity->setUsuarioMod($usuario);
            $em->persist($entity);
            $em->flush();

            $this->setFlash('success', 'Los cambios se han realizado con éxito');
            return $this->redirect($this->generateUrl('vehiculo_edit', array('id' => $id)));
        }

        $this->setFlash('error', 'Ha ocurrido un error');
        return $this->render('AppBundle:Vehiculo:edit.html.twig', array(
                    'entity' => $entity,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Vehiculo entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Vehiculo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Vehiculo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('vehiculo'));
    }

    /**
     * Creates a form to delete a Vehiculo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('vehiculos_delete', array('id' => $id)))
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
