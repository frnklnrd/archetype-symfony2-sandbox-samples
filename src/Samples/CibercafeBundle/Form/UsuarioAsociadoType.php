<?php

namespace Samples\CibercafeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsuarioAsociadoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('apellidos')
            ->add('num_PC_asignada')
            ->add('num_tarjeta_credito')
            ->add('carnet_identidad')
            ->add('cant_annos')
            ->add('categoria')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Samples\CibercafeBundle\Entity\UsuarioAsociado'
        ));
    }

    public function getName()
    {
        return 'usuario_asociado';
    }
}
