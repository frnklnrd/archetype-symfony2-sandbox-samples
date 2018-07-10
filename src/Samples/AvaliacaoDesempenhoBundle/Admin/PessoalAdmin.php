<?php

namespace Samples\AvaliacaoDesempenhoBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PessoalAdmin extends Admin {

    protected $translationDomain = 'SamplesAvaliacaoDesempenhoBundle';
    protected $datagridValues = array(
        '_sort_by' => 'nome',
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
        if (true === $this->getConfigurationPool()->getContainer()
                        ->get('security.context')->isGranted('ROLE_FUNCIONARIO') ||
                true === $this->getConfigurationPool()->getContainer()
                        ->get('security.context')->isGranted('ROLE_ESPECIALISTA_RH') ||
                true === $this->getConfigurationPool()->getContainer()
                        ->get('security.context')->isGranted('ROLE_CHEFE_DEPARTAMENTO') ||
                true === $this->getConfigurationPool()->getContainer()
                        ->get('security.context')->isGranted('ROLE_SUPER_ADMIN')
        ) {
            $datagridMapper
                    ->add('nome')
                    ->add('bi')
                    ->add('telefone')
                    ->add('numero_agente')
                    ->add('departamento')
            ;
        }
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                //->add('id')
                ->remove('batch')
                ->addIdentifier('nome')
                ->add('departamento', 'html')
                ->add('bi')
                ->add('telefone')
                ->add('numero_agente')
                ->add('parcial_integral')
        ;
    }

