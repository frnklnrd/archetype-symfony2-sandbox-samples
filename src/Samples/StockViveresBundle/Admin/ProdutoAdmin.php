<?php

namespace Samples\StockViveresBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ProdutoAdmin extends Admin
{
    protected $datagridValues = array(
        '_sort_by' => 'codigo',
        '_sort_order' => 'ASC',
    );

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            //->add('id')
            ->add('codigo')
            ->add('nome')
			->add('tipo_produto', null, array('label'=>'Tipo de Produto'))
            ->add('tipo_embalagem', null, array('label'=>'Tipo de Embalagem'))
            ->add('unidade_medida', null, array('label'=>'Unidade de Medida'))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            //->add('id')
            ->add('codigo')
            ->add('nome')
            ->add('existencia_embalagem',null, array('label'=>'Existencia'))
            ->add('unidades_total',null, array('label'=>'Total de Unidades'))
            ->add('quantidade_neta_total',null, array('label'=>'Quantidade Total'))
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
			->with('Dados principais', array("class" => "col-md-6"))
				->add('codigo')
				->add('nome')
				->add('tipo_produto', null, array('label'=>'Tipo de Produto'))
			->end()
			->with('Embalagem', array("class" => "col-md-3"))
				->add('tipo_embalagem', null, array('label'=>'Tipo de Embalagem'))
				->add('unidades_por_embalagem')
				->add('peso_por_unidade',null, array('label'=>'Medida ou Peso por unidade'))
				->add('unidade_medida', null, array('label'=>'Unidade de Medida'))
			->end()
			->with("Existencia", array("class" => "col-md-3"))
				->add(
						$formMapper->create('existencia', 'form', array('label' => false, 'by_reference' => true, "data_class" => "Samples\StockViveresBundle\Entity\Existencia"))
						->add('existencia', null, array('label' => 'Quantidade em existencia', 'read_only'=>true))
						->add('data',null,
														array('label'=>'Data de Actualização',
														'read_only'=>true,
														'widget' => 'single_text',
														'format'=> 'd/M/yyyy'
														))
				)
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
            ->add('codigo')
            ->add('nome')
            ->add('unidades_por_embalagem')
            ->add('peso_por_unidade')
        ;
    }
	
    public function prePersist($object) {

        parent::prePersist($object);

        $existencia = $object->getExistencia();
		$existencia->setExistencia(0);
		$existencia->setData(new \DateTime());
    }
	
}
