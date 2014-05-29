<?php

namespace ZIMZIM\Bundles\AddressBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CityPostCodeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'citypostcode',
            'zimzim_address_type_autocompletetype',
            array(
                'attr' => array(
                    'placeholder' => 'form.address.citypostcodetype.citypostcode.placeholder',
                    'class' => 'autocomplete text-center',
                    'onKeyUp' => 'autocompletecity(event, this)'
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
            array('attr' => array('class' => '', 'onSubmit' => 'return false;'))
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zimzim_address_type_citypostcodetype';
    }
}