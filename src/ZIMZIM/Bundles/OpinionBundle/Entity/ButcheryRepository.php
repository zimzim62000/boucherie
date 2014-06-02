<?php

namespace ZIMZIM\Bundles\OpinionBundle\Entity;


use Doctrine\ORM\EntityRepository;

class  ButcheryRepository extends EntityRepository
{

    public function findByAddress(array $address){

        var_dump($address);
        $address = implode(',', $address);

        $query = $this->createQueryBuilder('b');
        $query->where('b.address IN (:address)')
            ->setParameter('address', $address);
        return $query->getQuery()->setMaxResults(10)->getResult();
    }
}