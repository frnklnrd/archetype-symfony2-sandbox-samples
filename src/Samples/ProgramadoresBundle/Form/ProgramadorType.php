<?php

namespace Samples\ProgramadoresBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProgramadorType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('ci', 'text', array("label" => "Carnet de Identidad", "attr" => array('maxlength' => '11')))
                ->add('nombre', 'text', array("label" => "Nombre(s)"))
                ->add('apellido1', 'text', array("label" => "Primer Apellido"))
                ->add('apellido2', 'text', array("label" => "Segundo Apellido"))
                ->add('fecha_nacimiento', 'date', array(
                    "label" => "Fecha de Nacimiento",
                    "widget" => "single_text",
                    "format" => "yyyy-MM-dd",
                    "read_only" => true,
                    "attr" => array('class' => 'datepicker')
                ))
                ->add('sexo', 'choice', array(
                    "choices" => array("M" => "Masculino", "F" => "Femenino"),
                    "expanded" => true,
                    "multiple" => false,
                        )
                )
                ->add('certificado', null, array("label" => "¿Está Certificado?"))
                ->add('sistema_operativo', null, array("label" => "Sistema Preferido"))
                ->add('lenguajes_programacion', null, array("label" => "Lenguajes que conoce", "expanded" => true,
                    "multiple" => true))
                ->add('foto_file', 'file', array('required' => false,
                    "label" => "Foto personal",
                ))                
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Samples\ProgramadoresBundle\Entity\Programador'
        ));
    }

    public function getName() {
        return 'programador';
    }

}
