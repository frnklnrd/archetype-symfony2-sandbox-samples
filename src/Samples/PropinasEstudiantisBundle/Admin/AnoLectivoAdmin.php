<?php

namespace Samples\PropinasEstudiantisBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class AnoLectivoAdmin extends Admin
{
	
    protected $translationDomain = 'SamplesPropinasEstudiantisBundle';
    
    protected $datagridValues = array(
        '_page' => 1, // Display the first page (default = 1)
        '_sort_order' => 'DESC', // Descendant ordering (default = 'ASC')
        '_sort_by' => 'ano' // name of the ordered field (default = the model id field, if any)
    );
    
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            //->add('id')
            //->add('ano',null,array("global_search"=>false))
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            //->add('id')
            ->addIdentifier('ano')
            ->add('custo_mes_1',null,array("label"=>"J"))
            ->add('custo_mes_2',null,array("label"=>"F"))
            ->add('custo_mes_3',null,array("label"=>"M"))
            ->add('custo_mes_4',null,array("label"=>"A"))
            ->add('custo_mes_5',null,array("label"=>"M"))
            ->add('custo_mes_6',null,array("label"=>"J"))
            ->add('custo_mes_7',null,array("label"=>"J"))
            ->add('custo_mes_8',null,array("label"=>"A"))
            ->add('custo_mes_9',null,array("label"=>"S"))
            ->add('custo_mes_10',null,array("label"=>"O"))
            ->add('custo_mes_11',null,array("label"=>"N"))
            ->add('custo_mes_12',null,array("label"=>"D"))
            ->add('_action', 'actions', array(
                'label' => 'Ações',
                'actions' => array(
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
            ->add('ano')
            ->add('custo_mes_1','money',array("label"=>"Pago do Mes 1 (Janeiro)","currency"=>"akz","grouping"=>true))
            ->add('custo_mes_2','money',array("label"=>"Pago do Mes 2 (Fevereiro)","currency"=>"akz","grouping"=>true))
            ->add('custo_mes_3','money',array("label"=>"Pago do Mes 3 (Março)","currency"=>"akz","grouping"=>true))
            ->add('custo_mes_4','money',array("label"=>"Pago do Mes 4 (Abril)","currency"=>"akz"))
            ->add('custo_mes_5','money',array("label"=>"Pago do Mes 5 (Maio)","currency"=>"akz"))
            ->add('custo_mes_6','money',array("label"=>"Pago do Mes 6 (Junho)","currency"=>"akz"))
            ->add('custo_mes_7','money',array("label"=>"Pago do Mes 7 (Julho)","currency"=>"akz"))
            ->add('custo_mes_8','money',array("label"=>"Pago do Mes 8 (Agosto)","currency"=>"akz"))
            ->add('custo_mes_9','money',array("label"=>"Pago do Mes 9 (Setembro)","currency"=>"akz"))
            ->add('custo_mes_10','money',array("label"=>"Pago do Mes 10 (Outubro)","currency"=>"akz"))
            ->add('custo_mes_11','money',array("label"=>"Pago do Mes 11 (Novembro)","currency"=>"akz"))
            ->add('custo_mes_12','money',array("label"=>"Pago do Mes 12 (Dezembro)","currency"=>"akz"))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            //->add('id')
            ->add('ano')
        ;
    }
}
