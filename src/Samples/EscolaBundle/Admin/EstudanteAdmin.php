<?php

namespace Samples\EscolaBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class EstudanteAdmin extends Admin {

    protected $translationDomain = 'SamplesEscolaBundle';
    protected $datagridValues = array(
        '_sort_by' => 'nome',
        '_sort_order' => 'ASC',
    );

    protected function configureRoutes(\Sonata\AdminBundle\Route\RouteCollection$collection) {
        $collection->clearExcept(array(
            'list',
            'create',
            'edit',
                //'show',
                //'delete',
                //'batch',
                //'export'
        ));
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                //->add('id')
                ->add('nome', null, array("label" => "Nome do Estudante",
                    "show_filter" => true,
                    'advanced_filter' => true,
                ))
                ->add('bi', null, array("label" => "Bilhete de Identidade"))
                ->add('dataNascimento', null, array("label" => "Data de Nascimento"))
                ->add('curso')
                ->add('turma')
                ->add('ano')
                ->add('bairro', 'doctrine_orm_callback', array(
                    'label' => 'Bairro da Morada',
                    'field_type' => 'text',
                    'callback' => array($this, 'filterByBairro'),
                ))
                ->add('provincia', 'doctrine_orm_callback', array(
                    'label' => 'Provincia da Morada',
                    'field_type' => 'entity',
                    'callback' => array($this, 'filterByProvincia'),
                        ), null, array('class' => 'SamplesEscolaBundle:Provincia'))
        ;
    }

    public function filterByBairro($queryBuilder, $alias, $field, $value) {
        if (!$value['value']) {
            return;
        }

        $queryBuilder->leftJoin($alias . '.morada', 'm');

        $queryBuilder->andWhere($queryBuilder->expr()->orX(
                        $queryBuilder->expr()->like('m.bairro', $queryBuilder->expr()->literal('%' . $value['value'] . '%'))
        ));

        return true;
    }

    public function filterByProvincia($queryBuilder, $alias, $field, $value) {
        if (!$value['value']) {
            return;
        }

        $queryBuilder->leftJoin($alias . '.morada', 'm')
                ->leftJoin('m.provincia', 'p');

        $queryBuilder->andWhere($queryBuilder->expr()->orX(
                        $queryBuilder->expr()->eq('p.nome', $queryBuilder->expr()->literal($value['value']))
        ));

        return true;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper) {
        unset($this->listModes['mosaic']);

        $listMapper
                //->add('id')
                ->addIdentifier('foto.preview', 'html', array("label" => "Foto"))
                ->addIdentifier('bi')
                ->add('nome')
                ->add('dataNascimento')
                ->add('_action', 'actions', array(
                    'label' => 'Ações',
                    'actions' => array(
                        //'show' => array(),
                        'edit' => array(),
                        'delete' => array(),
                    )
                ))
        ;
    }

