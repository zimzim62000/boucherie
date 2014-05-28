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
            'text',
            array(
                'attr' => array(
                    'placeholder' => 'form.address.citypostcodetype.citypostcode.placeholder',
                    'class' => 'autocomplete'
                )
            )
        )->add('submit', 'submit', array('label' => 'button.find'));
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