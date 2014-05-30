<?php

namespace ZIMZIM\Bundles\AddressBundle\Form\DataTransformer;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\DataTransformerInterface;

class CityPostCodeTransformer implements DataTransformerInterface{

    private $em;

    public function __construct(EntityManager $entityManager){
        $this->em = $entityManager;
    }

    public function transform($value)
    {
        var_dump($value);echo 'transform';
        if(isset($value)){
            $entities = $this->em->getRepository('ZIMZIMBundlesAddressBundle:CityPostCode')->findByPostCodeOrCity();
            return array('citypostcode' => $value->getId());
        }
        return null;
}


public function reverseTransform($value)
{
    var_dump($value);echo 'reversetransform';
    if(isset($value)){
        return $value;
    }
    return null;
}
}