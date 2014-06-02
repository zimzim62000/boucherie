<?php

namespace ZIMZIM\Bundles\AddressBundle\Form\DataTransformer;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\DataTransformerInterface;
use ZIMZIM\Bundles\AddressBundle\Entity\CityPostCode;


/*  *
    * echo '<br />reverstransfor<pre>';
    * \Doctrine\Common\Util\Debug::dump($value);
    * echo '</pre>';
 */

class CityPostCodeTransformer implements DataTransformerInterface
{

    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function transform($cityPostCode)
    {
        if (isset($cityPostCode) && $cityPostCode instanceof CityPostCode) {
            return array(
                'citypostcode' => $cityPostCode->getId(),
                'stringcitypostcode' => $cityPostCode->__toString()
            );
        }

        return null;
    }


    public function reverseTransform($value)
    {
        if (isset($value) && count($value)) {

            return $value['citypostcode'];
        }

        return null;
    }
}