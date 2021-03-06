<?php

namespace ZIMZIM\Bundles\AddressBundle\Form;

use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddressType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('address', null, array('label' => 'form.address.addresstype.address.label', 'required' => false))
            ->add(
                'citypostcode',
                'zimzim_address_type_citypostcodetype',
                array(
                    'attr' => array('label-inline' => 'label-inline'),
                    'error_mapping' => array(
                        '.' => 'stringcitypostcode',
                    ),
                    'label'=> 'form.address.addresstype.citypostcode.label'
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
                'data_class' => 'ZIMZIM\Bundles\AddressBundle\Entity\Address',
                'attr' => array(
                ),
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zimzim_address_address';
    }
}
