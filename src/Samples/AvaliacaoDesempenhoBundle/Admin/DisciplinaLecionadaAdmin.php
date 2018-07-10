<?php

namespace Samples\AvaliacaoDesempenhoBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class DisciplinaLecionadaAdmin extends Admin {

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                // ->add('id')
                ->add('semestre')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                //  ->add('id')
                ->add('semestre')
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

        if (true === $this->getConfigurationPool()->getContainer()
                        ->get('security.context')->isGranted('ROLE_SUPER_ADMIN')) {
            $formMapper
                    //  ->add('id')
                    ->add('disciplina')
            ;
        }
        else if (true === $this->getConfigurationPool()->getContainer()
                        ->get('security.context')->isGranted('ROLE_CHEFE_DEPARTAMENTO')) {

            $user = $this->getConfigurationPool()->getContainer()
                            ->get('security.context')->getToken()->getUser();

            $chefe = $this->getConfigurationPool()->getContainer()
                    ->get("doctrine")->getRepository("SamplesAvaliacaoDesempenhoBundle:Pessoal")
                    ->findOneBy(array("usuario" => $user->getId()));

            $departamento = $chefe->getDepartamento();

            $formMapper
                    ->add('disciplina', 'entity', array('class' => 'SamplesAvaliacaoDesempenhoBundle:Disciplina',
                        'query_builder' => function(\Doctrine\ORM\EntityRepository $er) use ($departamento) {
                            $qb = $er->createQueryBuilder('d');
                            $qb->where($qb->expr()->eq('d.departamento', $departamento->getId()));
                            $qb->orderBy('d.disciplina', 'ASC');
                            return $qb;
                        },
                        "multiple" => false, "expanded" => false, 'required' => true)
                    )
            ;
        } else {

            $formMapper
                    //  ->add('id')
                    ->add('disciplina')
            ;
        }
        $formMapper
                ->add('semestre', 'choice', array('choices' => array('1' => 'Iº', '2' => 'IIº')))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
                // ->add('id')
                ->add('semestre')
        ;
    }

}
