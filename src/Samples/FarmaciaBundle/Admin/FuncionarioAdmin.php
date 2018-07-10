<?php

namespace Samples\FarmaciaBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class FuncionarioAdmin extends Admin {

    protected $datagridValues = array(
        '_sort_by' => 'nome',
        '_sort_order' => 'ASC',
    );

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                //->add('id')
                ->add('nome')
                ->add('bi', null, array('label' => 'Bilhete de Identidade'))
                ->add('usuario')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                //->add('id')
                ->add('nome')
                ->add('bi', null, array('label' => 'Bilhete de Identidade'))
                ->add('usuario', 'html')
                ->add('usuario.groups', null, array('label' => 'Tipo de Usuario'))
                ->add('_action', 'actions', array(
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
    protected function configureFormFields(FormMapper $formMapper) {

        $formMapper
                ->with('Dados pessoais', array('class' => "col-md-6"))
                ->add('nome')
                ->add('bi', null, array('label' => 'Bilhete de Identidade'))
                ->end()
                ->with("Dados do utilizador", array('class' => "col-md-6"))
                ->add(
                        $formMapper->create('usuario', 'form', array('label' => false, 'by_reference' => true, "data_class" => "Sonata\UserBundle\Entity\BaseUser"))
                        ->add('username', null, array('label' => 'Utilizador'))
                        ->add('email', null, array('required' => true, 'label' => 'Email'))
                        ->add('plainPassword', 'password', array('required' => false, 'label' => 'Senha'))
                        ->add('groups', null, array('required' => true, 'expanded' => true, 'multiple' => true, 'label' => 'Tipo de Usuario'))
                )
                ->end()
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
                //->add('id')
                ->add('nome')
                ->add('bi')
                ->add('cargo')
        ;
    }

    public function prePersist($object) {

        parent::prePersist($object);

        $usuario = $object->getUsuario();
        $usuario->setEnabled(true);
        $userManager = $this->getConfigurationPool()->getContainer()->get('fos_user.user_manager');
        $userManager->updateCanonicalFields($usuario);
        $userManager->updatePassword($usuario);
    }

    public function preUpdate($object) {

        parent::preUpdate($object);

        $usuario = $object->getUsuario();
        $userManager = $this->getConfigurationPool()->getContainer()->get('fos_user.user_manager');
        $userManager->updateCanonicalFields($usuario);
        $userManager->updatePassword($usuario);
    }

    
}
