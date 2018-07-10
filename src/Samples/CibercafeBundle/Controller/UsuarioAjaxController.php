<?php

namespace Samples\CibercafeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Samples\CibercafeBundle\Entity\UsuarioAsociado;
use Samples\CibercafeBundle\Form\UsuarioAsociadoType;
use Samples\CibercafeBundle\Entity\UsuarioEventual;
use Samples\CibercafeBundle\Form\UsuarioEventualType;

/**
 * UsuarioAjaxAsociado controller.
 *
 * @Route("/crud/ajax/usuario")
 */
class UsuarioAjaxController extends Controller {

    /**
     * Lists all UsuarioAsociado entities.
     *
     * @Route("/", name="crud_ajax_usuario_asociado_eventual", options={"expose"=true})
     * @Template()
     */
    public function indexAction() {
        $paginator = $this->get('ideup.simple_paginator');

        $paginator->setItemsPerPage(8) // cantidad de elementos por páginas
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
     * @Route("/new", name="crud_ajax_usuario_asociado_eventual_new_create", options={"expose"=true})
     * @Template()
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

                return new Response("ok");
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
     * @Route("/show/{id}", name="crud_ajax_usuario_asociado_eventual_show", options={"expose"=true})
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

        return array(
            'entity' => $entity,
            'tipo_usuario' => $tipo_usuario,
        );
    }

    /**
     * Displays a form to edit an existing UsuarioAsociado entity.
     *
     * @Route("/edit/{id}", name="crud_ajax_usuario_asociado_eventual_edit", options={"expose"=true})
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

        if ($method == "GET") {

            // todo normal
        } else if ($method == "POST") {

            $editForm->bind($request);

            if ($editForm->isValid()) {
                $em->persist($entity);
                $em->flush();

                $this->get('session')->getFlashBag()->add('success', 'Usuario Actualizado Satisfactoriamente');
            }
        }
        return array(
            'entity' => $entity,
            'tipo_usuario' => $tipo_usuario,
            'edit_form' => $editForm->createView(),
        );
    }
}
