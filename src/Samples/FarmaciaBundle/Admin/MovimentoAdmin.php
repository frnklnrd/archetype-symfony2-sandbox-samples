<?php

namespace Samples\FarmaciaBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class MovimentoAdmin extends Admin
{
    protected $datagridValues = array(
        '_sort_by' => 'data',
        '_sort_order' => 'DESC',
    );

    protected function configureRoutes(\Sonata\AdminBundle\Route\RouteCollection $collection) {
        $collection->clearExcept(array('list', 'create', 'show'/*'edit', 'delete', 'batch', 'export' */));
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            //->add('id')
            ->add('data')
			->add('produto')
			->add('tipo_movimento')
			->add('funcionario')
            //->add('existencia_actual')
            //->add('quantidade')
            ->add('procedencia_destino')
            //->add('observacoes')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            //->add('id')
			->add('data_format',null,array('label'=>'Data'))
			->add('produto.nome',null, array('label'=>'Produto'))
			->add('tipo_movimento.nome',null, array('label'=>'Movimento'))
            ->add('procedencia_destino')
			->add('quantidade', null, array('label'=>'Quantidade'))
			->add('funcionario','string')
            //->add('existencia_anterior')
            //->add('existencia_actual')
            //->add('quantidade')
            //->add('observacoes')
            ->add('_action', 'actions', array(
				'label'=>'Ações',
                'actions' => array(
                    'show' => array(),
                    //'edit' => array(),
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
			->with('Movimento de Medicamento ou Dispositivo Médico', array("class" => "col-md-7"))
			/*
			->add('data','sonata_type_date_picker',
												array('label'=>'Data',
												'read_only'=>true,
												'format' => 'dd/MM/yyyy',
												'dp_default_date'=> (new \DateTime())->format('d/m/Y'),
												'dp_min_date'=> (new \DateTime())->sub(new \DateInterval('P1W'))->format('d/m/Y'),
												'dp_max_date'=> (new \DateTime())->format('d/m/Y'),
												))
			*/
			->add('produto')
			->add('tipo_movimento')			
            ->add('quantidade','number')
			->end()
			->with('Procedencia ou Destino', array("class" => "col-md-5"))
            //->add('existencia_anterior')
            //->add('existencia_actual')
            ->add('procedencia_destino',null, array('label'=>'Procedencia ou Destino'))
            ->add('observacoes','textarea')
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
            ->add('data', null, array('label'=>'Data e Hora'))
			->add('produto.nome', null, array('label'=>'Produto'))
			->add('tipo_movimento.nome', null, array('label'=>'Tipo de Movimento'))
            ->add('procedencia_destino', null, array('label'=>'Procedencia / Destino'))
            ->add('quantidade', null, array('label'=>'Quantidade'))
            ->add('existencia_actual', null, array('label'=>'Existência'))
			->add('funcionario', 'html', array('label'=>'Funcionario'))
            ->add('observacoes','html', array('label'=>'Observações'))
        ;
    }
	
    public function prePersist($object) {

        parent::prePersist($object);
		
		$user = $this->getConfigurationPool()->getContainer()
						->get('security.context')->getToken()->getUser();

		$funcionario = $this->getConfigurationPool()->getContainer()
				->get("doctrine")->getRepository("SamplesFarmaciaBundle:Funcionario")
				->findOneBy(array("usuario" => $user->getId()));
				
		$object->setFuncionario($funcionario);
		$object->setData(new \DateTime());	

        $produto = $this->getConfigurationPool()->getContainer()
						   ->get("doctrine")->getRepository("SamplesFarmaciaBundle:Produto")
						   ->find($object->getProduto()->getId());
		
		$tipo_movimento = $this->getConfigurationPool()->getContainer()
						   ->get("doctrine")->getRepository("SamplesFarmaciaBundle:TipoMovimento")
						   ->find($object->getTipoMovimento()->getId());
		
		$existencia_anterior = $produto->getStock();
		$existencia_actual = $existencia_anterior + $object->getQuantidade()*$tipo_movimento->getValor();
		
		$object->setExistenciaActual($existencia_actual);
		$produto->setStock($existencia_actual);
		
		$this->getConfigurationPool()->getContainer()
                    ->get("doctrine")->getManager()->persist($produto);
       
        $this->getConfigurationPool()->getContainer()
                ->get("doctrine")->getManager()->flush();	
    }
	
}
