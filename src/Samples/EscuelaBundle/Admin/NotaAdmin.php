<?php

namespace Samples\EscuelaBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class NotaAdmin extends Admin {

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('asignatura', null, array("read_only" => true))
                ->add('nota');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('estudiante')
                ->add('asignatura')
                ->add('nota');
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                 ->add('estudiante')
                ->add('asignatura')
                ->addIdentifier('nota');
    }

}
