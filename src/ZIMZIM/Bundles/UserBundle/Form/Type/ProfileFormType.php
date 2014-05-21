<?php

namespace ZIMZIM\Bundles\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

class ProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->remove('current_password')
            ->add('firstname', null, array('label' => 'form.user.profiletype.firstname'))
            ->add('lastname', null, array('label' => 'form.user.profiletype.lastname'))
            ->add('address', 'zimzim_address_address', array('attr' => array('label-inline' => 'label-inline')))
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