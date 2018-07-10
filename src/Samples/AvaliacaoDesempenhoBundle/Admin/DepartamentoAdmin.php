<?php

namespace Samples\AvaliacaoDesempenhoBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class DepartamentoAdmin extends Admin {

    protected $translationDomain = 'SamplesAvaliacaoDesempenhoBundle';
    
    protected $datagridValues = array(
        '_sort_by' => 'departamento',
        '_sort_order' => 'ASC',
    );

    protected function configureRoutes(\Sonata\AdminBundle\Route\RouteCollection $collection) {
        $collection->clearExcept(array('list', 'create', 'edit', /* 'show', */ 'delete', 'batch', /* 'export' */));
    }

    public function getExportFormats() {
        return array(/* 'json', 'xml', 'csv', 'xls' */);
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                //->add('id')
                //->add('departamento')
                //->add('abreviatura')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                //->add('id')
                ->addIdentifier('departamento')
                ->add('abreviatura')
                ->add('_action', 'actions', array(
                    'label'=>'Ações',
                    'actions' => array(
                        //'show' => array(),
                        'edit' => array(),
                        'delete' => array(),
                    )
                ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                //->add('id')
                ->add('departamento')
                ->add('abreviatura')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
                //->add('id')
                ->add('departamento')
                ->add('abreviatura')
        ;
    }

}
