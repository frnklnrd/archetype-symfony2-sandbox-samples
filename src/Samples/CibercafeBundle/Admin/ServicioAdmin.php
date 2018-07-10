<?php

namespace Samples\CibercafeBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ServicioAdmin extends Admin {

    protected function configureFormFields(FormMapper $formMapper) {

        $formMapper
                ->with('Datos Generales')
                ->add('hora_inicio', null, array("label" => "Hora que entró", "required"=>true))
                ->add('hora_fin', null, array("label" => "Hora en que salió", "required"=>true))
                ->add('fecha', null, array("label" => "Fecha"))
                // relacion de mucho a uno
                ->add('usuario', 'entity', array('class' => 'SamplesCibercafeBundle:Usuario', "multiple" => false, "expanded" => false))
                ->end();

        $subject = $this->getSubject();

        if ($subject instanceof \Samples\CibercafeBundle\Entity\ServicioCafeteria) {
            $formMapper
                    ->with('Datos del Servicio de Cafetería')
                    // relacion de mucho a mucho
                    ->add('platos_solicitados', 'entity', array('class' => 'SamplesCibercafeBundle:Menu', "multiple" => true, "expanded" => true))
                    ->end();
        } else if ($subject instanceof \Samples\CibercafeBundle\Entity\ServicioImpresion) {
            $formMapper
                    ->with('Datos del Servicio de Impresión')
                    ->add('texto', 'textarea', array("label" => "Texto a Imprimir"))
                    // relacion de mucho a uno
                    ->add('tipo_imp', 'entity', array('class' => 'SamplesCibercafeBundle:TipoImpresion', "multiple" => false, "expanded" => false))
                    ->end();
        } else if ($subject instanceof \Samples\CibercafeBundle\Entity\ServicioNavegacion) {
            $formMapper
                    ->with('Datos del Servicio de Navegación')
                    ->add('cant_kb_descarga','integer', array("label" => "Cantidad de kb que descargó"))
                    ->end();
        } else if ($subject instanceof \Samples\CibercafeBundle\Entity\ServicioQuemado) {
            $formMapper
                    ->with('Datos del Servicio de Quemado')
                    // relacion de mucho a uno
                    ->add('tipo_velocidad', 'entity', array('class' => 'SamplesCibercafeBundle:VelocidadQuemado', "multiple" => false, "expanded" => false))
                    ->add('cant_inf_mb', 'text', array("label" => "Cantidad de informacion en Mbytes"))
                    ->end();
        }
    }

    // datos comunes a mostrar en los filtros

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('fecha', null, array("label" => "Fecha"))
                ->add('usuario', null, array('class' => 'SamplesCibercafeBundle:Usuario', "multiple" => false, "expanded" => false))
        ;
    }

    // datos comunes a mostrar en la tabla que lista los elementos

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('tipo')
                ->add('usuario')
                ->add('hora_inicio', null, array("label" => "Hora que entró"))
                ->add('hora_fin', null, array("label" => "Hora en que salió"))
                ->add('fecha', null, array("label" => "Fecha"))
                ->add('precio', null, array("label" => "Precio del Servicio"))
        // ->add('usuario', null, array('class' => 'SamplesCibercafeBundle:Usuario', "multiple" => false, "expanded" => false))

        ;
    }

}

?>
