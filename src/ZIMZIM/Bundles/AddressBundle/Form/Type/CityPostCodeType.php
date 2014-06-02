<?php

namespace ZIMZIM\Bundles\AddressBundle\Form\Type;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ZIMZIM\Bundles\AddressBundle\Entity\CityPostCodeRepository;
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

        $builder->add(
            'stringcitypostcode',
            'zimzim_address_type_autocompletecitypostcodetype'
        )->addModelTransformer($this->transformer);
        /*
        $builder->addEventListener(
            FormEvents::PRE_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                $data = $event->getData();
                $value = $data['stringcitypostcode'];

                if (!empty($value)) {
                    $form->add(
                        'citypostcode',
                        'entity',
                        array(
                            'label' => 'NomDuLabel',
                            'class' => 'ZIMZIMBundlesAddressBundle:CityPostCode',
                            'query_builder' => function (CityPostCodeRepository $er) use ($value) {
                                    return $er->findByPostCodeOrCity($value, $value, true);
                                },
                            'required' => true
                        )
                    );
                }
            }
        );*/
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