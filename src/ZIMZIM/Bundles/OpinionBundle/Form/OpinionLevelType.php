<?php

namespace ZIMZIM\Bundles\OpinionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OpinionLevelType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array('label' => 'form.opinion.opinionleveltype.name.label'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ZIMZIM\Bundles\OpinionBundle\Entity\OpinionLevel',
            'attr' => array(
                'class' => 'customerpanel'
            )
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zimzim_bundles_opinionbundle_opinionlevel';
    }
}
