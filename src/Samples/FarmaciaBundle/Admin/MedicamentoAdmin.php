<?php

namespace Samples\FarmaciaBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class MedicamentoAdmin extends Admin
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
            ->add('nome')
			->add('principios_activos')
			->add('dosagem')
			->add('unidade_de_medida')
			->add('forma')
			->add('stock')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            //->add('id')
            ->add('nome')
			->add('forma')
			->add('dosagemUM')
			->add('stock')
			->add('principios_activos')
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
			->with('Medicamento', array("class" => "col-md-7"))
            ->add('nome')
			->add('forma')
			->add('dosagem')
			->add('unidade_de_medida')
			->add('stock',null, array('label'=>'Quantidade no stock', 'read_only'=>true))
			->end()
			->with('Principios Activos', array("class" => "col-md-5"))
			->add('principios_activos',null, array('multiple'=>true,'expanded'=>true))	
			->end()
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            //->add('id')
            ->add('nome')
			->add('forma')
			->add('principios_activos')
			->add('dosagem')
			->add('unidade_de_medida')
			->add('stock')
        ;
    }
	
    public function prePersist($object) {

        parent::prePersist($object);

		$object->setStock(0);
    }	
}
