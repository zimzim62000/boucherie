<?php

namespace ZIMZIM\Bundles\AddressBundle\Entity;

use Doctrine\ORM\EntityRepository;

class CityPostCodeRepository extends EntityRepository
{
    public function findByPostCodeOrCity($city, $postcode){

        $city = $city.'%';
        $postcode = $postcode.'%';
        $query = $this->createQueryBuilder('c');
        $query->where('c.city LIKE :city')
            ->OrWhere('c.cp LIKE :postcode')
            ->setParameter('city', $city)
            ->setParameter('postcode', $postcode);
        return $query->getQuery()->setMaxResults(10)->getResult();
    }
}