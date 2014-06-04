<?php

namespace ZIMZIM\Bundles\OpinionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ZIMZIM\Bundles\OpinionBundle\Entity\Opinion;

class OpinionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('opinionLevel')
            ->add('text');

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
                $form = $event->getForm();
                $data = $event->getData();
                if ($data->getId() === null) {
                    $form->add('submit', 'submit', array('label' => 'button.create'));
                } else {
                    $form->add('user')
                        ->add('butchery')
                        ->add('submit', 'submit', array('label' => 'button.update'));
                }
            }
        );

        $builder->addEventListener(
            FormEvents::PRE_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                $data = $form->getData();
                if (null === $data->getButchery()) {
                    $form->add('user')
                        ->add('butchery');
                }
            }
        );
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'ZIMZIM\Bundles\OpinionBundle\Entity\Opinion',
                'attr' => array(),
                'error_mapping' => array(
                    '.' => 'text',
                )
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zimzim_bundles_opinionbundle_opiniontype';
    }
}
