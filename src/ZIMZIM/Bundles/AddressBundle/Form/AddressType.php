<?php

namespace ZIMZIM\Bundles\AddressBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
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
            ->add('city', null, array('label' => 'form.address.addresstype.city.label', 'required' => false))
            ->add('cp', null, array('label' => 'form.address.addresstype.cp.label', 'required' => false))
            ->add('country', null, array('label' => 'form.address.addresstype.country.label', 'required' => false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ZIMZIM\Bundles\AddressBundle\Entity\Address'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zimzim_address_address';
    }
}
