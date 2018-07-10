<?php

namespace Samples\AvaliacaoDesempenhoBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class AvaliacaoDesempenhoAdmin extends Admin {

    protected $translationDomain = 'SamplesAvaliacaoDesempenhoBundle';
    protected $datagridValues = array(
        '_sort_by' => 'ordem',
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
                    ->add('ano_lectivo')
                    ->add('pessoal')
            ;
        }
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper) {

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
            //$routes->remove('add');
            $this->routes = $routes;
            $this->configureRoutes($routes);
        } else {
            $routes = $this->getRoutes();
            $routes->add('create');
            $routes->add('delete');
            //$routes->add('add');
            $this->routes = $routes;
            $this->configureRoutes($routes);
        }


        if (true === $this->getConfigurationPool()->getContainer()
                        ->get('security.context')->isGranted('ROLE_FUNCIONARIO') ||
                true === $this->getConfigurationPool()->getContainer()
                        ->get('security.context')->isGranted('ROLE_ESPECIALISTA_RH') ||
                true === $this->getConfigurationPool()->getContainer()
                        ->get('security.context')->isGranted('ROLE_CHEFE_DEPARTAMENTO') ||
                true === $this->getConfigurationPool()->getContainer()
                        ->get('security.context')->isGranted('ROLE_SUPER_ADMIN')
        ) {
            $listMapper
                    ->addIdentifier('pessoal', 'string', array('label' => 'Nome'))
            ;
        } else {
            $listMapper
                    ->add('pessoal', 'string', array('label' => 'Nome'))
            ;
        }
        $listMapper
                ->add('ano_lectivo', 'string')
                ->add('data')
                ->add('pontuacao')
                ->add('classificacao')
        ;
    }

    public function createQuery($context = 'list') {
        $query = parent::createQuery($context);

        if (true === $this->getConfigurationPool()->getContainer()
                        ->get('security.context')->isGranted('ROLE_CHEFE_DEPARTAMENTO')) {

            $user = $this->getConfigurationPool()->getContainer()
                            ->get('security.context')->getToken()->getUser();

            $chefe = $this->getConfigurationPool()->getContainer()
                    ->get("doctrine")->getRepository("SamplesAvaliacaoDesempenhoBundle:Pessoal")
                    ->findOneBy(array("usuario" => $user->getId()));

            $query->join($query->getRootAlias() . '.pessoal', 'p')->
                    andWhere('p.departamento = ' . $chefe->getDepartamento()->getId())
            ;
        } else if (true === $this->getConfigurationPool()->getContainer()
                        ->get('security.context')->isGranted('ROLE_PROFESSOR')) {

            $user = $this->getConfigurationPool()->getContainer()
                            ->get('security.context')->getToken()->getUser();

            $query->join($query->getRootAlias() . '.pessoal', 'p')->
                    andWhere('p.usuario = \'' . $user->getId() . '\'')
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
                ->tab('Docente Avaliado')
                ->with('Nome do Docente Avaliado', array("class" => "col-md-6"))
        ;

        if ($this->getSubject()->getId()) {
            $formMapper
                    ->add('pessoal', null, array('disabled' => true, 'label' => 'Nome'))
                    ->add('pessoal.numero_agente', null, array('disabled' => true, 'label' => 'Número de Agente'))
                    ->add('pessoal.categoria_profissional', 'text', array('disabled' => true, 'label' => 'Categoria'))
                    ->add('pessoal.parcial_integral', null, array('disabled' => true, 'label' => 'Tempo'))
                    ->add('pessoal.departamento.departamento', null, array('disabled' => true, 'label' => 'Curso'))
            ;
        } else if (true === $this->getConfigurationPool()->getContainer()
                        ->get('security.context')->isGranted('ROLE_CHEFE_DEPARTAMENTO')) {

            $user = $this->getConfigurationPool()->getContainer()
                            ->get('security.context')->getToken()->getUser();

            $chefe = $this->getConfigurationPool()->getContainer()
                    ->get("doctrine")->getRepository("SamplesAvaliacaoDesempenhoBundle:Pessoal")
                    ->findOneBy(array("usuario" => $user->getId()));

            $departamento = $chefe->getDepartamento();

            $formMapper
                    ->add('pessoal', 'entity', array('class' => 'SamplesAvaliacaoDesempenhoBundle:Pessoal',
                        'query_builder' => function(\Doctrine\ORM\EntityRepository $er) use ($departamento) {
                            $qb = $er->createQueryBuilder('p');
                            $qb->where($qb->expr()->eq('p.departamento', $departamento->getId()));
                            $qb->orderBy('p.nome', 'ASC');
                            return $qb;
                        },
                        "multiple" => false, "expanded" => false, 'required' => true)
                    )
            ;
        } else {
            $formMapper
                    ->add('pessoal', 'sonata_type_model_autocomplete', array('property' => 'nome', 'label' => false))
            ;
        }
        $formMapper
                ->end()
                ->with('Ano Lectivo', array("class" => "col-md-3"))
                ->add('ano_lectivo', 'entity', array('class' => 'SamplesAvaliacaoDesempenhoBundle:AnoLectivo',
                    'query_builder' => function(\Doctrine\ORM\EntityRepository $er) {
                        $qb = $er->createQueryBuilder('al');
                        $qb->orderBy('al.ano', 'DESC');
                        return $qb;
                    },
                    "multiple" => false, "expanded" => false, 'required' => true, 'label' => false)
                )
                ->end()
                ->with('Data', array("class" => "col-md-3"))
                ->add('data', 'sonata_type_date_picker', array("label" => false, 'format' => 'yyyy-MM-dd'))
                ->end()
                ->with('Cadeira (s)', array("class" => "col-md-6"))
                ->add('disciplinas_lecionadas', 'sonata_type_collection', array(
                    "label" => false,
                    "by_reference" => false,
                    'type_options' => array('delete' => true)
                        ), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                ))
                ->end()
                ->end()
                ->tab('Avaliação do Desempenho')
                ->with('Itens a responderem')
                ->add('fichaItem01', 'choice', array('choices' => array(
                        '0' => 'Mau',
                        '1' => 'Medíocre',
                        '2' => 'Suficiente',
                        '3' => 'Bom',
                        '4' => 'Muito Bom',
                        '5' => 'Excelente'
                    ),
                    'label' => 'Nº 1 (d) - Iniciou as aulas na data prevista?',
                    'multiple' => false, 'expanded' => true, 'attr' => array('class' => 'list-inline')
                ))
                ->add('fichaItem02', 'choice', array('choices' => array(
                        '0' => 'Mau',
                        '1' => 'Medíocre',
                        '2' => 'Suficiente',
                        '3' => 'Bom',
                        '4' => 'Muito Bom',
                        '5' => 'Excelente'
                    ),
                    'label' => 'Nº 2 (a) - Apresentou o programa analítico, no iniciio do ano (semestre)?',
                    'multiple' => false, 'expanded' => true, 'attr' => array('class' => 'list-inline')
                ))
                ->add('fichaItem03', 'choice', array('choices' => array(
                        '0' => 'Mau',
                        '1' => 'Medíocre',
                        '2' => 'Suficiente',
                        '3' => 'Bom',
                        '4' => 'Muito Bom',
                        '5' => 'Excelente'
                    ),
                    'label' => 'Nº 3 (a) - Apresentou bibliografia de base?',
                    'multiple' => false, 'expanded' => true, 'attr' => array('class' => 'list-inline')
                ))
                ->add('fichaItem04', 'choice', array('choices' => array(
                        '0' => 'Mau',
                        '1' => 'Medíocre',
                        '2' => 'Suficiente',
                        '3' => 'Bom',
                        '4' => 'Muito Bom',
                        '5' => 'Excelente'
                    ),
                    'label' => 'Nº 4 (a) - Atavia-se decentemente?',
                    'multiple' => false, 'expanded' => true, 'attr' => array('class' => 'list-inline')
                ))
                ->add('fichaItem05', 'choice', array('choices' => array(
                        '0' => 'Mau',
                        '1' => 'Medíocre',
                        '2' => 'Suficiente',
                        '3' => 'Bom',
                        '4' => 'Muito Bom',
                        '5' => 'Excelente'
                    ),
                    'label' => 'Nº 5 (d) - Cumpriu com a execução do plano temático, de acordo com o Calendário e carga horária do ano académico vigente?',
                    'multiple' => false, 'expanded' => true, 'attr' => array('class' => 'list-inline')
                ))
                ->add('fichaItem06', 'choice', array('choices' => array(
                        '0' => 'Mau',
                        '1' => 'Medíocre',
                        '2' => 'Suficiente',
                        '3' => 'Bom',
                        '4' => 'Muito Bom',
                        '5' => 'Excelente'
                    ),
                    'label' => 'Nº 6 (a) - Apresenta os sumários correspondientes às exigênvias do plano temático?',
                    'multiple' => false, 'expanded' => true, 'attr' => array('class' => 'list-inline')
                ))
                ->add('fichaItem07', 'choice', array('choices' => array(
                        '0' => 'Mau',
                        '1' => 'Medíocre',
                        '2' => 'Suficiente',
                        '3' => 'Bom',
                        '4' => 'Muito Bom',
                        '5' => 'Excelente'
                    ),
                    'label' => 'Nº 7 (d) - Repeita os Calendários de provas de frequência e exames?',
                    'multiple' => false, 'expanded' => true, 'attr' => array('class' => 'list-inline')
                ))
                ->add('fichaItem08', 'choice', array('choices' => array(
                        '0' => 'Mau',
                        '1' => 'Medíocre',
                        '2' => 'Suficiente',
                        '3' => 'Bom',
                        '4' => 'Muito Bom',
                        '5' => 'Excelente'
                    ),
                    'label' => 'Nº 8 (a) - É pontual?',
                    'multiple' => false, 'expanded' => true, 'attr' => array('class' => 'list-inline')
                ))
                ->add('fichaItem09', 'choice', array('choices' => array(
                        '0' => 'Mau',
                        '1' => 'Medíocre',
                        '2' => 'Suficiente',
                        '3' => 'Bom',
                        '4' => 'Muito Bom',
                        '5' => 'Excelente'
                    ),
                    'label' => 'Nº 9 (a) - É assíduo?',
                    'multiple' => false, 'expanded' => true, 'attr' => array('class' => 'list-inline')
                ))
                ->add('fichaItem10', 'choice', array('choices' => array(
                        '0' => 'Mau',
                        '1' => 'Medíocre',
                        '2' => 'Suficiente',
                        '3' => 'Bom',
                        '4' => 'Muito Bom',
                        '5' => 'Excelente'
                    ),
                    'label' => 'Nº 10 (a) - Tira dúvidas durante as aulas teóricas?',
                    'multiple' => false, 'expanded' => true, 'attr' => array('class' => 'list-inline')
                ))
                ->add('fichaItem11', 'choice', array('choices' => array(
                        '0' => 'Mau',
                        '1' => 'Medíocre',
                        '2' => 'Suficiente',
                        '3' => 'Bom',
                        '4' => 'Muito Bom',
                        '5' => 'Excelente'
                    ),
                    'label' => 'Nº 11 (a) - Tira dúvidas durante as aulas práticas?',
                    'multiple' => false, 'expanded' => true, 'attr' => array('class' => 'list-inline')
                ))
                ->add('fichaItem12', 'choice', array('choices' => array(
                        '0' => 'Mau',
                        '1' => 'Medíocre',
                        '2' => 'Suficiente',
                        '3' => 'Bom',
                        '4' => 'Muito Bom',
                        '5' => 'Excelente'
                    ),
                    'label' => 'Nº 12 (d) - Participa em actividades de superação científico-pedagógica?',
                    'multiple' => false, 'expanded' => true, 'attr' => array('class' => 'list-inline')
                ))
                ->add('fichaItem13', 'choice', array('choices' => array(
                        '0' => 'Mau',
                        '1' => 'Medíocre',
                        '2' => 'Suficiente',
                        '3' => 'Bom',
                        '4' => 'Muito Bom',
                        '5' => 'Excelente'
                    ),
                    'label' => 'Nº 13 (d) - Participa em eventos científicos?',
                    'multiple' => false, 'expanded' => true, 'attr' => array('class' => 'list-inline')
                ))
                ->add('fichaItem14', 'choice', array('choices' => array(
                        '0' => 'Mau',
                        '1' => 'Medíocre',
                        '2' => 'Suficiente',
                        '3' => 'Bom',
                        '4' => 'Muito Bom',
                        '5' => 'Excelente'
                    ),
                    'label' => 'Nº 14 (a) - Aplica todas as provas de acordo com o regime académico?',
                    'multiple' => false, 'expanded' => true, 'attr' => array('class' => 'list-inline')
                ))
                ->add('fichaItem15', 'choice', array('choices' => array(
                        '0' => 'Mau',
                        '1' => 'Medíocre',
                        '2' => 'Suficiente',
                        '3' => 'Bom',
                        '4' => 'Muito Bom',
                        '5' => 'Excelente'
                    ),
                    'label' => 'Nº 15 (a) - Faz a correção das provas com os estudantes ou pelo menos afixa os tópicos dacorreção modelo?',
                    'multiple' => false, 'expanded' => true, 'attr' => array('class' => 'list-inline')
                ))
                ->add('fichaItem16', 'choice', array('choices' => array(
                        '0' => 'Mau',
                        '1' => 'Medíocre',
                        '2' => 'Suficiente',
                        '3' => 'Bom',
                        '4' => 'Muito Bom',
                        '5' => 'Excelente'
                    ),
                    'label' => 'Nº 16 (a) - Apresenta o resultado das provas dentro dos prazos previstos?',
                    'multiple' => false, 'expanded' => true, 'attr' => array('class' => 'list-inline')
                ))
                ->add('fichaItem17', 'choice', array('choices' => array(
                        '0' => 'Mau',
                        '1' => 'Medíocre',
                        '2' => 'Suficiente',
                        '3' => 'Bom',
                        '4' => 'Muito Bom',
                        '5' => 'Excelente'
                    ),
                    'label' => 'Nº 17 (a) - Aceita e discute reclamações, quando são procedentes?',
                    'multiple' => false, 'expanded' => true, 'attr' => array('class' => 'list-inline')
                ))
                ->add('fichaItem18', 'choice', array('choices' => array(
                        '0' => 'Mau',
                        '1' => 'Medíocre',
                        '2' => 'Suficiente',
                        '3' => 'Bom',
                        '4' => 'Muito Bom',
                        '5' => 'Excelente'
                    ),
                    'label' => 'Nº 18 (d) - Terminou as aulas na data prevista?',
                    'multiple' => false, 'expanded' => true, 'attr' => array('class' => 'list-inline')
                ))
                ->add('fichaItem19', 'choice', array('choices' => array(
                        '0' => 'Mau',
                        '1' => 'Medíocre',
                        '2' => 'Suficiente',
                        '3' => 'Bom',
                        '4' => 'Muito Bom',
                        '5' => 'Excelente'
                    ),
                    'label' => 'Nº 19 (a) - Domina a cadeira que ministra?',
                    'multiple' => false, 'expanded' => true, 'attr' => array('class' => 'list-inline')
                ))
                ->add('fichaItem20', 'choice', array('choices' => array(
                        '0' => 'Mau',
                        '1' => 'Medíocre',
                        '2' => 'Suficiente',
                        '3' => 'Bom',
                        '4' => 'Muito Bom',
                        '5' => 'Excelente'
                    ),
                    'label' => 'Nº 20 (a) - Apresenta bons resultados relativamente ao número total de estudantes?',
                    'multiple' => false, 'expanded' => true, 'attr' => array('class' => 'list-inline')
                ))
                ->end()->end()
        ;
        if ($this->getSubject()->getId()) {
            $formMapper->tab('Resultados')
                    ->with('Resultados do Processo')
                    ->add('pontuacao', null, array('read_only' => true))
                    ->add('classificacao', 'text', array('disabled' => true, 'label' => 'Classificação'))
                    ->add('decisoes_do_conselho_pedagogico', null, array("expanded" => true, "multiple" => true))
                    ->add('resultado', 'textarea')
                    ->end()
                    ->end()
            ;
        }
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
                //->add('id')
                ->add('data')
                ->add('fichaItem01')
                ->add('fichaItem02')
                ->add('fichaItem03')
                ->add('fichaItem04')
                ->add('fichaItem05')
                ->add('fichaItem06')
                ->add('fichaItem07')
                ->add('fichaItem08')
                ->add('fichaItem09')
                ->add('fichaItem10')
                ->add('fichaItem11')
                ->add('fichaItem12')
                ->add('fichaItem13')
                ->add('fichaItem14')
                ->add('fichaItem15')
                ->add('fichaItem16')
                ->add('fichaItem17')
                ->add('fichaItem18')
                ->add('fichaItem19')
                ->add('fichaItem20')
                ->add('resultado')
                ->add('pontuacao')
        ;
    }

    public function prePersist($object) {
        parent::prePersist($object);

        if ($object->getDisciplinasLecionadas()) {
            foreach ($object->getDisciplinasLecionadas() as $item) {
                $item->setAvaliacaoDesempenho($object);
            }
        }

        $pontuacao = ($object->getFichaItem01() + $object->getFichaItem02() + $object->getFichaItem03() + $object->getFichaItem04() + $object->getFichaItem05() + $object->getFichaItem06() + $object->getFichaItem07() + $object->getFichaItem08() + $object->getFichaItem09() + $object->getFichaItem10() + $object->getFichaItem11() + $object->getFichaItem12() + $object->getFichaItem13() + $object->getFichaItem14() + $object->getFichaItem15() + $object->getFichaItem16() + $object->getFichaItem17() + $object->getFichaItem18() + $object->getFichaItem19() + $object->getFichaItem20() ) / 5;
        $object->setPontuacao($pontuacao);
    }

    public function preUpdate($object) {
        parent::preUpdate($object);

        if ($object->getDisciplinasLecionadas()) {
            foreach ($object->getDisciplinasLecionadas() as $item) {
                $item->setAvaliacaoDesempenho($object);
            }
        }
        
        $pontuacao = ($object->getFichaItem01() + $object->getFichaItem02() + $object->getFichaItem03() + $object->getFichaItem04() + $object->getFichaItem05() + $object->getFichaItem06() + $object->getFichaItem07() + $object->getFichaItem08() + $object->getFichaItem09() + $object->getFichaItem10() + $object->getFichaItem11() + $object->getFichaItem12() + $object->getFichaItem13() + $object->getFichaItem14() + $object->getFichaItem15() + $object->getFichaItem16() + $object->getFichaItem17() + $object->getFichaItem18() + $object->getFichaItem19() + $object->getFichaItem20() ) / 5;
        $object->setPontuacao($pontuacao);
    }

    public function postUpdate($object) {
        parent::postUpdate($object);

        // apagar disciplinas lecionadas nao relacionadas

        $todos = $this->getConfigurationPool()->getContainer()
                ->get("doctrine")->getRepository("SamplesAvaliacaoDesempenhoBundle:DisciplinaLecionada")
                ->findBy(array("avaliacao_desempenho" => $object->getId()));

        $items_a_eliminar = array();

        foreach ($todos as $item) {
            $items_a_eliminar[] = $item;
        }

        foreach ($object->getDisciplinasLecionadas() as $item) {
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
