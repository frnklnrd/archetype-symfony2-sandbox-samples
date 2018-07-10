<?php

namespace Samples\FarmaciaBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class DispositivoMedicoAdmin extends Admin
{
    protected $datagridValues = array(
        '_sort_by' => 'nome',
        '_sort_order' => 'ASC',
    );

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            //->add('id')
            ->add('nome', null, array('label'=>'Designação'))
			->add('classificacao', null, array('label'=>'Classificação'))
			->add('stock',null, array('label'=>'Quantidade'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            //->add('id')
            ->add('nome', null, array('label'=>'Designação'))
			->add('classificacao', null, array('label'=>'Classificação'))
			->add('stock',null, array('label'=>'Quantidade'))
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
            ->add('nome', null, array('label'=>'Designação'))
			->add('classificacao', null, array('label'=>'Classificação'))
			->add('stock',null, array('label'=>'Quantidade no stock', 'read_only'=>true))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            //->add('id')
            ->add('nome', null, array('label'=>'Designação'))
			->add('classificacao', null, array('label'=>'Classificação'))
			->add('stock',null, array('label'=>'Quantidade'))
        ;
    }
	
    public function prePersist($object) {

        parent::prePersist($object);

		$object->setStock(0);
    }

}
