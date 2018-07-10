<?php

namespace Samples\CibercafeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Samples\CibercafeBundle\Entity\UsuarioAsociado;
use Samples\CibercafeBundle\Form\UsuarioAsociadoType;
use Samples\CibercafeBundle\Entity\UsuarioEventual;
use Samples\CibercafeBundle\Form\UsuarioEventualType;

/**
 * UsuarioAsociado controller.
 *
 * @Route("/crud/usuario")
 */
class UsuarioController extends Controller {

    /**
     * Lists all UsuarioAsociado entities.
     *
     * @Route("/", name="crud_usuario_asociado_eventual")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $paginator = $this->get('ideup.simple_paginator');

        $paginator->setItemsPerPage(15) // cantidad de elementos por páginas
                ->setMaxPagerItems(5) // cantidad de botones de páginas
        ;

        $entities = $paginator
                        ->paginate($this->getDoctrine()->getRepository('SamplesCibercafeBundle:Usuario')->findAll())->getResult();

        return array(
            'entities' => $entities,
            'paginator' => $paginator
        );
    }

    /**
     * Creates a new UsuarioAsociado entity.
     *
     * @Route("/new", name="crud_usuario_asociado_eventual_new_create")
     * @Template("SamplesCibercafeBundle:Usuario:new.html.twig")
     */
    public function newAction(Request $request) {

        $request = $this->getRequest();

        $method = $request->getMethod();

        $entity_1 = new UsuarioAsociado();
        $form_1 = $this->createForm(new UsuarioAsociadoType(), $entity_1);

        $entity_2 = new UsuarioEventual();
        $form_2 = $this->createForm(new UsuarioEventualType(), $entity_2);

        if ($method == "GET") {
            
          // no hacer nada
            
        } else if ($method == "POST") {

            $tipo_usuario = $request->request->get('tipo_usuario');

            if ($tipo_usuario == "asociado") {
                $entity = $entity_1;
                $form = $form_1;
            } else {
                $entity = $entity_2;
                $form = $form_2;
            }

            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();

                $this->get('session')->getFlashBag()->add('success', 'Usuario Adicionado Satisfactoriamente');

                return $this->redirect($this->generateUrl('crud_usuario_asociado_eventual'));
            }
        }

        return array(
            'entity_asociado' => $entity_1,
            'form_asociado' => $form_1->createView(),
            'entity_eventual' => $entity_2,
            'form_eventual' => $form_2->createView(),
        );
    }

    /**
     * Finds and displays a UsuarioAsociado entity.
     *
     * @Route("/show/{id}", name="crud_usuario_asociado_eventual_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SamplesCibercafeBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }

        if ($entity instanceof UsuarioAsociado) {
            $tipo_usuario = "asociado";
        } else {
            $tipo_usuario = "eventual";
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'tipo_usuario' => $tipo_usuario,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing UsuarioAsociado entity.
     *
     * @Route("/edit/{id}", name="crud_usuario_asociado_eventual_edit")
     * @Template()
     */
    public function editAction($id) {

        $request = $this->getRequest();

        $method = $request->getMethod();

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SamplesCibercafeBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UsuarioAsociado entity.');
        }

        if ($entity instanceof UsuarioAsociado) {
            $tipo_usuario = "asociado";
            $editForm = $this->createForm(new UsuarioAsociadoType(), $entity);
        } else {
            $tipo_usuario = "eventual";
            $editForm = $this->createForm(new UsuarioEventualType(), $entity);
        }

        $deleteForm = $this->createDeleteForm($id);

        if ($method == "GET") {

            // todo normal
        } else if ($method == "POST") {

            $editForm->bind($request);

            if ($editForm->isValid()) {
                $em->persist($entity);
                $em->flush();

                $this->get('session')->getFlashBag()->add('success', 'Usuario Actualizado Satisfactoriamente');

                return $this->redirect($this->generateUrl('crud_usuario_asociado_eventual'));
            }
        }
        return array(
            'entity' => $entity,
            'tipo_usuario' => $tipo_usuario,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a UsuarioAsociado entity.
     *
     * @Route("/remove/{id}", name="crud_usuario_asociado_eventual_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SamplesCibercafeBundle:Usuario')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find UsuarioAsociado entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('crud_usuario_asociado_eventual'));
    }

    /**
     * Creates a form to delete a UsuarioAsociado entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
