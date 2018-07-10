<?php

namespace Samples\CompanyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorkerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('company')
            ->add('firstname')
            ->add('lastname')
            ->add('birthdate', 'date', array(
                'widget'=>'single_text',
                'attr'=>array(
                    'class'=>'date'
                )
            ))
            ->add('email')
            ->add('phone')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Samples\CompanyBundle\Entity\Worker',
            'csrf_protection' => false,
        ));
    }
}