    public function createQuery($context = 'list') {
        $query = parent::createQuery($context);

        //$query->andWhere($query->getRootAlias() . '.id IS NOT NULL');

        return $query;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                //->add('id')
                ->tab("Dados Pessoais")
                ->with('Dados Pessoais', array("class" => "col-md-7", "description" => "Indique os dados pessoais"))
                ->add('nome')
                ->add('bi')
                ->add('dataNascimento', 'sonata_type_date_picker', array('label' => 'Data de Nascimento',
                    'format' => 'yyyy-MM-dd',
                    'read_only' => true,
                    'dp_max_date' => (new \DateTime())->sub(new \DateInterval('P15Y'))->format('d/m/Y'),
                    'dp_default_date' => (new \DateTime())->sub(new \DateInterval('P15Y'))->format('d/m/Y')
                ))
                ->end()
                ->with("Foto", array("class" => "col-md-5", "description" => null))
                ->add(
                        $formMapper->create('foto', 'form', $this->getFileImageOptions(array('label' => false, 'by_reference' => true, "data_class" => "Samples\EscolaBundle\Entity\Image")))
                        ->add('file', 'file', array('required' => false, "label" => false))
                )
                ->end()
                ->end()
                ->tab("Outros dados")
                ->with("Dados da Morada", array("class" => "col-md-5", 'box_class' => 'box box-solid box-info'))
                ->add(
                        $formMapper->create('morada', 'form', array('label' => false, 'by_reference' => true, "data_class" => "Samples\EscolaBundle\Entity\Morada"))
                        ->add('rua', null, array('label' => 'Nome da Rua'))
                        ->add('numero', null, array('label' => 'Número de casa'))
                        ->add('bairro', null, array('label' => 'Nome do Bairro'))
                        ->add('provincia', null, array('label' => 'Provincia'))
                        ->add('municipio', null, array('label' => 'Municipio'))
                )
                ->end()
                ->with("Dados Escolares", array("class" => "col-md-7", 'box_class' => 'box box-solid box-danger'))
                ->add('curso', 'sonata_type_model_autocomplete', array('property' => 'nome'))
                ->add('turma', null, array('expanded' => true, 'multiple' => false, 'required' => true))
                ->add('ano')
                ->add('disciplina_favorita', 'sonata_type_model_list')
                ->end()
                ->end()
                ->tab("Investigações e Eventos")
                ->with("Pesquisas", array("class" => "col-md-12", 'box_class' => 'box box-solid box-warning'))
                ->add('pesquisas', 'sonata_type_collection', array(
                    "label" => false,
                    "by_reference" => false,
                    'type_options' => array(
                        'delete' => true
                    ),
                        ), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                ))
                ->end()
                ->with("Eventos", array("class" => "col-md-12", 'box_class' => 'box box-solid box-success'))
                ->add('eventos', null, array('label' => false, 'expanded' => true, 'multiple' => true, 'required' => false))
                ->end()
                ->end()
        ;
    }

    public function getFileImageOptions($fileFieldOptions = array('required' => false)) {
        if ($this->hasParentFieldDescription()) { // this Admin is embedded
            $getter = 'get' . $this->getParentFieldDescription()->getFieldName();
            $parent = $this->getParentFieldDescription()->getAdmin()->getSubject();
            if ($parent) {
                $subject = $parent->$getter();
            } else {
                $subject = null;
            }
        } else {
            $subject = $this->getSubject();
        }
        $container = $this->getConfigurationPool()->getContainer();
        if ($subject && $subject->getFoto() && ($webPath = $subject->getFoto()->getWebPath())) {
            $fullPath = $container->get('request')->getBasePath() . $webPath;
            $fileFieldOptions['sonata_help'] = '<img src="' . $fullPath . '" class="admin-preview" width="200px"/>';
        } else {
            $fileFieldOptions['sonata_help'] = "<img width='200px' src='" . $container->get('request')->getBasePath() . "/assets/img/user.png'>";
        }

        return $fileFieldOptions;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
                ->add('id')
                ->add('nome')
                ->add('bi')
                ->add('dataNascimento')
        ;
    }

    public function prePersist($object) {

        parent::prePersist($object);

        $this->updateRelations($object);
    }

    public function preUpdate($object) {

        parent::preUpdate($object);

        $this->updateRelations($object);
    }

    public function postUpdate($object) {

        parent::postUpdate($object);

        // remove 1->N relation
        $this->remove_1toN_Relations($object, $this->getConfigurationPool()->getContainer()->get("doctrine")
                        ->getRepository("SamplesEscolaBundle:Pesquisa")
                        ->findBy(array("estudante" => $object->getId())), $object->getPesquisas()
        );
    }

    public function updateRelations($object) {

        // update 1->1 relation
        $morada = $object->getMorada();
        $morada->setEstudante($object);

        // update 1->N relation
        foreach ($object->getPesquisas() as $item) {
            $item->setEstudante($object);
        }
    }

    public function remove_1toN_Relations($object, $items, $items_to_save) {
        $items_to_delete = array();

        foreach ($items as $item) {
            $items_to_delete[] = $item;
        }

        foreach ($items_to_save as $item) {
            foreach ($items_to_delete as $key => $toDel) {
                if ($toDel->getId() === $item->getId()) {
                    unset($items_to_delete[$key]);
                }
            }
        }

        foreach ($items_to_delete as $item) {
            $this->getConfigurationPool()->getContainer()
                    ->get("doctrine")->getManager()->remove($item);
        }
        $this->getConfigurationPool()->getContainer()
                ->get("doctrine")->getManager()->flush();
    }

    public function getTemplate($name) {
        switch ($name) {
            case 'edit':
                return "SamplesEscolaBundle:Estudante:edit.html.twig";
        }
        return parent::getTemplate($name);
    }

}
