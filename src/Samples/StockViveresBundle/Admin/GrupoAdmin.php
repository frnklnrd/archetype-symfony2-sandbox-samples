<?php

namespace Samples\StockViveresBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class GrupoAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            //->add('id')
            ->add('classe')
			->add('classificacao', null, array('label'=>'Classificação'))
            //->add('numero_romano')
            ->add('nome')
            //->add('descricao')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            //->add('id')
            ->add('classe','string')
			->add('classificacao', 'string', array('label'=>'Classificação'))
            ->add('grupo',null, array('label'=>'Grupo'))
            //->add('nome')
            //->add('descricao')
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
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            //->add('id')
            ->add('classe')
			->add('classificacao', null, array('label'=>'Classificação'))
            ->add('numero_romano',null, array('label'=>'Grupo'))
            ->add('nome')
            ->add('descricao')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            //->add('id')
            ->add('numero_romano')
            ->add('nome')
            ->add('descricao')
        ;
    }
}
