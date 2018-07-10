<?php

namespace Samples\CibercafeBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class UsuarioAdmin extends Admin {

    protected function configureFormFields(FormMapper $formMapper) {

        $formMapper
                ->with('Datos Generales')
                ->add('carnet_identidad', null, array("label" => "Carnet de Identidad" /* , "help" => "Debe escribir un número de 11 dígitos" */))
                ->add('nombre', 'text', array("label" => "Nombre(s)"))
                ->add('apellidos', 'text', array("label" => "Apellidos"))
                ->add('num_PC_asignada', 'integer', array("label" => "Numero de PC Asignada"))
                ->add('num_tarjeta_credito', 'integer', array("label" => "Numero Tarjeta de Credito"))
                ->end();

        $subject = $this->getSubject();

        // configuraciones segun herencia

        if ($subject instanceof \Samples\CibercafeBundle\Entity\UsuarioAsociado) {
            $formMapper
                    ->with('Datos del Usuario Asociado')
                    ->add('cant_annos', 'integer', array("label" => "Cantidad de Años de Asociado"))
                    // relacion de mucho a uno
                    ->add('categoria', 'entity', array('class' => 'SamplesCibercafeBundle:CategoriaUsuarioAsociado', "multiple" => false, "expanded" => false))
                    ->end();
        } else if ($subject instanceof \Samples\CibercafeBundle\Entity\UsuarioEventual) {
            // no se le agrega nada1    
        }
    }

    // datos comunes a mostrar en los filtros

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('carnet_identidad', null, array("label" => "Carnet de Identidad"))
                ->add('nombre')
                ->add('apellidos', null, array("label" => "Apellidos"))
        ;
    }

    // datos comunes a mostrar en la tabla que lista los elementos

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('carnet_identidad')
                ->add('tipo', null, array("label" => "Tipo"))
                ->add('nombre')
                ->add('apellidos', null, array("label" => "Apellidos"))
                ->add('num_PC_asignada', null, array("label" => "Numero de PC Asignada"))
                ->add('num_tarjeta_credito', null, array("label" => "Numero Tarjeta de Credito"))

        ;
    }

}