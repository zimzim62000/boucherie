<?php

namespace ZIMZIM\Bundles\AddressBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CityPostCodeLinkType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'citypostcode',
            'zimzim_address_type_autocompletecitylinktype',
            array()
        );
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {

        $resolver->setDefaults(
            array(
                'attr' => array('onSubmit' => 'return false;'),
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zimzim_address_type_citypostcodelinktype';
    }
}