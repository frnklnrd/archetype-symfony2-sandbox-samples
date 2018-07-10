<?php

namespace Samples\ProgramadoresBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Samples\ProgramadoresBundle\Entity\Programador;
use Samples\ProgramadoresBundle\Form\ProgramadorType;

/**
 * Programador controller.
 *
 * @Route("/form/crud/programador")
 */
class ProgramadorCRUDController extends Controller {

    /**
     * Lists all Programador entities.
     *
     * @Route("/list", name="samples_programadores_formularios_crud_programador")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SamplesProgramadoresBundle:Programador')->findAll();

        return $this->render("SamplesProgramadoresBundle:ProgramadorCRUD:index.html.twig", array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new Programador entity.
     *
     * @Route("/create", name="samples_programadores_formularios_crud_programador_create")
     * @Method("POST")
     */
    public function createAction(Request $request) {
        $entity = new Programador();
        $form = $this->createForm(new ProgramadorType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('samples_programadores_formularios_crud_programador_show', array('id' => $entity->getId())));
        }

        return $this->render("SamplesProgramadoresBundle:ProgramadorCRUD:index.html.twig", array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Programador entity.
     *
     * @Route("/new", name="samples_programadores_formularios_crud_programador_new")
     * @Method("GET")
     */
    public function newAction() {
        $entity = new Programador();
        $form = $this->createForm(new ProgramadorType(), $entity);

        return $this->render("SamplesProgramadoresBundle:ProgramadorCRUD:new.html.twig", array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Programador entity.
     *
     * @Route("/show/{id}", name="samples_programadores_formularios_crud_programador_show")
     * @Method("GET")
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SamplesProgramadoresBundle:Programador')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Programador entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render("SamplesProgramadoresBundle:ProgramadorCRUD:show.html.twig", array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Programador entity.
     *
     * @Route("/edit/{id}", name="samples_programadores_formularios_crud_programador_edit")
     * @Method("GET")
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SamplesProgramadoresBundle:Programador')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Programador entity.');
        }

        $editForm = $this->createForm(new ProgramadorType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render("SamplesProgramadoresBundle:ProgramadorCRUD:edit.html.twig", array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Programador entity.
     *
     * @Route("/update/{id}", name="samples_programadores_formularios_crud_programador_update")
     * @Method("PUT")
     * @Template("SamplesProgramadoresBundle:ProgramadorCRUD:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SamplesProgramadoresBundle:Programador')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Programador entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ProgramadorType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('samples_programadores_formularios_crud_programador_edit', array('id' => $id)));
        }

        return $this->render("SamplesProgramadoresBundle:ProgramadorCRUD:edit.html.twig", array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Programador entity.
     *
     * @Route("/delete/{id}", name="samples_programadores_formularios_crud_programador_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SamplesProgramadoresBundle:Programador')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Programador entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('"samples_programadores_formularios_crud_programador'));
    }

    /**
     * Creates a form to delete a Programador entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
