<?php

namespace ZIMZIM\Bundles\OpinionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ButcheryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('text')
            ->add('typeButchery')
            ->add('typeMeat')
            ->add('user')
            ->add(
                'address',
                'zimzim_address_address',
                array(
                    'attr' => array(
                        'label-inline' => 'label-inline',
                        'no-label' => 'no-label',
                        'required' => false
                    )
                )
            );
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'ZIMZIM\Bundles\OpinionBundle\Entity\Butchery',
                'attr' => array(
                ),
                'cascade_validation' => true
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zimzim_bundles_opinionbundle_butcherytype';
    }
}