    public function createQuery($context = 'list') {
        $query = parent::createQuery($context);

        if (true === $this->getConfigurationPool()->getContainer()
                        ->get('security.context')->isGranted('ROLE_SUPER_ADMIN')) {
            return $query;
        }
        
        if (true === $this->getConfigurationPool()->getContainer()
                        ->get('security.context')->isGranted('ROLE_CHEFE_DEPARTAMENTO')) {

            $user = $this->getConfigurationPool()->getContainer()
                            ->get('security.context')->getToken()->getUser();

            $chefe = $this->getConfigurationPool()->getContainer()
                    ->get("doctrine")->getRepository("SamplesAvaliacaoDesempenhoBundle:Pessoal")
                    ->findOneBy(array("usuario" => $user->getId()));

            $query->
                    andWhere($query->getRootAlias() . '.departamento = ' . $chefe->getDepartamento()->getId())
            ;
        } else if (true === $this->getConfigurationPool()->getContainer()
                        ->get('security.context')->isGranted('ROLE_PROFESSOR')) {

            $user = $this->getConfigurationPool()->getContainer()
                            ->get('security.context')->getToken()->getUser();

            $query->
                    andWhere($query->getRootAlias() . '.usuario = \'' . $user->getId() . '\'')
            ;
        }

        return $query;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper) {

        if (false === $this->getConfigurationPool()->getContainer()
                        ->get('security.context')->isGranted('ROLE_FUNCIONARIO') &&
                false === $this->getConfigurationPool()->getContainer()
                        ->get('security.context')->isGranted('ROLE_CHEFE_DEPARTAMENTO') &&
                false === $this->getConfigurationPool()->getContainer()
                        ->get('security.context')->isGranted('ROLE_ESPECIALISTA_RH') &&
                false === $this->getConfigurationPool()->getContainer()
                        ->get('security.context')->isGranted('ROLE_SUPER_ADMIN')
        ) {
            $routes = $this->getRoutes();
            $routes->remove('create');
            $routes->remove('delete');
            $routes->remove('add');
            $this->routes = $routes;
            $this->configureRoutes($routes);
        } else {
            $routes = $this->getRoutes();
            $routes->add('create');
            $routes->add('delete');
            $routes->add('add');
            $this->routes = $routes;
            $this->configureRoutes($routes);
        }

        $formMapper
                //->add('id')
                ->tab("Dados pessoais")
                ->with("Dados pessoais", array("class" => "col-md-8"))
                ->add('nome')
                ->add('endereco', 'textarea')
                ->end()
                ->with("Outros", array("class" => "col-md-4"))
                ->add('bi', null, array('label' => 'Bilhete Identidade'))
                ->add('data_nacimento', 'sonata_type_date_picker', array("label" => "Data de Nascimento",'format'=>'yyyy-MM-dd'))
                ->add('telefone')
                ->end()
                ->end()
                ->tab("Dados Profissionais")
                ->with("Dados Profissionais", array("class" => "col-md-6"))
                ->add('numero_agente')
                ->add('media_geral_licenciatura')
                ->end()
                ->with("Departamento", array("class" => "col-md-6"))
        ;
        if (true === $this->getConfigurationPool()->getContainer()
                        ->get('security.context')->isGranted('ROLE_CHEFE_DEPARTAMENTO')) {

            $user = $this->getConfigurationPool()->getContainer()
                            ->get('security.context')->getToken()->getUser();

            $chefe = $this->getConfigurationPool()->getContainer()
                    ->get("doctrine")->getRepository("SamplesAvaliacaoDesempenhoBundle:Pessoal")
                    ->findOneBy(array("usuario" => $user->getId()));

            $departamento = $chefe->getDepartamento();

            $formMapper
                    ->add('departamento', 'entity', array('class' => 'SamplesAvaliacaoDesempenhoBundle:Departamento',
                        'query_builder' => function(\Doctrine\ORM\EntityRepository $er) use ($departamento) {
                            $qb = $er->createQueryBuilder('d');
                            $qb->where($qb->expr()->eq('d.id', $departamento->getId()));
                            return $qb;
                        },
                        "multiple" => false, "expanded" => false, 'required' => true)
                    )
            ;
        } else {
            $formMapper
                    ->add('departamento')
            ;
        }
        $formMapper
                ->add('parcial_integral', 'choice', array(
                    'label' => 'A tempo Parcial ou a tempo Integral?',
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => array(
                        'Parcial' => 'Parcial',
                        'Integral' => 'Integral'
                    )
                ))
                ->end()
                ->with("Categorias Profissionais Obtidas", array("class" => "col-md-12"))
                ->add('categorias_profissionais', 'sonata_type_collection', array(
                    "label" => "Categorías Obtidas",
                    "by_reference" => false,
                    'type_options' => array('delete' => true)
                        ), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                ))
                ->end()
                ->with("Graus Académicos Obtidos", array("class" => "col-md-12"))
                ->add('graus_academicos', 'sonata_type_collection', array(
                    "label" => "Graus Obtidos",
                    //'allow_add' => true,
                    //'allow_delete' => true,
                    "by_reference" => false,
                    //Prevents the "Delete" option from being displayed
                    'type_options' => array('delete' => true)
                        ), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                ))
                ->end()
                ->end()
                ->tab("Actividades e Eventos")
                ->with("")
                ->add('actividades', 'sonata_type_collection', array(
                    "label" => "Participação em Actividades",
                    //'allow_add' => true,
                    //'allow_delete' => true,
                    "by_reference" => false,
                    //Prevents the "Delete" option from being displayed
                    'type_options' => array('delete' => true)
                        ), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                ))
                ->end()
                ->end()
                ->tab("Produções Científicas")
                ->with("")
                ->add('producoes_cientificas', 'sonata_type_collection', array(
                    "label" => "Produções Cientificas realizadas",
                    //'allow_add' => true,
                    //'allow_delete' => true,
                    "by_reference" => false,
                    //Prevents the "Delete" option from being displayed
                    'type_options' => array('delete' => true)
                        ), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                ))
                ->end()
                ->end()
        ;
        if (true === $this->getConfigurationPool()->getContainer()
                        ->get('security.context')->isGranted('ROLE_SUPER_ADMIN')) {
            $formMapper
                    ->tab("Perfil de Usuário")
                    ->with("Dados do utilizador atribuido", array('class' => "col-md-6"))
                    ->add(
                            $formMapper->create('usuario', 'form', array('label' => false, 'by_reference' => true, "data_class" => "Sonata\UserBundle\Entity\BaseUser"))
                            ->add('username', null, array('label' => 'Utilizador'))
                            ->add('email', null, array('required' => true, 'label' => 'Email'))
                            ->add('plainPassword', 'password', array('required' => false, 'label' => 'Senha'))
                            ->add('groups', null, array('required' => true, 'expanded' => true, 'multiple' => true, 'label' => 'Tipo de Usuario'))
                    )
                    ->end()->end()
            ;
        }
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
                //->add('id')
                ->add('nome')
                ->add('bi')
                ->add('data_nacimento')
                ->add('telefone')
                ->add('endereco')
                ->add('numero_agente')
                ->add('parcial_integral')
                ->add('media_geral_licenciatura')
        ;
    }

    public function prePersist($object) {

        parent::prePersist($object);

        if (true === $this->getConfigurationPool()->getContainer()
                        ->get('security.context')->isGranted('ROLE_SUPER_ADMIN')) {
            $object->getUsuario()->setEnabled(true);
            $this->updateUsuario($object->getUsuario());
        }
        $this->setRelations($object);
    }

    public function preUpdate($object) {

        parent::preUpdate($object);

        if (true === $this->getConfigurationPool()->getContainer()
                        ->get('security.context')->isGranted('ROLE_SUPER_ADMIN')) {
            $this->updateUsuario($object->getUsuario());
        }

        $this->setRelations($object);
    }

    public function postUpdate($object) {

        parent::postUpdate($object);

        $this->eliminarCategoriasProfissionais($object);
        $this->eliminarGrausAcademicos($object);
        $this->eliminarActividades($object);
        $this->eliminarProducoesCientificas($object);
    }

    public function updateUsuario($usuario) {
        $userManager = $this->getConfigurationPool()->getContainer()->get('fos_user.user_manager');
        $userManager->updateCanonicalFields($usuario);
        $userManager->updatePassword($usuario);
    }

    public function setRelations($object) {
        foreach ($object->getCategoriasProfissionais() as $item) {
            $item->setPessoal($object);
        }
        foreach ($object->getGrausAcademicos() as $item) {
            $item->setPessoal($object);
        }
        foreach ($object->getActividades() as $item) {
            $item->setPessoal($object);
        }
        foreach ($object->getProducoesCientificas() as $item) {
            $item->setPessoal($object);
        }
    }

    public function eliminarCategoriasProfissionais($object) {

        $todos = $this->getConfigurationPool()->getContainer()
                ->get("doctrine")->getRepository("SamplesAvaliacaoDesempenhoBundle:CategoriaProfissionalObtida")
                ->findBy(array("pessoal" => $object->getId()));

        $items_a_eliminar = array();

        foreach ($todos as $item) {
            $items_a_eliminar[] = $item;
        }

        foreach ($object->getCategoriasProfissionais() as $item) {
            foreach ($items_a_eliminar as $key => $toDel) {
                if ($toDel->getId() === $item->getId()) {
                    unset($items_a_eliminar[$key]);
                }
            }
        }

        foreach ($items_a_eliminar as $item) {
            $this->getConfigurationPool()->getContainer()
                    ->get("doctrine")->getManager()->remove($item);
        }

        $this->getConfigurationPool()->getContainer()
                ->get("doctrine")->getManager()->flush();
    }

    public function eliminarGrausAcademicos($object) {

        $todos = $this->getConfigurationPool()->getContainer()
                ->get("doctrine")->getRepository("SamplesAvaliacaoDesempenhoBundle:GrauAcademicoObtido")
                ->findBy(array("pessoal" => $object->getId()));

        $items_a_eliminar = array();

        foreach ($todos as $item) {
            $items_a_eliminar[] = $item;
        }

        foreach ($object->getGrausAcademicos() as $item) {
            foreach ($items_a_eliminar as $key => $toDel) {
                if ($toDel->getId() === $item->getId()) {
                    unset($items_a_eliminar[$key]);
                }
            }
        }

        foreach ($items_a_eliminar as $item) {
            $this->getConfigurationPool()->getContainer()
                    ->get("doctrine")->getManager()->remove($item);
        }

        $this->getConfigurationPool()->getContainer()
                ->get("doctrine")->getManager()->flush();
    }

    public function eliminarActividades($object) {

        $todos = $this->getConfigurationPool()->getContainer()
                ->get("doctrine")->getRepository("SamplesAvaliacaoDesempenhoBundle:ParticipacaoActividade")
                ->findBy(array("pessoal" => $object->getId()));

        $items_a_eliminar = array();

        foreach ($todos as $item) {
            $items_a_eliminar[] = $item;
        }

        foreach ($object->getActividades() as $item) {
            foreach ($items_a_eliminar as $key => $toDel) {
                if ($toDel->getId() === $item->getId()) {
                    unset($items_a_eliminar[$key]);
                }
            }
        }

        foreach ($items_a_eliminar as $item) {
            $this->getConfigurationPool()->getContainer()
                    ->get("doctrine")->getManager()->remove($item);
        }

        $this->getConfigurationPool()->getContainer()
                ->get("doctrine")->getManager()->flush();
    }

    public function eliminarProducoesCientificas($object) {

        $todos = $this->getConfigurationPool()->getContainer()
                ->get("doctrine")->getRepository("SamplesAvaliacaoDesempenhoBundle:ParticipacaoProducaoCientifica")
                ->findBy(array("pessoal" => $object->getId()));

        $items_a_eliminar = array();

        foreach ($todos as $item) {
            $items_a_eliminar[] = $item;
        }

        foreach ($object->getProducoesCientificas() as $item) {
            foreach ($items_a_eliminar as $key => $toDel) {
                if ($toDel->getId() === $item->getId()) {
                    unset($items_a_eliminar[$key]);
                }
            }
        }

        foreach ($items_a_eliminar as $item) {
            $this->getConfigurationPool()->getContainer()
                    ->get("doctrine")->getManager()->remove($item);
        }

        $this->getConfigurationPool()->getContainer()
                ->get("doctrine")->getManager()->flush();
    }

}
