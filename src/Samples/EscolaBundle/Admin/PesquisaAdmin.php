<?php

namespace Samples\EscolaBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PesquisaAdmin extends Admin {

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                //->add('id')
                ->add('dataEntrega')
                ->add('tema')
                ->add('quantidadePaginas')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                //->add('id')
                ->add('dataEntrega')
                ->add('tema')
                ->add('quantidadePaginas')
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'show' => array(),
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
                ->add('tema')
                ->add('tipo_pesquisa')
                ->add('dataEntrega', 'sonata_type_date_picker', array('label' => 'Data de Entrega',
                    'format' => 'yyyy-MM-dd',
                    'read_only' => true,
                    'dp_max_date' => (new \DateTime())->format('d/m/Y')
                ))
                ->add('quantidadePaginas', null, array('label' => 'Páginas'))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
                ->add('id')
                ->add('dataEntrega')
                ->add('tema')
                ->add('quantidadePaginas')
        ;
    }

}
