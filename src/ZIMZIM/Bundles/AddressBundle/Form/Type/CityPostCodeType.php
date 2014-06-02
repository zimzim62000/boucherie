<?php

namespace ZIMZIM\Bundles\AddressBundle\Form\Type;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ZIMZIM\Bundles\AddressBundle\Entity\CityPostCode;
use ZIMZIM\Bundles\AddressBundle\Entity\CityPostCodeRepository;
use ZIMZIM\Bundles\AddressBundle\Form\DataTransformer\CityPostCodeTransformer;
use ZIMZIM\Bundles\AddressBundle\Form\DataTransformer\TestTransformer;

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
        );

        $addSelectCityPostCode = function (FormInterface $form, $value) {

            $form->add(
                'citypostcode',
                'entity',
                array(
                    'label' => 'NomDuLabel',
                    'class' => 'ZIMZIMBundlesAddressBundle:CityPostCode',
                    'query_builder' => function (CityPostCodeRepository $er) use ($value) {
                            return $er->findByPostCodeOrCity($value, $value, true);
                        },
                    'required' => true,
                )
            );

        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($addSelectCityPostCode) {
                $form = $event->getForm();
                $data = $event->getData();
                if ($data instanceof CityPostCode) {
                    if (null !== $data->getId()) {
                        $entity = $this->em->getRepository('ZIMZIMBundlesAddressBundle:CityPostCode')->find(
                            $data->getId()
                        );
                        $addSelectCityPostCode($form, $entity->getCity());
                    }
                }
            }
        );

        $builder->get('stringcitypostcode')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($addSelectCityPostCode) {
                $form = $event->getForm();
                $value = $event->getData();
                if(!empty($value)){
                    $addSelectCityPostCode($form->getParent(), $value);
                }
            }
        );

        $builder->addModelTransformer($this->transformer);
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