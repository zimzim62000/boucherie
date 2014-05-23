<?php

namespace ZIMZIM\Bundles\OpinionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OpinionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user')
            ->add('opinionLevel')
            ->add('butchery')
            ->add('text')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ZIMZIM\Bundles\OpinionBundle\Entity\Opinion',
            'attr' => array(

            )
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zimzim_bundles_opinionbundle_opiniontype';
    }
}
