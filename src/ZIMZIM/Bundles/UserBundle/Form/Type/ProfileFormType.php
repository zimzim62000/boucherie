<?php

namespace ZIMZIM\Bundles\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

class ProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->remove('current_password')
            ->add('firstname', null, array('label' => 'form.user.profiletype.firstname', 'attr' => array( 'required' => false)))
            ->add('lastname', null, array('label' => 'form.user.profiletype.lastname', 'attr' => array('required' => false)))
            ->add('address', 'zimzim_address_address', array('attr' => array('label-inline' => 'label-inline', 'required' => false)))
            ->add('submit', 'submit', array('label' => 'button.update'));
    }

    public function getName()
    {
        return 'zimzim_user_profile';
    }

    public function getParent()
    {
        return 'fos_user_profile';
    }
}