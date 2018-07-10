<?php

namespace Samples\ProgramadoresBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ProgramadorAdmin extends Admin {

    protected $baseRouteName = 'samples_programadoresadmin_programador';
    protected $baseRoutePattern = 'programador';
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
                //  'json', 'xml', 'csv', 'xls'
        );
    }

    // campos a mostrar en la tabla que lista los elementos
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('ci', null, array("label" => "No. Id."))
                ->addIdentifier('nombrecompleto', null, array("label" => "Nombre"))
                ->add('fecha_nacimiento', null, array("label" => "Fecha"))
                ->add('sexodescripcion', null, array("label" => "Sexo"))
                ->add('certificado', null, array("label" => "¿Certificado?", "editable" => true))
                ->add('sistema_operativo', null, array("label" => "Sistema"))
                ->add('lenguajes_programacion', null, array("label" => "Lenguajes"))
                ->add('image_preview', 'html', array("label" => " "))
        ;
    }

    // campos a mostrar en los filtros
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('nombre', null, array("label" => "Nombre(s)"))
                ->add('apellido1', null, array("label" => "Primer Apellido"))
                ->add('apellido2', null, array("label" => "Segundo Apellido"))
                ->add('ci', null, array("label" => "No. Identidad"))
                ->add('sexo', null, array("label" => "Sexo"))
                ->add('certificado', null, array("label" => "¿Está Certificado?"))
                ->add('sistema_operativo', null, array("label" => "Sistema Preferido"))
                ->add('lenguajes_programacion', null, array("label" => "Lenguajes conocidos"));
    }

    // campos a mostrar en los formularios de adicionar y editar
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->tab("Datos Generales")
                ->with('Datos Personales', array("class" => "col-md-6", "description" => "Indique los datos siguientes"))
                ->add('nombre', null, array("label" => "Nombre(s)"))
                ->add('apellido1', null, array("label" => "Primer Apellido", "attr" => array("class" => "col-md-3")))
                ->add('apellido2', null, array("label" => "Segundo Apellido", "attr" => array("class" => "col-md-3")))
                ->add('ci', null, array("label" => "No. Identidad", "attr" => array('maxlength' => '11')))
                ->add('fecha_nacimiento', 'sonata_type_date_picker', array(
                    "label" => "Fecha de Nacimiento",
                      'format' => 'yyyy-MM-dd'
                ))
                ->end()
                ->with('Otros Datos', array("class" => "col-md-6"))
                ->add('sexo', 'choice', array(
                    "choices" => array("M" => "Masculino", "F" => "Femenino"),
                    "expanded" => true,
                    "multiple" => false,
                        )
                )
                ->add('foto_file', 'file', $this->getFileImageOptions(array(
                            'required' => false,
                            "label" => "Foto personal")
                        )
                )
                ->end()
                ->end()
                ->tab("Datos Profesionales")
                ->with('Curriculum', array("class" => "col-md-4"))
                ->add('certificado', null, array("label" => "¿Está Certificado?"))
                ->add('sistema_operativo', null, array("label" => "Sistema Preferido"))
                //->add('sistema_operativo', 'sonata_type_model' , array("label" => "Sistema Preferido"))
                //->add('sistema_operativo', 'sonata_type_model_list' , array("label" => "Sistema Preferido"))
                ->add('lenguajes_programacion', null, array("label" => "Lenguajes conocidos", "expanded" => true,
                    "multiple" => true,))
                ->end()
                ->with("Proyectos Realizados", array("class" => "col-md-8"))
                ->add('proyectos', 'sonata_type_collection', array(
                    "label" => "Proyectos Realizados",
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
    }

    public function getFileImageOptions($fileFieldOptions = array('required' => false)) {
        // get the current subject instance

        if ($this->hasParentFieldDescription()) { // this Admin is embedded
            // $getter will be something like 'getlogoImage'
            $getter = 'get' . $this->getParentFieldDescription()->getFieldName();

            // get hold of the parent object

            $parent = $this->getParentFieldDescription()->getAdmin()->getSubject();

            if ($parent) {
                $subject = $parent->$getter();
            } else {
                $subject = null;
            }
        } else {
            $subject = $this->getSubject();
        }

        // use $fileFieldOptions so we can add other options to the field
        //$fileFieldOptions = array('required' => false);

        if ($subject && ($webPath = $subject->getWebPath())) {

            // get the container so the full path to the image can be set

            $container = $this->getConfigurationPool()->getContainer();
            $fullPath = $container->get('request')->getBasePath() . $webPath;

            // add a 'help' option containing the preview's img tag

            $fileFieldOptions['help'] = '<img src="/' . $fullPath . '" class="admin-preview" width="200px"/>';
        }

        return $fileFieldOptions;
    }

    /**
     * @return \Symfony\Bundle\TwigBundle\TwigEngine
     */
    public function getTemplating() {
        return $this->getConfigurationPool()->getContainer()->get("templating");
    }

    public function prePersist($object) {

        parent::prePersist($object);

        if ($object->getProyectos()) {
            foreach ($object->getProyectos() as $proyecto) {
                $proyecto->setProgramador($object);
            }
        }
    }

    function preUpdate($object) {

        parent::preUpdate($object);

        foreach ($object->getProyectos() as $proyecto) {
            $proyecto->setProgramador($object);
        }
    }

    // metodo que se ejecuta luego de haber salvado el objeto

    function postUpdate($object) {

        parent::postUpdate($object);

        // obteniendo los proyectos en la base de datos que se relacionan con el programador

        $proyectos = $this->getConfigurationPool()->getContainer()
                ->get("doctrine")->getRepository("SamplesProgramadoresBundle:Proyecto")
                ->findBy(array("programador" => $object->getId()));

        // los paso para un arreglo donde voy a dejar solo los que hay que eliminar

        $proyectos_a_eliminar = array();

        foreach ($proyectos as $proyecto) {
            $proyectos_a_eliminar[] = $proyecto;
        }

        // ciclo para saber cuales quito del arreglo de los proyectos a eliminar
        // si encuentro alguno que coincida el id es porque este no debe ser eliminado y lo quitamos del arreglo

        foreach ($object->getProyectos() as $proyecto) {
            foreach ($proyectos_a_eliminar as $key => $toDel) {
                if ($toDel->getId() === $proyecto->getId()) {
                    unset($proyectos_a_eliminar[$key]);
                }
            }
        }

        // elimiando los que quedaron en el arreglo

        foreach ($proyectos_a_eliminar as $proyecto) {
            $this->getConfigurationPool()->getContainer()
                    ->get("doctrine")->getManager()->remove($proyecto);
        }
        // liberando la transacccion para que se ejecuten las eliminaciones
        $this->getConfigurationPool()->getContainer()
                ->get("doctrine")->getManager()->flush();
    }

    public function getTemplate($name) {
        switch ($name) {
            case 'edit':
                return "SamplesProgramadoresBundle:Admin:Programador/edit.html.twig";
            default:
                return parent::getTemplate($name);
        }
    }

}

?>
