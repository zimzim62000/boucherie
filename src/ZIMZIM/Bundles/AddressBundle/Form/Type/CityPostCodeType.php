<?php

namespace ZIMZIM\Bundles\AddressBundle\Form\Type;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ZIMZIM\Bundles\AddressBundle\Form\DataTransformer\CityPostCodeTransformer;

class CityPostCodeType extends AbstractType
{
    private $transformer;
    private $em;

    public function __construct(EntityManager $em, CityPostCodeTransformer $transformer)
    {
        $this->transformer = $transformer;
        $this->em = $em;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->addEventListener(
            FormEvents::PRE_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                $data = $event->getData();
                echo 'pre submit';
                var_dump($data);
                //var_dump($form->getParent()->getData());
                //var_dump($form->getParent()->getParent()->getData());
            }
        );

        $builder->add(
            'stringcitypostcode',
            'zimzim_address_type_autocompletecitypostcodetype'
            )
            ->add(
                'citypostcode',
                'choice'
            )
            ->add('ajax', 'hidden', array('data' => 0, 'attr' => array('id' => 'autocomplete-ajax')))
            ->addModelTransformer($this->transformer);


    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {

        $resolver->setDefaults(array());
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zimzim_address_type_citypostcodetype';
    }
}