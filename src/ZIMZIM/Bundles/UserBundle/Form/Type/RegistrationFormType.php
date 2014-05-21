<?php

namespace ZIMZIM\Bundles\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->remove('username');
        $builder->remove('plainPassword');
        $builder->add('plainPassword', 'password', array('label' => 'form.user.registrationtype.plainPassword.label'));
        $builder->add('submit', 'submit', array('label' => 'button.register'));
    }

    public function getName()
    {
        return 'zimzim_user_registration';
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }
}