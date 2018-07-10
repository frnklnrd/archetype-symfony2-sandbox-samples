<?php

namespace Samples\CibercafeBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ServicioReservacionAdmin extends Admin {

    protected function configureFormFields(FormMapper $formMapper) {

        $formMapper
                ->with('Datos Generales')
                ->add('fecha', null, array("label" => "Fecha de Reservación", "required"=>true))
                ->add('hora_inicio', null, array("label" => "Hora de Reservación", "required"=>true))
                ->add('entidad', null, array("label" => "Entidad a la que pertenece"))
                ->add('usuario', 'entity', array('class' => 'SamplesCibercafeBundle:Usuario', "multiple" => false, "expanded" => false))
                ->end();

        $subject = $this->getSubject();

        // configuraciones segun herencia

        if ($subject instanceof \Samples\CibercafeBundle\Entity\ServicioReservacionLaboratorio) {
            $formMapper
                    ->with('Datos del Servicio de Reservación de laboratorio')
                    // relacion de mucho a mucho
                    ->add('instaladores_necesarios', 'entity', array('class' => 'SamplesCibercafeBundle:Instalador', "multiple" => true, "expanded" => true))
                    ->end();
        } else if ($subject instanceof \Samples\CibercafeBundle\Entity\ServicioReservacionSalonConferencia) {
            // no tiene nada nuevo
        }
    }

    // datos comunes a mostrar en los filtros

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('fecha', null, array("label" => "Fecha de Reservación"))
        ;
    }

    // datos comunes a mostrar en la tabla que lista los elementos

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('tipo')
                ->add('entidad', null, array("label" => "Entidad a la que pertenece"))
                ->add('fecha', null, array("label" => "Fecha de Reservación"))
                ->add('hora_inicio', null, array("label" => "Hora de Reservación"))
        ;
    }

}

?>
