<?php

namespace Samples\ProgramadoresBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class ProyectoAdmin extends Admin {

    protected $baseRouteName = 'samples_programadoresadmin_proyecto';
    protected $baseRoutePattern = 'proyecto';
    protected $translationDomain = 'SamplesProgramadoresBundle';
    protected $datagridValues = array(
        '_page' => 1, // Display the first page (default = 1)
        '_sort_order' => 'ASC', // Descendant ordering (default = 'ASC')
        '_sort_by' => 'nombre' // name of the ordered field (default = the model id field, if any)
    );

    protected function configureRoutes(RouteCollection $collection) {
        $collection->clearExcept(array('list', 'create', 'edit', 'show', 'delete', 'batch', 'export'));
    }

    public function getExportFormats() {
        return array(
                //   'json', 'xml', 'csv', 'xls'
        );
    }

    // campos a mostrar en la tabla que lista los elementos
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('id')
                ->add('nombre', null, array("label" => "Nombre"))
                ->add('fecha', null, array("label" => "Fecha"))
                ->add('lenguaje_programacion', null, array("label" => "Lenguaje"));
    }

    // campos a mostrar en los filtros
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('nombre', null, array("label" => "Nombre"))
                ->add('fecha', null, array("label" => "Fecha"))
                ->add('lenguaje_programacion', null, array("label" => "Lenguaje"));
        ;
    }

    // campos a mostrar en los formularios de adicionar y editar
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('nombre', null, array("label" => "Nombre del Proyecto",
                    "attr" => array('style' => 'width:100%')))
                ->add('lenguaje_programacion', null, array("label" => "Lenguaje en el que se realizó", "required" => true))
                //->add('lenguaje_programacion', 'sonata_type_model_list', array("label" => "Lenguaje en el que se realizó", "required"=> true))
                ->add('fecha', 'sonata_type_date_picker', array("label" => "Fecha de Realización",
                    'format' => 'yyyy-MM-dd'
                ))
        /* ->add('programador', 'entity', array("label" => "Programador",
          "by_reference" => true,
          "class"=>"UO\Demo\CoreBundle\Entity\Programador")) */
        ;
    }

}

?>
