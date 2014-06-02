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

    public function transform($value)
    {
        echo '<br />transfor<pre>';
        \Doctrine\Common\Util\Debug::dump($value);
        echo '</pre>';
        if (isset($value) && count($value)) {
            $entity = $this->em->getRepository('ZIMZIMBundlesAddressBundle:CityPostCode')->find($value->getId());

            return array(
                'citypostcode' => $value->getId(),
                'stringcitypostcode' => $entity->__toString()
            );
        }

        return null;
    }


    public function reverseTransform($value)
    {
        echo '<br />reverse transform<pre>';
        \Doctrine\Common\Util\Debug::dump($value);
        echo '</pre>';
        if (isset($value)) {

            return new CityPostCode();
        }

        return null;
    }
}