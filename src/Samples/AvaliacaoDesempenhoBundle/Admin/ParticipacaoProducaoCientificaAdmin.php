<?php

namespace Samples\AvaliacaoDesempenhoBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ParticipacaoProducaoCientificaAdmin extends Admin {

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                //->add('id')
                ->add('data')
                ->add('tema')
                ->add('nacional_internacional')
                ->add('observacoes')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                //->add('id')
                ->add('data')
                ->add('tema')
                ->add('nacional_internacional')
                ->add('observacoes')
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
                ->add('tipo_producao_cientifica',null, array('label'=>'Tipo'))
                ->add('data', 'sonata_type_date_picker', array("label" => "Data",'format'=>'yyyy-MM-dd'))
                /*
                  ->add('nacional_internacional', 'choice', array(
                  'label' => 'Nacional?',
                  'expanded' => false,
                  'multiple' => false,
                  'choices' => array(
                  'Nacional' => 'Nacional',
                  'Internacional' => 'Internacional'
                  )
                  ))
                 */
                //->add('tema')
                ->add('observacoes', null, array('attr'=>array("cols"=>"50")))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
                //->add('id')
                ->add('data')
                ->add('tema')
                ->add('nacional_internacional')
                ->add('observacoes')
        ;
    }

}
