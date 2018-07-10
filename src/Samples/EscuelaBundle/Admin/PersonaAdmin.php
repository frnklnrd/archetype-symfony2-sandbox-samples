<?php

namespace Samples\EscuelaBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PersonaAdmin extends Admin {

    protected function configureFormFields(FormMapper $formMapper) {

        $formMapper
                ->with('Datos Generales')
                ->add('ci', 'text', array("label" => "Carnet de Identidad" /* , "help" => "Debe escribir un número de 11 dígitos" */))
                ->add('nombre', 'text', array("label" => "Nombre(s)"))
                ->add('apellido1', 'text', array("label" => "Primer Apellido"))
                ->add('apellido2', 'text', array("label" => "Segundo Apellido"))
                ->add('fecha_nacimiento', 'date', array(
                    "label" => "Fecha de Nacimiento",
                    "widget" => "single_text",
                    "format" => "yyyy-MM-dd",
                    "read_only" => false,
                        //'attr' => array('class' => 'date'),
                ))
                ->add('sexo', 'choice', array(
                    "choices" => array("M" => "Masculino", "F" => "Femenino"),
                    "expanded" => true,
                    "multiple" => false,
                        )
                )
                //->add('escuela', 'entity', array('class' => 'SamplesEscuelaBundle:Escuela', "multiple" => false, "expanded" => false))
                ->add('escuela', 'sonata_type_model_list')
                ->end()
                ->with('Dirección Particular')
                ->add(
                        $formMapper->create('direccion', 'form', array('label' => false, 'by_reference' => true, "data_class" => "Samples\EscuelaBundle\Entity\DireccionParticular"))
                        ->add('calle', 'text')
                        ->add('numero', 'number')
                        ->add('localidad', 'text')
                        ->add('provincia', 'entity', array('class' => 'SamplesEscuelaBundle:Provincia', "multiple" => false, "expanded" => false))
                )->end();

        $subject = $this->getSubject();

        if ($subject instanceof \Samples\EscuelaBundle\Entity\Estudiante) {
            $formMapper
                    ->with('Datos Estudiantiles')
                    ->add('grado', 'integer')
                    //->add('cursos', 'entity', array('class' => 'SamplesEscuelaBundle:Asignatura', "multiple" => true, "expanded" => true))
                    ->add('notas', 'sonata_type_collection', array(
                        "label" => 'Cursos y Evaluaciones',
                        "by_reference" => false,
                        'type_options' => array('delete' => true)
                            ), array(
                        'edit' => 'inline',
                        'inline' => 'table',
                        'sortable' => 'position',
                    ))
                    ->end();
        } else if ($subject instanceof \Samples\EscuelaBundle\Entity\Profesor) {
            $formMapper
                    ->with('Datos Laborales')
                    ->add('salario', 'money', array("currency" => ""))
                    ->add('asignaturas', 'entity', array('class' => 'SamplesEscuelaBundle:Asignatura', "multiple" => true, "expanded" => true))
                    ->end();
        }
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('ci', null, array("label" => "Carnet de Identidad"))
                ->add('nombre')
                ->add('apellido1', null, array("label" => "Primer Apellido"))
                ->add('apellido2', null, array("label" => "Segundo Apellido"))
        //->add('fecha_nacimiento', null, array("label" => "Fecha Nacimiento"))
        //->add('posts')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('ci')
                ->add('tipo', null, array("label" => "Tipo"))
                ->add('nombre')
                ->add('apellido1', null, array("label" => "Primer Apellido"))
                ->add('apellido2', null, array("label" => "Segundo Apellido"))
                ->add('sexoMF', null, array("label" => "Sexo"))
                ->add('edad', null, array("label" => "Edad"))
                ->add('direccion', null, array("label" => "Dirección Particular"))
        ;
        //$listMapper->add('cursos','entity', array('class' => 'SamplesEscuelaBundle:Asignatura'));
        //$listMapper->add('cursos',null,array("label" => "Cursos"));
        //$listMapper->add('asignaturas',null,array("label" => "Asignaturas"));      
    }

    public function prePersist($object) {
        parent::prePersist($object);

        if ($object instanceof \Samples\EscuelaBundle\Entity\Estudiante && $object->getNotas()) {
            foreach ($object->getNotas() as $item) {
                $item->setEstudiante($object);
            }
        }
    }

    public function preUpdate($object) {
        parent::preUpdate($object);
        if ($object instanceof \Samples\EscuelaBundle\Entity\Estudiante && $object->getNotas()) {
            foreach ($object->getNotas() as $item) {
                $item->setEstudiante($object);
            }
        }
    }

}
