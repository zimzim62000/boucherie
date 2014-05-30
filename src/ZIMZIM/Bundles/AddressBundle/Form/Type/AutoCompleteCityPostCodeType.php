<?php

namespace ZIMZIM\Bundles\AddressBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Routing\Router;

class AutoCompleteCityPostCodeType extends AbstractType
{
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'attr' => array(
                    'placeholder' => 'form.address.citypostcodetype.citypostcode.placeholder',
                    'class' => 'text-center',
                    'onKeyUp' => 'autocompletecity(event, this);'
                )
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zimzim_address_type_autocompletecitypostcodetype';
    }


    public function getParent()
    {
        return 'text';
    }
}