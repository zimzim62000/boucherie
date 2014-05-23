<?php

namespace ZIMZIM\Bundles\OpinionBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StarsType extends AbstractType
{
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $data = array(
            5 => 5,
            4 => 4,
            3 => 3,
            2 => 2,
            1 => 1,
        );

        $resolver->setDefaults(
            array(
                'widget' => 'choice',
                'choices' => $data,
                'attr' => array(
                    'label-inline' => 'label-inline',
                )
            )
        );
    }


    public function getParent()
    {
        return 'choice';
    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'zimzim_bundles_opinionbundle_starstype';
    }
}
